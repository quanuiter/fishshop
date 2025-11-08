@php
  $segments = request()->segments();
@endphp

@if (count($segments) > 0)
  <nav class="breadcrumb-overlay">
    <a href="{{ url('/') }}" style="color:#4a3f3fff;">Trang chủ</a>

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
        @php $product = \App\Models\Product::find($segments[$i+1]); @endphp
        <span>›</span><a href="{{ url('/product') }}">{{ $label }}</a>
        @if($product)
          <span>›</span><span>{{ $product->name }}</span>
        @endif
        @break
      @endif

      {{-- /orders/{id} -> hiện Đơn #id --}}
      @if ($segment === 'orders' && $hasNext)
        @php $order = \App\Models\Order::find($segments[$i+1]); @endphp
        <span>›</span><a href="{{ url('/orders') }}">{{ $label }}</a>
        @if($order)
          <span>›</span><span>Đơn #{{ $order->id }}</span>
        @endif
        @break
      @endif

      {{-- ✅ /orders (không có id) --}}
      @if ($segment === 'orders' && !$hasNext)
        <span>›</span><span>{{ $label }}</span>
      @endif

      {{-- (tuỳ cần) /product (không có id) --}}
      @if ($segment === 'product' && !$hasNext)
        <span>›</span><span>{{ $label }}</span>
      @endif

      {{-- Mặc định cho các segment khác --}}
      @if (!in_array($segment, ['product','orders']))
        <span>›</span>
        @if(!$loop->last)
          <a href="{{ url($url) }}">{{ $label }}</a>
        @else
          <span>{{ $label }}</span>
        @endif
      @endif
    @endforeach
  </nav>
@endif

<style>
.breadcrumb-overlay{
  position:absolute; top:80px; left:60px; z-index:5;
  color:#4a3f3fff; font-size:15px; font-weight:500;
  text-shadow:0 1px 3px rgba(0,0,0,.6);
}
.breadcrumb-overlay a{ color:#4a3f3fff; text-decoration:none; font-weight:600; }
.breadcrumb-overlay a:hover{ color:#fbbf24; }
.breadcrumb-overlay span{ margin:0 6px; }
</style>
