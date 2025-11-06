@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 48px 24px; background: #ffffff;">
  <!-- Updated header with better typography and spacing -->
  <div style="margin-bottom: 48px;">
    <h1 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin: 0 0 8px 0;">Giỏ hàng</h1>
    <p style="font-size: 14px; color: #666; margin: 0;">{{ count($cart) }} sản phẩm</p>
  </div>

  @if(count($cart))
    <!-- Two-column layout: cart items (left) and summary (right) -->
    <div style="display: grid; grid-template-columns: 1fr 380px; gap: 40px;">
      
      <!-- Cart Items Section -->
      <div>
        <!-- Cart items using card layout instead of table for better responsiveness -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
          @foreach($cart as $item)
          <div style="display: flex; gap: 20px; padding: 20px; border: 1px solid #e5e5e5; border-radius: 8px; background: #fff; transition: all 0.2s ease;">
            
            <!-- Product Image -->
            <div style="flex-shrink: 0;">
              <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px;">
            </div>

            <!-- Product Details -->
            <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
              <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #1a1a1a; margin: 0 0 6px 0;">{{ $item['name'] }}</h3>
                <p style="font-size: 13px; color: #888; margin: 0;">
                  @if($item['color'] || $item['size'])
                    <span>{{ $item['color'] ?? '' }} {{ $item['size'] ?? '' }}</span>
                  @endif
                </p>
              </div>
              <p style="font-size: 13px; font-weight: 600; color: #1a1a1a; margin: 0;">₫{{ number_format($item['price'], 0, ',', '.') }}</p>
            </div>

            <!-- Quantity Control & Remove -->
            <div style="display: flex; flex-direction: column; gap: 12px; align-items: flex-end;">
              <div style="display: flex; align-items: center; border: 1px solid #e5e5e5; border-radius: 4px; overflow: hidden;">
                <input type="number" value="{{ $item['quantity'] }}" min="1" style="width: 60px; padding: 8px; border: none; text-align: center; font-size: 14px;" onchange="updateQty('{{ $item['variant_id'] }}', this.value)">
              </div>
              <a href="{{ route('cart.remove', $item['variant_id']) }}" style="font-size: 12px; color: #d32f2f; text-decoration: none; font-weight: 500; cursor: pointer;">Xóa</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Order Summary Sidebar -->
      <div style="position: sticky; top: 24px; height: fit-content;">
        <div style="padding: 24px; border: 1px solid #e5e5e5; border-radius: 8px; background: #ffffff;">
          <h3 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin: 0 0 24px 0;">Tóm tắt đơn hàng</h3>
          
          <!-- Summary Items -->
          <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e5e5e5;">
            <div style="display: flex; justify-content: space-between; font-size: 14px;">
              <span style="color: #666;">Tổng tiền:</span>
              <span style="color: #1a1a1a; font-weight: 600;">₫{{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 14px;">
              <span style="color: #666;">Vận chuyển:</span>
              <span style="color: #1a1a1a; font-weight: 600;">Miễn phí</span>
            </div>
          </div>

          <!-- Total -->
          <div style="display: flex; justify-content: space-between; margin-bottom: 24px;">
            <span style="font-size: 16px; font-weight: 700; color: #1a1a1a;">Tổng cộng</span>
            <span style="font-size: 18px; font-weight: 700; color: #e8b923;">₫{{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <!-- Actions -->
          <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="#" style="display: block; padding: 12px 16px; background: #1a472a; color: #fff; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; transition: background 0.2s ease;">Thanh toán</a>
            <a href="/market" style="display: block; padding: 12px 16px; background: #f0f0f0; color: #1a1a1a; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; transition: background 0.2s ease;">Tiếp tục mua sắm</a>
            <a href="{{ route('cart.clear') }}" style="display: block; padding: 12px 16px; background: transparent; color: #d32f2f; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; border: 1px solid #d32f2f; transition: all 0.2s ease;">Xóa toàn bộ</a>
          </div>
        </div>
      </div>

    </div>

  @else
    <!-- Empty state -->
    <div style="text-align: center; padding: 80px 24px; background: #ffffff;">
      <svg style="width: 80px; height: 80px; margin: 0 auto 24px; opacity: 0.3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
      </svg>
      <h2 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0 0 12px 0;">Giỏ hàng trống</h2>
      <p style="font-size: 16px; color: #888; margin: 0 0 32px 0;">Hãy bắt đầu mua sắm để thêm sản phẩm vào giỏ</p>
      <a href="/market" style="display: inline-block; padding: 12px 32px; background: #1a472a; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 600; transition: background 0.2s ease;">Bắt đầu mua sắm</a>
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
    body: JSON.stringify({ variant_id: variantId, quantity: qty })
  });
}
</script>

<style>
@media (max-width: 768px) {
  [style*="grid-template-columns: 1fr 380px"] {
    grid-template-columns: 1fr !important;
  }
  
  [style*="position: sticky"] {
    position: static !important;
  }
}
</style>
@endsection
