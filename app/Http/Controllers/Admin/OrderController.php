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
        // Trạng thái lọc: '', 'pending', 'confirmed', 'completed'
        $status = $request->get('status');
        $categoryId = $request->get('category_id');
        $productId = $request->get('product_id');

        $allowed = ['pending','confirmed','completed'];
        $query = Order::with(['user', 'items.product'])->latest('id');
        if ($status && in_array($status, $allowed)) {
            $query->where('status', $status);
        }

        // Lọc theo danh mục qua items -> product -> category
        if (!empty($categoryId)) {
            $query->whereHas('items.product.category', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        // Lọc theo sản phẩm qua items -> product
        if (!empty($productId)) {
            $query->whereHas('items.product', function ($q) use ($productId) {
                $q->where('id', $productId);
            });
        }

        $orders = $query->paginate(10)->withQueryString();

        // Dữ liệu cho dropdown lọc
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

    // AJAX: cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:confirm,cancel'
        ]);

        if ($request->action === 'confirm' && $order->status === 'pending') {
            // Xác nhận → chuyển sang Đã xác nhận
            $order->status = 'confirmed';
            $order->save();
            return response()->json([
                'success' => true,
                'order' => ['id' => $order->id, 'status' => $order->status],
            ]);
        }

        if ($request->action === 'cancel' && $order->status === 'pending') {
            // Huỷ đơn khi còn chờ duyệt → xoá khỏi hệ thống
            $order->delete();
            return response()->json([
                'success' => true,
                'deleted' => true,
                'order' => ['id' => (int) $order->id],
            ]);
        }

        return response()->json(['success' => false], 422);
    }

    // AJAX: trả về danh sách sản phẩm trong đơn (partial HTML)
    public function items(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders._items', compact('order'));
    }
}
