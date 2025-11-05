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
    @vite(["resources/sass/app.scss","resources/js/app.js"]) {{-- nếu dự án đã cấu hình Vite */}
</head>
<body>
    @include('layouts.header')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="h4">Bảng điều khiển Admin</h1>
                <p class="mb-0">Chào mừng bạn đến khu vực quản trị.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

