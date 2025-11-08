@extends('layouts.app')
@section('title', 'Đơn hàng của tôi')

@section('content')
<x-breadcrumb />
<style>
  .fishshop-container {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 16px;
  }

  .fishshop-header {
    margin-bottom: 40px;
  }

  .fishshop-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1a472a;
    margin: 0;
    padding-bottom: 12px;
    border-bottom: 3px solid #FFD700;
    display: inline-block;
    letter-spacing: -0.5px;
  }

  .fishshop-empty {
    text-align: center;
    padding: 80px 32px;
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    border-radius: 12px;
    border: 1px solid #d0e8dc;
  }

  .fishshop-empty p {
    font-size: 18px;
    color: #556b63;
    margin: 0 0 24px 0;
    font-weight: 500;
  }

  .fishshop-empty a {
    display: inline-block;
    color: #fff;
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  .fishshop-empty a:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(26, 71, 42, 0.3);
  }

  /* Changed from card grid to professional table layout */
  .fishshop-orders-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(26, 71, 42, 0.08);
  }

  .fishshop-orders-table thead {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
  }

  .fishshop-orders-table thead th {
    color: #fff;
    padding: 16px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .fishshop-orders-table tbody tr {
    border-bottom: 1px solid #e8f5f0;
    transition: background 0.2s ease;
  }

  .fishshop-orders-table tbody tr:hover {
    background: #f9fdfb;
  }

  .fishshop-orders-table tbody tr:last-child {
    border-bottom: none;
  }

  .fishshop-orders-table td {
    padding: 16px;
    font-size: 14px;
    color: #333;
  }

  .fishshop-order-id {
    font-weight: 700;
    color: #1a472a;
  }

  .fishshop-order-date {
    color: #666;
  }

  .fishshop-status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    white-space: nowrap;
  }

  .fishshop-status-pending {
    background: #fff3cd;
    color: #856404;
  }

  .fishshop-status-processing {
    background: #d1ecf1;
    color: #0c5460;
  }

  .fishshop-status-completed {
    background: #d4edda;
    color: #155724;
  }

  .fishshop-status-cancelled {
    background: #f8d7da;
    color: #721c24;
  }

  .fishshop-order-total {
    font-weight: 700;
    color: #1a472a;
  }

  /* Simplified action buttons - removed emojis */
  .fishshop-order-actions {
    display: flex;
    gap: 8px;
  }

  .fishshop-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .fishshop-btn-primary {
    color: #fff;
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
  }

  .fishshop-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(26, 71, 42, 0.25);
  }

  @media (max-width: 768px) {
    .fishshop-container {
      margin: 40px auto;
    }

    .fishshop-header h1 {
      font-size: 24px;
    }

    /* Stack table vertically on mobile */
    .fishshop-orders-table {
      font-size: 12px;
    }

    .fishshop-orders-table thead {
      display: none;
    }

    .fishshop-orders-table tbody tr {
      display: block;
      margin-bottom: 16px;
      border: 1px solid #d0e8dc;
      border-radius: 8px;
      background: #fff;
    }

    .fishshop-orders-table td {
      display: block;
      padding: 12px;
      text-align: right;
      border: none;
    }

    .fishshop-orders-table td:first-child {
      background: #f9fdfb;
      font-weight: 700;
      color: #1a472a;
    }

    .fishshop-orders-table td::before {
      content: attr(data-label);
      float: left;
      font-weight: 600;
      color: #666;
    }
  }
</style>

<div class="fishshop-container">
  <div class="fishshop-header">
    <h1>Đơn hàng của tôi</h1>
  </div>

  @if ($orders->isEmpty())
    <div class="fishshop-empty">
      <p>Bạn chưa có đơn hàng nào</p>
      <a href="{{ route('market.index') }}">Tiếp tục mua sắm</a>
    </div>
  @else
    <table class="fishshop-orders-table">
      <thead>
        <tr>
          <th>Mã đơn hàng</th>
          <th>Ngày đặt</th>
          <th>Trạng thái</th>
          <th>Tổng tiền</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td class="fishshop-order-id" data-label="Mã đơn hàng">#{{ $order->id }}</td>
            <td class="fishshop-order-date" data-label="Ngày đặt">{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td data-label="Trạng thái">
              <span class="fishshop-status-badge fishshop-status-{{ strtolower($order->status) }}">
                {{ ucfirst($order->status) }}
              </span>
            </td>
            <td class="fishshop-order-total" data-label="Tổng tiền">₫{{ number_format($order->total_amount, 0, ',', '.') }}</td>
            <td data-label="Hành động">
              <div class="fishshop-order-actions">
                <a href="{{ route('orders.show', $order->id) }}" class="fishshop-btn fishshop-btn-primary">
                  Xem chi tiết
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>

@endsection
