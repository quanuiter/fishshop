<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> body { padding-top: 70px; } </style>
</head>
<body>
@include('layouts.header')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Sửa sản phẩm</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Không chọn --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="origin" class="form-label">Xuất xứ</label>
                        <input type="text" name="origin" id="origin" class="form-control" value="{{ old('origin', $product->origin) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="warranty" class="form-label">Bảo hành</label>
                        <input type="text" name="warranty" id="warranty" class="form-control" value="{{ old('warranty', $product->warranty) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="material" class="form-label">Chất liệu</label>
                        <input type="text" name="material" id="material" class="form-control" value="{{ old('material', $product->material) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="year" class="form-label">Năm</label>
                        <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $product->year) }}" min="1900" max="2100">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

