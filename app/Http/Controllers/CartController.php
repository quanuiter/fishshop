<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $variantId = $request->variant_id;
        $quantity = $request->quantity ?? 1;

        $variant = ProductVariant::with('product')->findOrFail($variantId);
        $product = $variant->product;

        $cart = session()->get('cart', []);

        // key là id biến thể (để tránh trùng sản phẩm khác variant)
        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $quantity;
        } else {
            $cart[$variantId] = [
                'variant_id' => $variantId,
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $variant->image ?? $product->images->first()?->image_url,
                'price' => $variant->price,
                'color' => $variant->color,
                'size' => $variant->size,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sản phẩm vào giỏ hàng',
            'cart_count' => count($cart)
        ]);
    }

    public function remove($variantId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $variantId = $request->variant_id;
        $quantity = $request->quantity;

        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['status' => 'updated']);
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }
}
