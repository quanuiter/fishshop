<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Trang thai loc: '', 'pending', 'confirmed', 'completed', 'cancelled'
        $status = $request->get('status');
        $categoryId = $request->get('category_id');
        $productId = $request->get('product_id');

        $allowed = ['pending','confirmed','completed','cancelled'];
        $query = Order::with(['user', 'items.product'])->latest('id');
        if ($status && in_array($status, $allowed)) {
            $query->where('status', $status);
        }

        // Loc theo danh muc qua items -> product -> category
        if (!empty($categoryId)) {
            $query->whereHas('items.product.category', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        // Loc theo san pham qua items -> product
        if (!empty($productId)) {
            $query->whereHas('items.product', function ($q) use ($productId) {
                $q->where('id', $productId);
            });
        }

        $orders = $query->paginate(10)->withQueryString();

        // Data cho dropdown loc
        $categories = Category::orderBy('name')->get(['id','name']);
        $products = Product::orderBy('name')->get(['id','name']);

        return view('admin.orders.index', [
            'orders' => $orders,
            'status' => $status,
            'categories' => $categories,
            'products' => $products,
            'categoryId' => $categoryId,
            'productId' => $productId,
        ]);
    }

    // AJAX: cap nhat trang thai don hang
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:confirm,complete,cancel'
        ]);

        switch ($request->action) {
            case 'confirm':
                if ($order->status === 'pending') {
                    // Chuyen sang trang thai dang xu ly
                    $order->status = 'confirmed';
                    $order->save();
                    return response()->json([
                        'success' => true,
                        'order' => ['id' => $order->id, 'status' => $order->status],
                    ]);
                }
                break;
            case 'complete':
                if ($order->status === 'confirmed') {
                    $order->status = 'completed';
                    $order->save();
                    return response()->json([
                        'success' => true,
                        'order' => ['id' => $order->id, 'status' => $order->status],
                    ]);
                }
                break;
            case 'cancel':
                if (in_array($order->status, ['pending', 'confirmed'])) {
                    $order->status = 'cancelled';
                    $order->save();
                    return response()->json([
                        'success' => true,
                        'order' => ['id' => $order->id, 'status' => $order->status],
                    ]);
                }
                break;
        }

        return response()->json(['success' => false], 422);
    }

    // AJAX: tra ve danh sach san pham trong don (partial HTML)
    public function items(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders._items', compact('order'));
    }
}
