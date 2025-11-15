@extends('layouts.app')

@section('title', 'Chính sách mua hàng - FishShop')

@section('content')
<x-breadcrumb />

<style>
    .policy-section h3 {
        font-weight: 700;
        color: #0f5132;
        margin-bottom: 12px;
        font-size: 1.35rem;
    }

    .policy-section p,
    .policy-section li {
        font-size: 0.97rem;
        line-height: 1.65;
        color: #333;
    }

    .policy-section ul {
        margin-left: 18px;
        margin-bottom: 18px;
    }

    .policy-wrapper {
        background: #ffffff;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }

    .policy-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .policy-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #0f5132;
    }
</style>

<div class="container py-5">
    <div class="policy-wrapper">

        <div class="policy-header">
            <h1>Chính Sách Mua Hàng</h1>
        </div>

        <div class="policy-section">

            <h3>Chính sách đặt hàng</h3>
            <p>Khách hàng có thể đặt mua trực tiếp trên website hoặc liên hệ qua hotline để được tư vấn. Đơn hàng sẽ được xác nhận khi khách cung cấp đầy đủ thông tin liên hệ và phương thức nhận hàng.</p>
            <ul>
                <li>FishShop có quyền từ chối các đơn hàng có dấu hiệu không hợp lệ hoặc nghi ngờ gian lận.</li>
                <li>Thông tin khách hàng phải chính xác để đảm bảo giao hàng đúng thời gian.</li>
            </ul>

            <h3>Chính sách thanh toán</h3>
            <p>FishShop hỗ trợ hai hình thức thanh toán tiện lợi:</p>
            <ul>
                <li><b>Thanh toán khi nhận hàng (COD):</b> áp dụng toàn quốc.</li>
                <li><b>Chuyển khoản ngân hàng:</b> sau khi thanh toán, khách vui lòng gửi xác nhận để shop xử lý đơn nhanh chóng.</li>
            </ul>

            <h3>Chính sách vận chuyển</h3>
            <ul>
                <li>Đơn nội thành TP. HCM: giao từ 1–2 ngày làm việc.</li>
                <li>Đơn tỉnh: giao từ 3–5 ngày tùy khu vực.</li>
                <li>Miễn phí vận chuyển cho đơn hàng từ <b>500.000đ</b>.</li>
            </ul>

            <h3>Chính sách đổi trả</h3>
            <p>FishShop hỗ trợ đổi trả trong vòng 7 ngày kể từ khi khách nhận hàng nếu sản phẩm thuộc một trong các trường hợp sau:</p>
            <ul>
                <li>Sai mẫu, sai số lượng hoặc lỗi kỹ thuật từ nhà sản xuất.</li>
                <li>Sản phẩm còn nguyên tem, bao bì và chưa qua sử dụng.</li>
            </ul>
            <p>Trường hợp đổi theo nhu cầu cá nhân, khách hàng chịu phí vận chuyển.</p>

            <h3>Chính sách bảo hành</h3>
            <p>Các sản phẩm chính hãng (cần câu, máy câu, phụ kiện) được bảo hành theo tiêu chuẩn nhà sản xuất. FishShop hỗ trợ tiếp nhận và gửi bảo hành nhanh nhất có thể.</p>

            <h3>Thông tin hỗ trợ</h3>
            <p>Mọi thắc mắc vui lòng liên hệ:</p>
            <ul>
                <li>Hotline/Zalo: <b>0909 123 456</b></li>
                <li>Địa chỉ: 123 Lê Lợi, Quận 1, TP. Hồ Chí Minh</li>
                <li>Email: <b>support@fishshop.vn</b></li>
            </ul>

            <p class="text-muted mt-4" style="font-weight:600; text-align:center;">
                FishShop luôn nỗ lực mang đến trải nghiệm mua sắm tốt nhất cho khách hàng.
            </p>

        </div>
    </div>
</div>
@endsection
