@extends('layouts.app')

@section('title', 'Chính sách mua hàng - FishShop')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 text-success fw-bold">🎣 Chính Sách Mua Hàng - FishShop</h1>

    <div class="card shadow-sm p-4">
        <h3 class="text-success">1️⃣ Chính sách đặt hàng</h3>
        <p>Khách hàng có thể đặt hàng trực tiếp tại website FishShop hoặc liên hệ qua hotline/Zalo để được hỗ trợ tư vấn sản phẩm.</p>
        <ul>
            <li>Đơn hàng chỉ được xác nhận sau khi khách hàng cung cấp đầy đủ thông tin liên hệ.</li>
            <li>FishShop có quyền từ chối các đơn hàng có dấu hiệu gian lận hoặc thông tin không hợp lệ.</li>
        </ul>

        <hr>

        <h3 class="text-success">2️⃣ Chính sách thanh toán</h3>
        <p>FishShop hỗ trợ 2 hình thức thanh toán tiện lợi:</p>
        <ul>
            <li><b>Thanh toán khi nhận hàng (COD):</b> Áp dụng toàn quốc, khách hàng thanh toán trực tiếp cho đơn vị vận chuyển.</li>
            <li><b>Chuyển khoản ngân hàng:</b> Sau khi thanh toán, vui lòng gửi thông tin xác nhận để shop xử lý đơn nhanh nhất.</li>
        </ul>

        <hr>

        <h3 class="text-success">3️⃣ Chính sách vận chuyển</h3>
        <ul>
            <li>Đơn hàng nội thành TP.HCM được giao trong 1–2 ngày làm việc.</li>
            <li>Đơn hàng tỉnh được giao từ 3–5 ngày tùy khu vực.</li>
            <li>Miễn phí vận chuyển cho đơn hàng từ <b>500.000đ</b> trở lên.</li>
        </ul>

        <hr>

        <h3 class="text-success">4️⃣ Chính sách đổi trả</h3>
        <ul>
            <li>Sản phẩm được đổi trả trong vòng <b>7 ngày</b> kể từ khi nhận hàng nếu:
                <ul>
                    <li>Giao sai mẫu, sai số lượng, hoặc bị lỗi kỹ thuật do nhà sản xuất.</li>
                    <li>Sản phẩm còn nguyên tem, hộp và chưa qua sử dụng.</li>
                </ul>
            </li>
            <li>Khách hàng chịu chi phí vận chuyển trong trường hợp đổi theo yêu cầu cá nhân.</li>
        </ul>

        <hr>

        <h3 class="text-success">5️⃣ Chính sách bảo hành</h3>
        <ul>
            <li>Tất cả cần câu, máy câu và phụ kiện chính hãng được bảo hành theo quy định của nhà sản xuất.</li>
            <li>FishShop hỗ trợ tiếp nhận và gửi bảo hành cho khách trong thời gian sớm nhất.</li>
        </ul>

        <hr>

        <h3 class="text-success">6️⃣ Liên hệ hỗ trợ</h3>
        <p>Mọi thắc mắc vui lòng liên hệ:</p>
        <ul>
            <li>📞 Hotline/Zalo: <b>0909 123 456</b></li>
            <li>🏠 Địa chỉ: 123 Lê Lợi, Quận 1, TP. Hồ Chí Minh</li>
            <li>📧 Email: <b>support@fishshop.vn</b></li>
            <li>🌐 Website: <a href="{{ url('/') }}">fishshop.vn</a></li>
        </ul>

        <p class="mt-4 text-center fw-bold text-muted">
            Cảm ơn quý khách đã tin tưởng và đồng hành cùng FishShop 🎣
        </p>
    </div>
</div>
@endsection
