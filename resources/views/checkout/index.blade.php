@extends('layouts.app')
@section('title', 'Thanh toán')

@section('content')
    <x-breadcrumb />

    <style>
        :root {
            --primary: #1a472a;
            --primary-light: #2d5f3f;
            --accent: #e8b923;
            --accent-light: #ffd966;
            --neutral-light: #faf8f6;
            --neutral-gray: #6b6b6b;
            --neutral-dark: #2c2c2c;
            --border-color: #e5ddd5;
            --bg-light: #ffffff;
            --success: #27ae60;
            --shadow-sm: 0 2px 8px rgba(26, 71, 42, 0.06);
            --shadow-md: 0 8px 24px rgba(26, 71, 42, 0.1);
            --shadow-lg: 0 12px 32px rgba(26, 71, 42, 0.12);
            --transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: var(--neutral-light);
            color: var(--neutral-dark);
            line-height: 1.6;
        }

        .checkout-container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        /* Progress Steps */
        .checkout-progress {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-bottom: 48px;
            padding: 32px;
            background: var(--bg-light);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .progress-step {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            background: var(--border-color);
            color: var(--neutral-gray);
            transition: all var(--transition);
        }

        .step-circle.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(26, 71, 42, 0.3);
        }

        .step-circle.completed {
            background: var(--success);
            color: white;
        }

        .step-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--neutral-gray);
        }

        .step-label.active {
            color: var(--primary);
        }

        .progress-divider {
            width: 60px;
            height: 2px;
            background: var(--border-color);
        }

        /* Main Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 32px;
            align-items: start;
        }

        /* Form Section */
        .checkout-form {
            background: var(--bg-light);
            padding: 40px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title svg {
            width: 24px;
            height: 24px;
            color: var(--accent);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--neutral-dark);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group label .required {
            color: #d32f2f;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(232, 185, 35, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b6b6b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .address-preview {
            background: linear-gradient(135deg, rgba(232, 185, 35, 0.08) 0%, rgba(232, 185, 35, 0.03) 100%);
            padding: 16px;
            border-radius: 8px;
            border: 1px solid rgba(232, 185, 35, 0.2);
            margin-top: 12px;
        }

        .address-preview-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .address-preview-text {
            font-size: 14px;
            color: var(--neutral-dark);
            line-height: 1.6;
        }

        /* Payment Method */
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all var(--transition);
            background: white;
        }

        .payment-option:hover {
            border-color: var(--accent-light);
            background: rgba(232, 185, 35, 0.03);
        }

        .payment-option input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .payment-option.selected {
            border-color: var(--accent);
            background: rgba(232, 185, 35, 0.08);
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--neutral-light);
            border-radius: 8px;
        }

        .payment-details {
            flex: 1;
        }

        .payment-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 2px;
        }

        .payment-description {
            font-size: 12px;
            color: var(--neutral-gray);
        }

        /* Order Summary */
        .order-summary {
            position: sticky;
            top: 24px;
            background: var(--bg-light);
            padding: 32px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
            max-height: 300px;
            overflow-y: auto;
        }

        .order-items::-webkit-scrollbar {
            width: 6px;
        }

        .order-items::-webkit-scrollbar-track {
            background: var(--neutral-light);
            border-radius: 10px;
        }

        .order-items::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }

        .order-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: var(--neutral-light);
            border-radius: 8px;
            border-left: 3px solid var(--accent);
        }

        .order-item-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .order-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .order-item-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--neutral-dark);
            line-height: 1.3;
        }

        .order-item-variant {
            font-size: 11px;
            color: var(--neutral-gray);
        }

        .order-item-quantity {
            font-size: 12px;
            color: var(--neutral-gray);
        }

        .order-item-price {
            font-size: 14px;
            font-weight: 700;
            color: var(--accent);
            text-align: right;
        }

        .order-summary-divider {
            height: 1px;
            background: var(--border-color);
            margin: 20px 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row .label {
            color: var(--neutral-gray);
            font-weight: 500;
        }

        .summary-row .value {
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .summary-row.shipping .value {
            color: var(--success);
            font-weight: 700;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, rgba(232, 185, 35, 0.08) 0%, rgba(232, 185, 35, 0.03) 100%);
            border-radius: 8px;
            margin: 24px 0;
        }

        .summary-total .label {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .summary-total .value {
            font-size: 24px;
            font-weight: 800;
            color: var(--accent);
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all var(--transition);
            box-shadow: 0 4px 12px rgba(26, 71, 42, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-btn:hover {
            background: var(--primary-light);
            box-shadow: 0 8px 20px rgba(26, 71, 42, 0.3);
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
            font-size: 12px;
            color: var(--neutral-gray);
        }

        .secure-badge svg {
            width: 16px;
            height: 16px;
            color: var(--success);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .checkout-container {
                padding: 24px 16px;
            }

            .checkout-progress {
                padding: 20px 16px;
                gap: 8px;
            }

            .step-label {
                display: none;
            }

            .progress-divider {
                width: 30px;
            }

            .checkout-form,
            .order-summary {
                padding: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 18px;
            }
        }
    </style>

    <div class="checkout-container">
        <!-- Progress Steps -->
        <div class="checkout-progress">
            <div class="progress-step">
                <div class="step-circle completed">✓</div>
                <span class="step-label">Giỏ hàng</span>
            </div>
            <div class="progress-divider"></div>
            <div class="progress-step">
                <div class="step-circle active">2</div>
                <span class="step-label active">Thông tin giao hàng</span>
            </div>
            <div class="progress-divider"></div>
            <div class="progress-step">
                <div class="step-circle">3</div>
                <span class="step-label">Hoàn tất</span>
            </div>
        </div>

        <div class="checkout-layout">
            <!-- Form Section -->
            <form method="POST" action="{{ route('checkout.store') }}" class="checkout-form" id="checkoutForm">
                @csrf
                @if(!empty($promotion))
                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
                @endif
                <!-- Customer Information -->
                <h2 class="section-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Thông tin khách hàng
                </h2>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="name">Họ và tên <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Nguyễn Văn A"
                            value="{{ old('name', auth()->user()->name ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" placeholder="0123456789" value="{{ old('phone') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="email@example.com"
                            value="{{ old('email', auth()->user()->email ?? '') }}">
                    </div>
                </div>

                <!-- Shipping Address -->
                <h2 class="section-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Địa chỉ giao hàng
                </h2>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành phố <span class="required">*</span></label>
                        <select id="province" name="province" required>
                            <option value="">Chọn Tỉnh/Thành phố</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="district">Quận/Huyện <span class="required">*</span></label>
                        <select id="district" name="district" required disabled>
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ward">Phường/Xã <span class="required">*</span></label>
                        <select id="ward" name="ward" required disabled>
                            <option value="">Chọn Phường/Xã</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="street">Số nhà, tên đường <span class="required">*</span></label>
                        <input type="text" id="street" name="street" placeholder="123 Đường ABC" value="{{ old('street') }}"
                            required>
                    </div>

                    <div class="form-group full-width">
                        <label for="note">Ghi chú đơn hàng</label>
                        <textarea id="note" name="note"
                            placeholder="Ghi chú thêm về đơn hàng (không bắt buộc)">{{ old('note') }}</textarea>
                    </div>

                    <!-- Hidden field for full address -->
                    <input type="hidden" id="address" name="address">
                </div>

                <!-- Address Preview -->
                <div class="address-preview" id="addressPreview" style="display: none;">
                    <div class="address-preview-title">Địa chỉ giao hàng đầy đủ:</div>
                    <div class="address-preview-text" id="fullAddress"></div>
                </div>

                <!-- Payment Method -->
                <h2 class="section-title" style="margin-top: 32px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                    Phương thức thanh toán
                </h2>

                <div class="payment-methods">
                    <label class="payment-option selected">
                        <input type="radio" name="payment_method" value="COD" checked>
                        <div class="payment-icon">💵</div>
                        <div class="payment-details">
                            <div class="payment-title">Thanh toán khi nhận hàng (COD)</div>
                            <div class="payment-description">Thanh toán bằng tiền mặt khi nhận hàng</div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="BANK">
                        <div class="payment-icon">🏦</div>
                        <div class="payment-details">
                            <div class="payment-title">Chuyển khoản ngân hàng</div>
                            <div class="payment-description">Chuyển khoản trực tiếp qua ngân hàng</div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="MOMO">
                        <div class="payment-icon">📱</div>
                        <div class="payment-details">
                            <div class="payment-title">Ví điện tử MoMo</div>
                            <div class="payment-description">Thanh toán qua ví MoMo</div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="submit-btn" style="margin-top: 32px;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Xác nhận đặt hàng
                </button>

                <div class="secure-badge">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Giao dịch được bảo mật và mã hóa
                </div>
            </form>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title">Đơn hàng của bạn</h3>

                <div class="order-items">
                    @foreach($cart as $item)
                        <div class="order-item">
                            <div class="order-item-image">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            </div>
                            <div class="order-item-details">
                                <div class="order-item-name">{{ $item['name'] }}</div>
                                @if($item['color'] || $item['size'])
                                    <div class="order-item-variant">{{ $item['color'] ?? '' }} {{ $item['size'] ?? '' }}</div>
                                @endif
                                <div class="order-item-quantity">Số lượng: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="order-item-price">
                                ₫{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-summary-divider"></div>

                {{-- Tạm tính --}}
                <div class="summary-row">
                    <span class="label">Tạm tính</span>

                    @if(!empty($promotion))
                        <span class="value text-decoration-line-through text-muted">
                            ₫{{ number_format($total, 0, ',', '.') }}
                        </span>
                    @else
                        <span class="value">
                            ₫{{ number_format($total, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                {{-- Giảm giá nếu có promotion --}}
                @if(!empty($promotion))
                    <div class="summary-row">
                        <span class="label">Khuyến mãi ({{ $promotion->percent }}%)</span>
                        <span class="value text-danger">
                            -₫{{ number_format($discount, 0, ',', '.') }}
                        </span>
                    </div>
                @endif

                {{-- Free ship --}}
                <div class="summary-row shipping">
                    <span class="label">Phí vận chuyển</span>
                    <span class="value">Miễn phí</span>
                </div>

                {{-- Tổng cộng --}}
                <div class="summary-total">
                    <span class="label">Tổng cộng</span>
                    <span class="value text-success fw-bold">
                        ₫{{ number_format($finalTotal ?? $total, 0, ',', '.') }}
                    </span>
                </div>

                {{-- Nút chọn / bỏ khuyến mãi --}}
                <div class="mt-3">
                    @if(!empty($promotion))
                        <a href="{{ route('checkout.index') }}" class="text-danger small">
                            Bỏ khuyến mãi
                        </a>
                    @else
                        <a href="{{ route('promotions.index') }}" class="text-primary small">
                            Chọn khuyến mãi
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        // ======== CÁC PHẦN TỬ CẦN LẤY =========
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');
        const streetInput = document.getElementById('street');
        const addressInput = document.getElementById('address');
        const addressPreview = document.getElementById('addressPreview');
        const fullAddressDiv = document.getElementById('fullAddress');

        // ======== LẤY DANH SÁCH TỈNH/THÀNH ========
        fetch('https://provinces.open-api.vn/api/p/')
            .then(res => res.json())
            .then(data => {
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.code;
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });
            })
            .catch(err => console.error('Lỗi tải tỉnh/thành:', err));

        // ======== KHI CHỌN TỈNH ========
        provinceSelect.addEventListener('change', function () {
            const provinceCode = this.value;
            districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
            wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            districtSelect.disabled = !provinceCode;
            wardSelect.disabled = true;

            if (provinceCode) {
                fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.districts.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.code;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    });
            }
            updateFullAddress();
        });

        // ======== KHI CHỌN QUẬN/HUYỆN ========
        districtSelect.addEventListener('change', function () {
            const districtCode = this.value;
            wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            wardSelect.disabled = !districtCode;

            if (districtCode) {
                fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.wards.forEach(ward => {
                            const option = document.createElement('option');
                            option.value = ward.code;
                            option.textContent = ward.name;
                            wardSelect.appendChild(option);
                        });
                    });
            }
            updateFullAddress();
        });

        // ======== CẬP NHẬT ĐỊA CHỈ TỰ ĐỘNG ========
        wardSelect.addEventListener('change', updateFullAddress);
        streetInput.addEventListener('input', updateFullAddress);

        function updateFullAddress() {
            const street = streetInput.value.trim();
            const provinceText = provinceSelect.options[provinceSelect.selectedIndex]?.text || '';
            const districtText = districtSelect.options[districtSelect.selectedIndex]?.text || '';
            const wardText = wardSelect.options[wardSelect.selectedIndex]?.text || '';

            const parts = [street, wardText, districtText, provinceText].filter(Boolean);
            const fullAddress = parts.join(', ');

            if (fullAddress) {
                addressInput.value = fullAddress;
                fullAddressDiv.textContent = fullAddress;
                addressPreview.style.display = 'block';
            } else {
                addressPreview.style.display = 'none';
            }
        }

        // ======== CHỌN PHƯƠNG THỨC THANH TOÁN ========
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function () {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // ======== KIỂM TRA FORM TRƯỚC KHI GỬI ========
        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            const address = addressInput.value.trim();
            const province = provinceSelect.value;
            const district = districtSelect.value;
            const ward = wardSelect.value;

            if (!province || !district || !ward || !address) {
                e.preventDefault();
                alert('⚠️ Vui lòng nhập đầy đủ thông tin địa chỉ giao hàng!');
                return;
            }

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                e.preventDefault();
                alert('⚠️ Vui lòng chọn phương thức thanh toán!');
                return;
            }
        });
    </script>
@endsection