<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Xem giỏ hàng
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('carts.index', compact('cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int)$request->quantity);
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }

    // Xóa 1 sản phẩm
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    // Xóa toàn bộ giỏ
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
}
