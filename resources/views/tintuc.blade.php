@extends('layouts.app')

@section('title', 'Tin tức - FishShop')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">📰 Tin tức mới nhất</h1>

    <div class="row">
        {{-- Tin tức 1 --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Cá Koi mới nhập">
                <div class="card-body">
                    <h5 class="card-title">Cá Koi Nhật Bản mới cập bến</h5>
                    <p class="card-text text-muted">
                        FishShop vừa nhập về lô cá Koi Nhật Bản siêu đẹp, đa dạng màu sắc và kích thước.
                    </p>
                    <a href="#" class="btn btn-primary btn-sm">Đọc thêm</a>
                </div>
                <div class="card-footer bg-white text-muted small">
                    <i class="bi bi-calendar"></i> 03/11/2025
                </div>
            </div>
        </div>

        {{-- Tin tức 2 --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Hướng dẫn chăm sóc cá cảnh">
                <div class="card-body">
                    <h5 class="card-title">Hướng dẫn chăm sóc cá cảnh mùa lạnh</h5>
                    <p class="card-text text-muted">
                        Nhiệt độ giảm mạnh có thể ảnh hưởng đến sức khỏe của cá cảnh. Xem ngay cách chăm sóc đúng cách!
                    </p>
                    <a href="#" class="btn btn-primary btn-sm">Đọc thêm</a>
                </div>
                <div class="card-footer bg-white text-muted small">
                    <i class="bi bi-calendar"></i> 28/10/2025
                </div>
            </div>
        </div>

        {{-- Tin tức 3 --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Khuyến mãi tháng 11">
                <div class="card-body">
                    <h5 class="card-title">Khuyến mãi lớn tháng 11 🎁</h5>
                    <p class="card-text text-muted">
                        Giảm giá đến 30% cho các sản phẩm thức ăn và phụ kiện bể cá. Cơ hội mua sắm tiết kiệm cực lớn!
                    </p>
                    <a href="#" class="btn btn-primary btn-sm">Đọc thêm</a>
                </div>
                <div class="card-footer bg-white text-muted small">
                    <i class="bi bi-calendar"></i> 01/11/2025
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
