<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Hiển thị trang checkout (lấy giỏ hàng từ session)
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Giỏ hàng của bạn đang trống!');
        }

        // Tổng tiền
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    // Lưu đơn hàng khi nhấn "Xác nhận thanh toán"
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Giỏ hàng trống.');
        }

        // Tính tổng tiền
        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => 'COD',
            'status' => 'pending'
        ]);

        // Tạo từng dòng order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('market.index')->with('success', 'Đặt hàng thành công!');
    }
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // bảo vệ: chỉ cho xem đơn hàng của chính mình
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Không có quyền xem đơn hàng này.');
        }

        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
}
