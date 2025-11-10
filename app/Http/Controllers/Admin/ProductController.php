<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Danh sách sản phẩm (admin)
    public function index()
    {
        $products = Product::query()
            ->with('category')
            ->withCount('variants')
            ->withSum('variants', 'stock')
            ->latest('id')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // Form tạo sản phẩm
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // Lưu sản phẩm
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand' => ['nullable', 'string', 'max:255'],
            'origin' => ['nullable', 'string', 'max:255'],
            'warranty' => ['nullable', 'string', 'max:255'],
            'material' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'between:1900,2100'],
            'primary_image_url' => ['nullable','string','max:2000'],
            // biến thể (tùy chọn)
            'variants' => ['nullable','array'],
            'variants.*.sku' => ['nullable','string','max:100','distinct','unique:product_variants,sku'],
            'variants.*.price' => ['nullable','numeric','min:0'],
            'variants.*.stock' => ['nullable','integer','min:0'],
            'variants.*.color' => ['nullable','string','max:100'],
            'variants.*.size' => ['nullable','string','max:100'],
            'variants.*.image' => ['nullable','string','max:1000'],
        ]);

        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'] ?? null;
        $product->category_id = $data['category_id'] ?? null;
        $product->brand = $data['brand'] ?? null;
        $product->origin = $data['origin'] ?? null;
        $product->warranty = $data['warranty'] ?? null;
        $product->material = $data['material'] ?? null;
        $product->year = $data['year'] ?? null;
        $product->save();

        // Nếu nhập ảnh đại diện cho sản phẩm gốc, lưu vào product_images (thumbnail)
        $primaryUrl = trim($request->input('primary_image_url', ''));
        if ($primaryUrl !== '') {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $primaryUrl,
                'is_thumbnail' => true,
                'sort_order' => 1,
            ]);
        }

        // thêm biến thể nếu có
        $variants = $request->input('variants', []);
        if (is_array($variants) && count($variants)) {
            foreach ($variants as $v) {
                $sku = trim($v['sku'] ?? '');
                $price = $v['price'] ?? null;
                if ($sku !== '' && $price !== null && $price !== '') {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => $sku,
                        'price' => (float) $price,
                        'stock' => (int) ($v['stock'] ?? 0),
                        'color' => $v['color'] ?? null,
                        'size' => $v['size'] ?? null,
                        'image' => $v['image'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công.');
    }

    // Form sửa sản phẩm
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand' => ['nullable', 'string', 'max:255'],
            'origin' => ['nullable', 'string', 'max:255'],
            'warranty' => ['nullable', 'string', 'max:255'],
            'material' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'between:1900,2100'],
        ]);

        $product->name = $data['name'];
        $product->description = $data['description'] ?? null;
        $product->category_id = $data['category_id'] ?? null;
        $product->brand = $data['brand'] ?? null;
        $product->origin = $data['origin'] ?? null;
        $product->warranty = $data['warranty'] ?? null;
        $product->material = $data['material'] ?? null;
        $product->year = $data['year'] ?? null;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    // Xoá sản phẩm
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xoá sản phẩm.');
    }
}
