@extends('layouts.app')

@section('title', 'Khuyến Mãi - FishShop')

@section('content')
<div class="container my-5">
    <h2 class="text-center text-primary fw-bold mb-4">🎣 ƯU ĐÃI & KHUYẾN MÃI TẠI FISHSHOP 🎣</h2>
    <p class="text-center text-muted mb-5">
        Đừng bỏ lỡ các chương trình khuyến mãi hấp dẫn dành cho cần thủ của chúng tôi!
    </p>

    <div class="row">
        <!-- Khuyến mãi 1 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/khuyenmai/shimano_sale.jpg') }}" class="card-img-top rounded-top-4" alt="Giảm 20% cần câu Shimano">
                <div class="card-body">
                    <h5 class="card-title text-success fw-bold">Giảm 20% cần câu Shimano</h5>
                    <p class="card-text">Ưu đãi cực lớn cho dòng cần câu Shimano chính hãng. Số lượng có hạn!</p>
                    <p class="text-secondary small mb-1">Thời gian: 01/11/2025 - 15/11/2025</p>
                    <span class="badge bg-success">Đang diễn ra</span>
                </div>
            </div>
        </div>

        <!-- Khuyến mãi 2 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/khuyenmai/daiwa_offer.jpg') }}" class="card-img-top rounded-top-4" alt="Mua máy câu Daiwa tặng dây câu">
                <div class="card-body">
                    <h5 class="card-title text-success fw-bold">Mua máy câu Daiwa tặng dây câu</h5>
                    <p class="card-text">Khi mua bất kỳ máy câu Daiwa nào, tặng ngay dây câu siêu bền trị giá 150.000đ.</p>
                    <p class="text-secondary small mb-1">Thời gian: 05/11/2025 - 30/11/2025</p>
                    <span class="badge bg-success">Đang diễn ra</span>
                </div>
            </div>
        </div>

        <!-- Khuyến mãi 3 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/khuyenmai/fishing_combo.jpg') }}" class="card-img-top rounded-top-4" alt="Combo cần + máy + dây siêu ưu đãi">
                <div class="card-body">
                    <h5 class="card-title text-success fw-bold">Combo cần + máy + dây siêu ưu đãi</h5>
                    <p class="card-text">Mua trọn bộ combo cần + máy + dây giảm ngay 15% và freeship toàn quốc!</p>
                    <p class="text-secondary small mb-1">Thời gian: 10/11/2025 - 25/11/2025</p>
                    <span class="badge bg-warning text-dark">Sắp diễn ra</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-primary px-4">⬅ Quay lại trang chủ</a>
    </div>
</div>
@endsection
