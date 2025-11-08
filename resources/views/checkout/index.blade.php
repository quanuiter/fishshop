@extends('layouts.app')
@section('title', 'Thanh toán')

@section('content')
    <x-breadcrumb />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .checkout-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .checkout-header {
            background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
            color: white;
            padding: 40px 32px;
            border-radius: 12px;
            margin-bottom: 32px;
            box-shadow: 0 4px 12px rgba(26, 71, 42, 0.1);
        }

        .checkout-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .checkout-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .checkout-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
        }

        @media (max-width: 768px) {
            .checkout-content {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        /* Form Section */
        .form-section {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .form-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1a472a;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e0e0e0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            padding: 12px 16px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a472a;
            box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Order Summary Section */
        .order-summary {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .order-summary h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1a472a;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e0e0e0;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f9faf8;
            border-radius: 8px;
            border-left: 3px solid #1a472a;
        }

        .order-item-name {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .order-item-price {
            font-size: 14px;
            font-weight: 600;
            color: #1a472a;
        }

        .order-divider {
            height: 1px;
            background: #e0e0e0;
            margin: 16px 0;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(255, 215, 0, 0.05) 100%);
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .order-total-label {
            font-size: 18px;
            font-weight: 600;
            color: #1a472a;
        }

        .order-total-amount {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #1a472a 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(26, 71, 42, 0.2);
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #0f2d1a 0%, #1a472a 100%);
            box-shadow: 0 6px 16px rgba(26, 71, 42, 0.3);
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }
    </style>

    <div class="checkout-container">
        <!-- Added gradient header section -->
        <div class="checkout-header">
            <h1>Xác nhận đơn hàng</h1>
            <p>Vui lòng kiểm tra thông tin trước khi hoàn tất thanh toán</p>
        </div>

        <!-- Created two-column grid layout for form and summary -->
        <div class="checkout-content">
            <!-- Form Section -->
            <form method="POST" action="{{ route('checkout.store') }}" class="form-section">
                @csrf

                <h2>Thông tin giao hàng</h2>

                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên"
                        value="{{ old('name', auth()->user()->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ giao hàng</label>
                    <textarea id="address" name="address" placeholder="Nhập địa chỉ giao hàng"
                        required>{{ old('address') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Hình thức thanh toán</label>
                    <div style="display:flex; flex-direction:column; gap:8px; margin-top:4px;">

                        <label style="display:flex; align-items:center; gap:8px;">
                            <input type="radio" name="payment_method" value="COD" checked style="accent-color:#1a472a;">
                            <span>Thanh toán khi nhận hàng (COD)</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Xác nhận đặt hàng</button>
            </form>

            <!-- Order Summary Section -->
            <div class="order-summary">
                <h2>Đơn hàng của bạn</h2>

                <div class="order-items">
                    @foreach ($cart as $item)
                        <div class="order-item">
                            <span class="order-item-name">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                            <span
                                class="order-item-price">₫{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="order-divider"></div>

                <div class="order-total">
                    <span class="order-total-label">Tổng cộng:</span>
                    <span class="order-total-amount">₫{{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

@endsection