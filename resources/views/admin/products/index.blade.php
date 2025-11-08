<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> body { padding-top: 70px; } </style>
    @php use Illuminate\Support\Str; @endphp
</head>
<body>
@include('layouts.header')

<div class="container py-4">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0">Quản lý sản phẩm</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm sản phẩm</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width:80px">ID</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Biến thể</th>
                        <th>Tồn kho</th>
                        <th style="width:180px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <div class="text-muted small">{{ Str::limit($product->description, 60) }}</div>
                            </td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>{{ $product->brand ?? '-' }}</td>
                            <td>{{ $product->variants_count }}</td>
                            <td>{{ (int) ($product->variants_sum_stock ?? 0) }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xoá?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Chưa có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
