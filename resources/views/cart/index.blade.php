@extends('layouts.app')

@section('title', 'Giỏ hàng')

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
    --danger: #d32f2f;
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

  .cart-container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 48px 24px;
  }

  /* Header Section */
  .cart-header {
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 24px;
    border-bottom: 2px solid var(--border-color);
  }

  .cart-header-left h1 {
    font-size: 32px;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 8px;
  }

  .cart-header-left p {
    font-size: 14px;
    color: var(--neutral-gray);
    font-weight: 500;
  }

  .continue-shopping {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all var(--transition);
  }

  .continue-shopping:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
  }

  /* Two Column Layout */
  .cart-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 32px;
    align-items: start;
  }

  /* Cart Items Section */
  .cart-items {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .cart-item {
    display: grid;
    grid-template-columns: 120px 1fr auto;
    gap: 20px;
    padding: 24px;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    transition: all var(--transition);
    position: relative;
  }

  .cart-item:hover {
    border-color: var(--accent-light);
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
  }

  .cart-item-image {
    width: 120px;
    height: 120px;
    border-radius: 8px;
    overflow: hidden;
    background: var(--neutral-light);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 8px;
  }

  .cart-item-details {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 12px;
  }

  .cart-item-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 6px;
    line-height: 1.4;
  }

  .cart-item-variant {
    font-size: 13px;
    color: var(--neutral-gray);
    font-weight: 500;
    background: var(--neutral-light);
    padding: 4px 12px;
    border-radius: 20px;
    display: inline-block;
    width: fit-content;
  }

  .cart-item-price {
    font-size: 18px;
    font-weight: 700;
    color: var(--accent);
  }

  .cart-item-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: flex-end;
  }

  .quantity-control {
    display: flex;
    align-items: center;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    overflow: hidden;
    background: white;
    transition: all 0.25s ease;
  }

  .quantity-control:focus-within {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(232, 185, 35, 0.1);
  }

  .qty-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: white;
    cursor: pointer;
    font-weight: 700;
    color: var(--primary);
    transition: all 0.2s ease;
    font-size: 16px;
  }

  .qty-btn:hover {
    background: var(--neutral-light);
  }

  .qty-input {
    width: 50px;
    height: 36px;
    border: none;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
    border-left: 1px solid var(--border-color);
    border-right: 1px solid var(--border-color);
    background: white;
  }

  .qty-input:focus {
    outline: none;
  }

  .remove-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: transparent;
    color: var(--danger);
    border: 1px solid var(--danger);
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 12px;
    transition: all var(--transition);
    cursor: pointer;
  }

  .remove-btn:hover {
    background: var(--danger);
    color: white;
    transform: scale(1.05);
  }

  /* Order Summary Sidebar */
  .order-summary {
    position: sticky;
    top: 24px;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 28px;
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

  .summary-items {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border-color);
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
  }

  .summary-row .label {
    color: var(--neutral-gray);
    font-weight: 500;
  }

  .summary-row .value {
    color: var(--neutral-dark);
    font-weight: 600;
  }

  .summary-row.shipping .value {
    color: var(--success);
    font-weight: 700;
  }

  .summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(232, 185, 35, 0.08) 0%, rgba(232, 185, 35, 0.03) 100%);
    border-radius: 8px;
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

  .summary-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .btn {
    display: block;
    padding: 14px 20px;
    border-radius: 8px;
    text-align: center;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: all var(--transition);
    cursor: pointer;
    border: none;
    position: relative;
    overflow: hidden;
  }

  .btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transition: left 0.3s ease;
  }

  .btn:hover::before {
    left: 100%;
  }

  .btn-primary {
    background: var(--primary);
    color: white;
  }

  .btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 71, 42, 0.25);
  }

  .btn-secondary {
    background: var(--accent);
    color: var(--primary);
  }

  .btn-secondary:hover {
    background: var(--accent-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(232, 185, 35, 0.25);
  }

  .btn-danger {
    background: transparent;
    color: var(--danger);
    border: 2px solid var(--danger);
  }

  .btn-danger:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
  }

  /* Empty State */
  .empty-cart {
    text-align: center;
    padding: 100px 24px;
    background: var(--bg-light);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
  }

  .empty-cart-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 32px;
    opacity: 0.3;
    color: var(--neutral-gray);
  }

  .empty-cart h2 {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 12px;
  }

  .empty-cart p {
    font-size: 16px;
    color: var(--neutral-gray);
    margin-bottom: 32px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
  }

  .empty-cart .btn {
    display: inline-block;
    padding: 14px 40px;
  }

  /* Animations */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .cart-item {
    animation: fadeInUp 0.4s ease backwards;
  }

  .cart-item:nth-child(1) { animation-delay: 0.1s; }
  .cart-item:nth-child(2) { animation-delay: 0.15s; }
  .cart-item:nth-child(3) { animation-delay: 0.2s; }
  .cart-item:nth-child(4) { animation-delay: 0.25s; }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .cart-layout {
      grid-template-columns: 1fr;
    }

    .order-summary {
      position: static;
    }
  }

  @media (max-width: 768px) {
    .cart-container {
      padding: 24px 16px;
    }

    .cart-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
    }

    .cart-header-left h1 {
      font-size: 24px;
    }

    .cart-item {
      grid-template-columns: 80px 1fr;
      gap: 16px;
      padding: 16px;
    }

    .cart-item-image {
      width: 80px;
      height: 80px;
    }

    .cart-item-actions {
      grid-column: 1 / -1;
      flex-direction: row;
      justify-content: space-between;
      width: 100%;
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid var(--border-color);
    }

    .cart-item-name {
      font-size: 14px;
    }

    .cart-item-price {
      font-size: 16px;
    }

    .order-summary {
      padding: 20px;
    }

    .summary-title {
      font-size: 18px;
    }

    .summary-total .value {
      font-size: 20px;
    }

    .empty-cart {
      padding: 60px 24px;
    }

    .empty-cart h2 {
      font-size: 22px;
    }
  }
</style>

<div class="cart-container">
  @if(count($cart))
    <!-- Header with title and continue shopping button -->
    <div class="cart-header">
      <div class="cart-header-left">
        <h1>Giỏ hàng của bạn</h1>
        <p>{{ count($cart) }} sản phẩm</p>
      </div>
      <a href="/market" class="continue-shopping">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Tiếp tục mua sắm
      </a>
    </div>

    <!-- Two column layout -->
    <div class="cart-layout">
      
      <!-- Cart Items List -->
      <div class="cart-items">
        @foreach($cart as $item)
        <div class="cart-item">
          
          <!-- Product Image -->
          <div class="cart-item-image">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
          </div>

          <!-- Product Details -->
          <div class="cart-item-details">
            <div>
              <h3 class="cart-item-name">{{ $item['name'] }}</h3>
              @if($item['color'] || $item['size'])
              <span class="cart-item-variant">
                {{ $item['color'] ?? '' }} {{ $item['size'] ?? '' }}
              </span>
              @endif
            </div>
            <div class="cart-item-price">
              ₫{{ number_format($item['price'], 0, ',', '.') }}
            </div>
          </div>

          <!-- Quantity & Remove Actions -->
          <div class="cart-item-actions">
            <div class="quantity-control">
              <button class="qty-btn" onclick="decreaseQty('{{ $item['variant_id'] }}', {{ $item['quantity'] }})">−</button>
              <input type="number" class="qty-input" id="qty-{{ $item['variant_id'] }}" value="{{ $item['quantity'] }}" min="1" readonly>
              <button class="qty-btn" onclick="increaseQty('{{ $item['variant_id'] }}', {{ $item['quantity'] }})">+</button>
            </div>
            <a href="{{ route('cart.remove', $item['variant_id']) }}" class="remove-btn">
              <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
              Xóa
            </a>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Order Summary Sidebar -->
      <div class="order-summary">
        <h3 class="summary-title">Tóm tắt đơn hàng</h3>
        
        <!-- Summary Items -->
        <div class="summary-items">
          <div class="summary-row">
            <span class="label">Tạm tính</span>
            <span class="value">₫{{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="summary-row shipping">
            <span class="label">Phí vận chuyển</span>
            <span class="value">Miễn phí</span>
          </div>
        </div>

        <!-- Total -->
        <div class="summary-total">
          <span class="label">Tổng cộng</span>
          <span class="value">₫{{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <!-- Action Buttons -->
        <div class="summary-actions">
          <a href="{{ route('checkout.index') }}" class="btn btn-primary">Thanh toán ngay</a>
          <a href="/market" class="btn btn-secondary">Tiếp tục mua sắm</a>
          <a href="{{ route('cart.clear') }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">Xóa toàn bộ</a>
        </div>
      </div>

    </div>

  @else
    <!-- Empty Cart State -->
    <div class="empty-cart">
      <svg class="empty-cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
      </svg>
      <h2>Giỏ hàng trống</h2>
      <p>Bạn chưa có sản phẩm nào trong giỏ hàng. Hãy khám phá và thêm những sản phẩm yêu thích của bạn!</p>
      <a href="/market" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; margin-right: 8px; vertical-align: middle;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Bắt đầu mua sắm
      </a>
    </div>
  @endif
</div>

<script>
function updateQty(variantId, qty) {
  fetch('{{ route("cart.update") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ variant_id: variantId, quantity: parseInt(qty) })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      alert(data.message || 'Có lỗi xảy ra!');
    }
  })
  .catch(err => {
    console.error('Error:', err);
    alert('Có lỗi xảy ra khi cập nhật giỏ hàng!');
  });
}

function increaseQty(variantId, currentQty) {
  const input = document.getElementById('qty-' + variantId);
  const maxStock = parseInt(input.getAttribute('max') || 9999);
  const newQty = parseInt(currentQty) + 1;

  if (newQty > maxStock) {
    alert('Không đủ hàng trong kho!');
    return;
  }

  input.value = newQty;
  updateQty(variantId, newQty);
}

function decreaseQty(variantId, currentQty) {
  if (parseInt(currentQty) > 1) {
    const newQty = parseInt(currentQty) - 1;
    const input = document.getElementById('qty-' + variantId);
    if (input) {
      input.value = newQty;
    }
    updateQty(variantId, newQty);
  }
}
</script>

@endsection