@extends('layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<x-breadcrumb />
<style>
    .clickable-row {
    cursor: pointer;
    transition: background 0.2s ease;
  }
  .clickable-row:hover {
    background-color: #f8faf8;
  }
  .fishshop-container {
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    min-height: 100vh;
    padding: 40px 20px;
  }

  .order-header {
    background: linear-gradient(135deg, #1a472a 0%, #16a34a 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    margin-bottom: 32px;
    box-shadow: 0 10px 30px rgba(26, 71, 42, 0.2);
  }

  .order-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .order-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    margin-top: 24px;
  }

  .meta-item {
    background: rgba(255, 255, 255, 0.1);
    padding: 16px;
    border-radius: 8px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .meta-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.85;
    margin-bottom: 6px;
  }

  .meta-value {
    font-size: 16px;
    font-weight: 600;
  }

  .status-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    text-transform: capitalize;
    margin-top: 8px;
  }

  .status-pending {
    background: #fcd34d;
    color: #78350f;
  }

  .status-processing {
    background: #93c5fd;
    color: #1e3a8a;
  }

  .status-completed {
    background: #86efac;
    color: #15803d;
  }

  .status-cancelled {
    background: #fca5a5;
    color: #7f1d1d;
  }

  .content-wrapper {
    max-width: 1000px;
    margin: 0 auto;
  }

  .card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    padding: 32px;
    margin-bottom: 24px;
    border: 1px solid #f0f0f0;
  }

  .card-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a472a;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .customer-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
  }

  .info-block {
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
  }

  .info-block:last-child {
    border-bottom: none;
  }

  .info-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
  }

  .info-value {
    font-size: 15px;
    font-weight: 600;
    color: #1a472a;
  }

  .products-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  .table-header {
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    border-radius: 8px 8px 0 0;
  }

  .table-header th {
    padding: 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    color: #1a472a;
    letter-spacing: 0.5px;
  }

  .table-body tr {
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.3s ease;
  }

  .table-body tr:hover {
    background-color: #f9fafb;
  }

  .table-body td {
    padding: 18px 16px;
    font-size: 14px;
    color: #374151;
  }

  .product-name {
    font-weight: 600;
    color: #1a472a;
  }

  .quantity-center {
    text-align: center;
    font-weight: 600;
    color: #16a34a;
  }

  .price-right {
    text-align: right;
    font-weight: 600;
    color: #1a472a;
  }

  .table-footer {
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    border-radius: 0 0 8px 8px;
  }

  .summary-section {
    display: flex;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 2px solid #f0f0f0;
  }

  .summary-content {
    text-align: right;
  }

  .summary-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
  }

  .total-amount {
    font-size: 28px;
    font-weight: 700;
    background: linear-gradient(135deg, #1a472a 0%, #16a34a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .action-section {
    display: flex;
    gap: 12px;
    margin-top: 32px;
    justify-content: space-between;
  }

  .btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: white;
    color: #1a472a;
    border: 2px solid #1a472a;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .btn-back:hover {
    background: #f0fdf4;
    transform: translateX(-4px);
  }

  @media (max-width: 768px) {
    .order-header {
      padding: 24px;
    }

    .order-title {
      font-size: 24px;
    }

    .order-meta {
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .card {
      padding: 20px;
    }

    .customer-info {
      grid-template-columns: 1fr;
    }

    .table-header th,
    .table-body td {
      padding: 12px 8px;
      font-size: 12px;
    }

    .total-amount {
      font-size: 22px;
    }

    .action-section {
      flex-direction: column;
    }
  }
</style>

<div class="fishsh-container">
  <div class="content-wrapper">
    <!-- Order Header -->
     <div><br></div>
     <div><br></div>
    <div class="order-header">
      <div class="order-title">
        🐟 Đơn hàng #{{ $order->id }}
      </div>
      <div class="order-meta">
        <div class="meta-item">
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
        <div class="meta-item">
          <div class="meta-label">Ngày đặt</div>
          <div class="meta-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
        </div>
        <div class="meta-item">
          <div class="meta-label">Tổng cộng</div>
          <div class="meta-value">₫{{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>
      </div>
    </div>

    <!-- Customer Information -->
    <div class="card">
      <div class="card-title">👤 Thông tin khách hàng</div>
      <div class="customer-info">
        <div class="info-block">
          <div class="info-label">Tên người nhận</div>
          <div class="info-value">{{ $order->name }}</div>
        </div>
        <div class="info-block">
          <div class="info-label">Số điện thoại</div>
          <div class="info-value">{{ $order->phone }}</div>
        </div>
        <div class="info-block">
          <div class="info-label">Địa chỉ giao hàng</div>
          <div class="info-value">{{ $order->address }}</div>
        </div>
      </div>
    </div>

    <!-- Products Table -->
    <div class="card">
      <div class="card-title">🛒 Chi tiết sản phẩm</div>
      @if($order->items && $order->items->count() > 0)
        <table class="products-table">
          <thead class="table-header">
            <tr>
              <th>Sản phẩm</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
            </tr>
          </thead>
          <tbody class="table-body">
            @foreach ($order->items as $item)
              <tr class="clickable-row" data-url="{{ route('product.show', $item->product->id ?? 0) }}">
                <td class="product-name">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                <td class="quantity-center">{{ $item->quantity }}</td>
                <td class="price-right">₫{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="price-right">₫{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
          <div class="summary-content">
            <div class="summary-label">💰 Tổng cộng</div>
            <div class="total-amount">₫{{ number_format($order->total_amount, 0, ',', '.') }}</div>
          </div>
        </div>
      @else
        <div style="text-align: center; padding: 40px; color: #64748b;">
          <p style="font-size: 16px;">Đơn hàng không có sản phẩm nào.</p>
        </div>
      @endif
    </div>

    <!-- Actions -->
    <div class="action-section">
      <a href="{{ route('orders.index') }}" class="btn-back">
        ← Quay lại danh sách
      </a>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', () => {
      const url = row.getAttribute('data-url');
      if (url && !url.endsWith('/0')) window.location.href = url;
    });
  });
</script>
@endsection
