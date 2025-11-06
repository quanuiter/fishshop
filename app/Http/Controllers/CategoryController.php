<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $slug = $this->makeUniqueSlug($data['name']);

        Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Không dùng trong khu vực admin
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $slug = $this->makeUniqueSlug($data['name'], $category->id);

        $category->update([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xoá danh mục thành công.');
    }

    private function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (
            Category::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }
}
