<?php

namespace App\Http\Controllers;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Hiển thị trang checkout (lấy giỏ hàng từ session)
    public function index(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Giỏ hàng của bạn đang trống!');
        }

        // Tổng tiền gốc
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Xử lý khuyến mãi
        $promotion = null;
        $discount = 0;
        $finalTotal = $total;

        if ($request->has('promotion_id')) {
            $promotion = Promotion::available()->find($request->promotion_id);

            if ($promotion) {
                $discount = round($total * ($promotion->percent / 100));
                $finalTotal = max(0, $total - $discount);
            }
        }

        return view('checkout.index', [
            'cart' => $cart,
            'total' => $total,
            'promotion' => $promotion,
            'discount' => $discount,
            'finalTotal' => $finalTotal,
        ]);
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

        // Tổng tiền gốc
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Khuyến mãi
        $promotion = null;
        $discount = 0;
        $finalTotal = $total;

        if ($request->filled('promotion_id')) {
            $promotion = Promotion::available()->find($request->promotion_id);

            if ($promotion) {
                $discount = round($total * ($promotion->percent / 100));
                $finalTotal = max(0, $total - $discount);
            }
        }

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'promotion_id' => $promotion?->id,
            'total_amount' => $total,
            'discount_amount' => $discount,
            'final_amount' => $finalTotal,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => 'COD',
            'status' => 'pending',
        ]);

        // Chi tiết từng dòng
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công!');
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

        $order->load('items.product', 'promotion');
        return view('orders.show', compact('order'));
    }
}
