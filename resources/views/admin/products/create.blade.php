<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> body { padding-top: 70px; } </style>
</head>
<body>
@include('layouts.header')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Thêm sản phẩm</h1>
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
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Không chọn --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="origin" class="form-label">Xuất xứ</label>
                        <input type="text" name="origin" id="origin" class="form-control" value="{{ old('origin') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="warranty" class="form-label">Bảo hành</label>
                        <input type="text" name="warranty" id="warranty" class="form-control" value="{{ old('warranty') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="material" class="form-label">Chất liệu</label>
                        <input type="text" name="material" id="material" class="form-control" value="{{ old('material') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="year" class="form-label">Năm</label>
                        <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" min="1900" max="2100">
                    </div>
                    <div class="col-12">
                        <label for="primary_image_url" class="form-label">Ảnh thumbnail (URL)</label>
                        <input type="text" name="primary_image_url" id="primary_image_url" class="form-control" value="{{ old('primary_image_url') }}" placeholder="https://...">
                        <div class="form-text">Tuỳ chọn. Nếu nhập, ảnh này sẽ đặt làm thumbnail cho sản phẩm gốc.</div>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Biến thể sản phẩm</h5>
                <p class="text-muted small mb-2">Bạn có thể thêm nhiều biến thể (SKU, giá, tồn kho, màu, size, ảnh). Có thể bỏ trống nếu chưa cần.</p>
                <div id="variantList">
                    <div class="row g-2 align-items-end variant-item" data-index="0">
                        <div class="col-md-2">
                            <label class="form-label">SKU</label>
                            <input type="text" name="variants[0][sku]" class="form-control" placeholder="VD: ABC-001">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Giá</label>
                            <input type="number" step="0.01" name="variants[0][price]" class="form-control" placeholder="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" name="variants[0][stock]" class="form-control" placeholder="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Màu</label>
                            <input type="text" name="variants[0][color]" class="form-control" placeholder="VD: Đen">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size</label>
                            <input type="text" name="variants[0][size]" class="form-control" placeholder="VD: 2.7m">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Ảnh (URL)</label>
                            <input type="text" name="variants[0][image]" class="form-control" placeholder="https://...">
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnAddVariant">+ Thêm biến thể</button>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function(){
    const list = document.getElementById('variantList');
    const btn = document.getElementById('btnAddVariant');
    let idx = 1;
    btn?.addEventListener('click', function(){
      const row = document.createElement('div');
      row.className = 'row g-2 align-items-end variant-item mt-2';
      row.setAttribute('data-index', idx);
      row.innerHTML = `
        <div class="col-md-2">
          <label class="form-label">SKU</label>
          <input type="text" name="variants[${idx}][sku]" class="form-control" placeholder="VD: ABC-00${idx}">
        </div>
        <div class="col-md-2">
          <label class="form-label">Giá</label>
          <input type="number" step="0.01" name="variants[${idx}][price]" class="form-control" placeholder="0">
        </div>
        <div class="col-md-2">
          <label class="form-label">Tồn kho</label>
          <input type="number" name="variants[${idx}][stock]" class="form-control" placeholder="0">
        </div>
        <div class="col-md-2">
          <label class="form-label">Màu</label>
          <input type="text" name="variants[${idx}][color]" class="form-control" placeholder="VD: Đen">
        </div>
        <div class="col-md-2">
          <label class="form-label">Size</label>
          <input type="text" name="variants[${idx}][size]" class="form-control" placeholder="VD: 2.7m">
        </div>
        <div class="col-md-2">
          <div class="d-flex gap-2">
            <div class="flex-grow-1">
              <label class="form-label">Ảnh (URL)</label>
              <input type="text" name="variants[${idx}][image]" class="form-control" placeholder="https://...">
            </div>
            <button type="button" class="btn btn-outline-danger" title="Xoá" onclick="this.closest('.variant-item').remove()">&times;</button>
          </div>
        </div>`;
      list.appendChild(row);
      idx++;
    });
  })();
</script>
</body>
</html>
