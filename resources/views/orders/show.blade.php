@extends('layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<x-breadcrumb />
<style>
  .fishshop-container {
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    min-height: 100vh;
    padding: 40px 20px;
  }

  .content-wrapper {
    max-width: 1100px;
    margin: 0 auto;
  }

  /* Order Header - Elegant Design */
  .order-header {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    color: white;
    padding: 48px;
    border-radius: 20px;
    margin-bottom: 32px;
    box-shadow: 0 10px 40px rgba(26, 71, 42, 0.25);
    position: relative;
    overflow: hidden;
  }

  .order-header::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.15) 0%, transparent 70%);
    border-radius: 50%;
  }

  .order-header::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -80px;
    width: 250px;
    height: 250px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
    border-radius: 50%;
  }

  .order-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 20px;
    transition: all 0.3s;
    position: relative;
    z-index: 1;
  }

  .order-back-link:hover {
    color: #FFD700;
    transform: translateX(-4px);
  }

  .order-title-section {
    position: relative;
    z-index: 1;
    margin-bottom: 32px;
  }

  .order-title {
    font-size: 36px;
    font-weight: 700;
    margin: 0 0 12px 0;
    letter-spacing: -0.5px;
  }

  .order-subtitle {
    font-size: 15px;
    opacity: 0.9;
  }

  .order-meta-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    position: relative;
    z-index: 1;
  }

  .meta-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 24px;
    transition: all 0.3s ease;
  }

  .meta-card:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-4px);
  }

  .meta-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.85;
    margin-bottom: 8px;
  }

  .meta-value {
    font-size: 20px;
    font-weight: 700;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    margin-top: 6px;
  }

  .status-badge::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }

  .status-pending {
    background: #fcd34d;
    color: #78350f;
  }

  .status-pending::before {
    background: #f59e0b;
  }

  .status-processing {
    background: #93c5fd;
    color: #1e3a8a;
  }

  .status-processing::before {
    background: #3b82f6;
  }

  .status-completed {
    background: #86efac;
    color: #15803d;
  }

  .status-completed::before {
    background: #22c55e;
  }

  .status-cancelled {
    background: #fca5a5;
    color: #7f1d1d;
  }

  .status-cancelled::before {
    background: #ef4444;
  }

  /* Cards - Beautiful Design */
  .card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    margin-bottom: 24px;
    overflow: hidden;
    border: 1px solid rgba(26, 71, 42, 0.08);
    transition: all 0.3s ease;
  }

  .card:hover {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
  }

  .card-header {
    background: linear-gradient(135deg, #f9fdfb 0%, #f0f9f5 100%);
    padding: 28px 36px;
    border-bottom: 2px solid #e8f5f0;
  }

  .card-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a472a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .card-title::before {
    content: '';
    width: 4px;
    height: 28px;
    background: linear-gradient(180deg, #1a472a 0%, #FFD700 100%);
    border-radius: 2px;
  }

  .card-body {
    padding: 36px;
  }

  /* Info Grid - Clean Layout */
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 28px;
  }

  .info-item {
    padding: 24px;
    background: linear-gradient(135deg, #f9fdfb 0%, #f0f9f5 100%);
    border-radius: 16px;
    border-left: 4px solid #1a472a;
    transition: all 0.3s ease;
  }

  .info-item:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 16px rgba(26, 71, 42, 0.1);
  }

  .info-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #6b7280;
    letter-spacing: 0.8px;
    margin-bottom: 8px;
  }

  .info-value {
    font-size: 16px;
    font-weight: 600;
    color: #1a472a;
    line-height: 1.6;
  }

  /* Products Table - Modern Style */
  .products-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  .products-table thead {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
  }

  .products-table thead th {
    padding: 18px 24px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: white;
    letter-spacing: 1px;
    border: none;
  }

  .products-table thead th:first-child {
    border-radius: 12px 0 0 0;
  }

  .products-table thead th:last-child {
    border-radius: 0 12px 0 0;
    text-align: right;
  }

  .products-table tbody tr {
    cursor: pointer;
    transition: all 0.2s ease;
    border-bottom: 1px solid #f0f9f5;
  }

  .products-table tbody tr:hover {
    background: linear-gradient(90deg, #f9fdfb 0%, #f0f9f5 100%);
    transform: translateX(4px);
  }

  .products-table tbody tr:last-child {
    border-bottom: none;
  }

  .products-table tbody td {
    padding: 22px 24px;
    font-size: 15px;
    color: #374151;
  }

  .product-name {
    font-weight: 600;
    color: #1a472a;
  }

  .quantity-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
  }

  .price-right {
    text-align: right;
    font-weight: 600;
    color: #1a472a;
    font-variant-numeric: tabular-nums;
  }

  /* Order Summary - Highlighted */
  .order-summary {
    margin-top: 32px;
    padding: 32px;
    background: linear-gradient(135deg, #f9fdfb 0%, #f0f9f5 100%);
    border-radius: 16px;
    border: 2px solid #d0e8dc;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
  }

  .summary-label {
    font-size: 15px;
    color: #6b7280;
    font-weight: 500;
  }

  .summary-value {
    font-size: 16px;
    font-weight: 600;
    color: #1a472a;
    font-variant-numeric: tabular-nums;
  }

  .summary-total {
    margin-top: 16px;
    padding-top: 20px;
    border-top: 2px solid #d0e8dc;
  }

  .summary-total .summary-label {
    font-size: 18px;
    font-weight: 700;
    color: #1a472a;
  }

  .summary-total .summary-value {
    font-size: 32px;
    font-weight: 700;
    color: #1a472a;
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 80px 40px;
  }

  .empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
  }

  .empty-text {
    font-size: 16px;
    color: #6b7280;
  }

  /* Action Buttons */
  .action-section {
    display: flex;
    gap: 12px;
    margin-top: 32px;
  }

  .btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: white;
    color: #1a472a;
    border: 2px solid #1a472a;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(26, 71, 42, 0.1);
  }

  .btn-back:hover {
    background: #1a472a;
    color: white;
    transform: translateX(-4px);
    box-shadow: 0 4px 16px rgba(26, 71, 42, 0.2);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .fishshop-container {
      padding: 24px 16px;
    }

    .order-header {
      padding: 32px 24px;
    }

    .order-title {
      font-size: 26px;
    }

    .order-meta-cards {
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .meta-card {
      padding: 20px;
    }

    .card-header,
    .card-body {
      padding: 24px 20px;
    }

    .info-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .products-table {
      display: block;
      overflow-x: auto;
    }

    .products-table thead {
      display: none;
    }

    .products-table tbody,
    .products-table tr {
      display: block;
    }

    .products-table tbody tr {
      margin-bottom: 16px;
      border: 1px solid #e8f5f0;
      border-radius: 12px;
      padding: 16px;
    }

    .products-table tbody td {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid #f0f9f5;
    }

    .products-table tbody td:last-child {
      border-bottom: none;
    }

    .products-table tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #6b7280;
      font-size: 12px;
      text-transform: uppercase;
    }

    .product-name,
    .price-right {
      text-align: right;
    }

    .order-summary {
      padding: 24px 20px;
    }

    .summary-total .summary-value {
      font-size: 26px;
    }

    .action-section {
      flex-direction: column;
    }

    .btn-back {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<div class="fishshop-container">
  <div class="content-wrapper">
    <!-- Order Header -->
    <div class="order-header">
      <div class="order-title-section">
        <h1 class="order-title">Đơn hàng #{{ $order->id }}</h1>
        <div class="order-subtitle">Đặt hàng ngày {{ $order->created_at->format('d/m/Y') }} lúc {{ $order->created_at->format('H:i') }}</div>
      </div>

      <div class="order-meta-cards">
        <div class="meta-card">
          <div class="meta-label">Trạng thái</div>
          <div class="meta-value">
            <span class="status-badge status-{{ $order->status }}">
              @switch($order->status)
                @case('pending')
                  Chờ xác nhận
                  @break
                @case('processing')
                  Đang xử lý
                  @break
                @case('completed')
                  Hoàn thành
                  @break
                @case('cancelled')
                  Đã hủy
                  @break
                @default
                  {{ ucfirst($order->status) }}
              @endswitch
            </span>
          </div>
        </div>
        
        <div class="meta-card">
          <div class="meta-label">Số lượng sản phẩm</div>
          <div class="meta-value">{{ $order->items->sum('quantity') }} sản phẩm</div>
        </div>
        
        <div class="meta-card">
          <div class="meta-label">Tổng tiền</div>
          <div class="meta-value">₫{{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>
      </div>
    </div>

    <!-- Customer Information -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Thông tin giao hàng</h2>
      </div>
      <div class="card-body">
        <div class="info-grid">
          <div class="info-item">
            <div class="info-label">Người nhận</div>
            <div class="info-value">{{ $order->name }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">Số điện thoại</div>
            <div class="info-value">{{ $order->phone }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">Địa chỉ giao hàng</div>
            <div class="info-value">{{ $order->address }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Products -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Chi tiết sản phẩm ({{ $order->items->count() }})</h2>
      </div>
      <div class="card-body" style="padding: 0;">
        @if($order->items && $order->items->count() > 0)
          <table class="products-table">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th style="text-align: center;">Số lượng</th>
                <th style="text-align: right;">Đơn giá</th>
                <th style="text-align: right;">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->items as $item)
                <tr onclick="window.location='{{ route('product.show', $item->product->id ?? 0) }}'">
                  <td class="product-name" data-label="Sản phẩm">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                  <td style="text-align: center;" data-label="Số lượng">
                    <span class="quantity-badge">{{ $item->quantity }}</span>
                  </td>
                  <td class="price-right" data-label="Đơn giá">₫{{ number_format($item->price, 0, ',', '.') }}</td>
                  <td class="price-right" data-label="Thành tiền">₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="order-summary">
            <div class="summary-row">
              <div class="summary-label">Tạm tính</div>
              <div class="summary-value">₫{{ number_format($order->total_amount, 0, ',', '.') }}</div>
            </div>
            <div class="summary-row">
              <div class="summary-label">Phí vận chuyển</div>
              <div class="summary-value">Miễn phí</div>
            </div>
            
    @if($order->promotion_id)
        <div class="summary-row">
            <div class="summary-label">
                Mã giảm giá ({{ $order->promotion->name }} – {{ $order->promotion->percent }}%)
            </div>
            <div class="summary-value" style="color:#d9534f;">
                - ₫{{ number_format($order->discount_amount, 0, ',', '.') }}
            </div>
        </div>
    @endif
            <div class="summary-row summary-total">
              <div class="summary-label">Tổng cộng</div>
              <div class="summary-value">₫{{ number_format($order->final_amount, 0, ',', '.') }}</div>
            </div>
          </div>
        @else
          <div class="empty-state">
            <div class="empty-icon">📦</div>
            <div class="empty-text">Đơn hàng không có sản phẩm nào</div>
          </div>
        @endif
      </div>
    </div>

    <!-- Actions -->
    <div class="action-section">
      <a href="{{ route('orders.index') }}" class="btn-back">
        Quay lại danh sách
      </a>
    </div>
  </div>
</div>

@endsection