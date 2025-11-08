<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $allowed = ['pending','confirmed'];
        $query = Order::with(['user', 'items.product'])->latest('id');
        if ($status && in_array($status, $allowed)) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders', 'status'));
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
