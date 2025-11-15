<style>
  .breadcrumb-container {
    background: linear-gradient(135deg, #f9fdfb 0%, #f0f9f5 100%);
    border-bottom: 1px solid #e8f5f0;
    padding: 10px 0;
  }

  .breadcrumb-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .breadcrumb-nav {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 14px;
  }

  .breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .breadcrumb-link {
    color: #6b7280;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    padding: 4px 8px;
    border-radius: 6px;
  }

  .breadcrumb-link:hover {
    color: #1a472a;
    background: rgba(26, 71, 42, 0.05);
  }

  .breadcrumb-home {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #6b7280;
    text-decoration: none;
    font-weight: 500;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
  }

  .breadcrumb-home:hover {
    color: #1a472a;
    background: rgba(26, 71, 42, 0.05);
  }

  .breadcrumb-home svg {
    width: 16px;
    height: 16px;
    stroke: currentColor;
  }

  .breadcrumb-separator {
    color: #d1d5db;
    font-size: 18px;
    user-select: none;
  }

  .breadcrumb-current {
    color: #1a472a;
    font-weight: 600;
    padding: 4px 8px;
    background: rgba(26, 71, 42, 0.08);
    border-radius: 6px;
  }

  @media (max-width: 768px) {
    .breadcrumb-container {
      padding: 16px 0;
      margin-top: 16px;
    }

    .breadcrumb-wrapper {
      padding: 0 16px;
    }

    .breadcrumb-nav {
      font-size: 13px;
      gap: 6px;
    }

    .breadcrumb-separator {
      font-size: 16px;
    }
  }
</style>

@php
  $segments = request()->segments();
@endphp

@if (count($segments) > 0)
  <div class="breadcrumb-container">
    <div class="breadcrumb-wrapper">
      <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <div class="breadcrumb-item">
          <a href="{{ url('/') }}" class="breadcrumb-home">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Trang chủ
          </a>
        </div>

        @php
          $url = '';
          $names = [
            'market'   => 'Cửa hàng',
            'product'  => 'Sản phẩm',
            'orders'   => 'Đơn hàng',
            'checkout' => 'Thanh toán',
            'cart'     => 'Giỏ hàng',
          ];
        @endphp

        @foreach ($segments as $i => $segment)
          @php
            $url   .= '/'.$segment;
            $label  = $names[$segment] ?? ucfirst($segment);
            $hasNext = isset($segments[$i+1]);
          @endphp

          {{-- /product/{id} -> hiện tên sản phẩm --}}
          @if ($segment === 'product' && $hasNext)
            <span class="breadcrumb-separator">›</span>
            <div class="breadcrumb-item">
              <a href="{{ url('/market') }}" class="breadcrumb-link">Cửa hàng</a>
            </div>
            @php $product = \App\Models\Product::find($segments[$i+1]); @endphp
            @if($product)
              <span class="breadcrumb-separator">›</span>
              <div class="breadcrumb-item">
                <span class="breadcrumb-current">{{ $product->name }}</span>
              </div>
            @endif
            @break
          @endif

          {{-- /orders/{id} -> hiện Đơn #id --}}
          @if ($segment === 'orders' && $hasNext)
            <span class="breadcrumb-separator">›</span>
            <div class="breadcrumb-item">
              <a href="{{ url('/orders') }}" class="breadcrumb-link">{{ $label }}</a>
            </div>
            @php $order = \App\Models\Order::find($segments[$i+1]); @endphp
            @if($order)
              <span class="breadcrumb-separator">›</span>
              <div class="breadcrumb-item">
                <span class="breadcrumb-current">Đơn #{{ $order->id }}</span>
              </div>
            @endif
            @break
          @endif

          {{-- /orders (không có id) --}}
          @if ($segment === 'orders' && !$hasNext)
            <span class="breadcrumb-separator">›</span>
            <div class="breadcrumb-item">
              <span class="breadcrumb-current">{{ $label }}</span>
            </div>
          @endif

          {{-- /product (không có id) --}}
          @if ($segment === 'product' && !$hasNext)
            <span class="breadcrumb-separator">›</span>
            <div class="breadcrumb-item">
              <span class="breadcrumb-current">{{ $label }}</span>
            </div>
          @endif

          {{-- Mặc định cho các segment khác --}}
          @if (!in_array($segment, ['product','orders']))
            <span class="breadcrumb-separator">›</span>
            <div class="breadcrumb-item">
              @if(!$loop->last)
                <a href="{{ url($url) }}" class="breadcrumb-link">{{ $label }}</a>
              @else
                <span class="breadcrumb-current">{{ $label }}</span>
              @endif
            </div>
          @endif
        @endforeach
      </nav>
    </div>
  </div>
@endif