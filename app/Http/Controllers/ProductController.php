<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** 🧱 Danh sách sản phẩm (market) */
    public function index()
    {
        // Load sản phẩm kèm variants + images + category
        $products = Product::with(['variants', 'images', 'category'])->get();
        return view('market.index', compact('products'));
    }

    /** 🧩 Chi tiết sản phẩm */
    public function show($id)
    {
        $product = Product::with(['variants', 'images', 'category'])->findOrFail($id);

        // Sản phẩm liên quan cùng category
        $related_products = Product::with(['variants', 'images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('market.show', compact('product', 'related_products'));
    }

    /** 🧮 Lọc + Sắp xếp (AJAX) */
    public function filter(Request $request)
    {
        $query = Product::with(['variants', 'images', 'category']);

        // Lọc theo category
        if ($request->category && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Lọc theo tên
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo tồn kho
        if ($request->stock) {
            if ($request->stock === 'in_stock') {
                $query->whereHas('variants', fn($q) => $q->where('stock', '>', 0));
            } elseif ($request->stock === 'out_of_stock') {
                $query->whereDoesntHave('variants', fn($q) => $q->where('stock', '>', 0));
            }
        }

        // Lọc theo giá
        if ($request->minPrice || $request->maxPrice) {
            $query->whereHas('variants', function ($q) use ($request) {
                if ($request->minPrice) {
                    $q->where('price', '>=', $request->minPrice);
                }
                if ($request->maxPrice) {
                    $q->where('price', '<=', $request->maxPrice);
                }
            });
        }

        // Sắp xếp
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->withMin('variants', 'price')->orderBy('variants_min_price', 'asc');
                    break;
                case 'price_desc':
                    $query->withMin('variants', 'price')->orderBy('variants_min_price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $products = $query->get();

        return view('market.partials.products', compact('products'))->render();
    }

}
