<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 70px; }
    </style>
</head>
<body>
    @include('layouts.header')

    <div class="container">
        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h4">Bảng điều khiển Admin</h1>
                        <p class="mb-0">Chào mừng bạn đến khu vực quản trị.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Danh mục</h5>
                        <p class="card-text text-muted">Tạo, sửa, xoá các danh mục sản phẩm.</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-success">Quản lý danh mục</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Sản phẩm</h5>
                        <p class="card-text text-muted">Quản lý sản phẩm, chỉnh sửa thông tin cơ bản.</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-success">Quản lý sản phẩm</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Đơn hàng</h5>
                        <p class="card-text text-muted">Xác nhận hoặc huỷ đơn hàng.</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-success">Quản lý đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
