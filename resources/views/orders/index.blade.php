@extends('layouts.app')
@section('title', 'Đơn hàng của tôi')

@section('content')
<x-breadcrumb />
<style>
  .fishshop-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
  }

  .fishshop-header {
    margin-bottom: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 20px;
    border-bottom: 2px solid #e8f5f0;
  }

  .fishshop-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1a472a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .fishshop-header h1::before {
    content: '';
    width: 4px;
    height: 32px;
    background: linear-gradient(180deg, #1a472a 0%, #FFD700 100%);
    border-radius: 2px;
  }

  .fishshop-order-stats {
    display: flex;
    gap: 24px;
    font-size: 14px;
  }

  .fishshop-stat-item {
    text-align: center;
  }

  .fishshop-stat-number {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #1a472a;
    margin-bottom: 4px;
  }

  .fishshop-stat-label {
    color: #666;
    font-size: 13px;
  }

  .fishshop-empty {
    text-align: center;
    padding: 100px 32px;
    background: #fff;
    border-radius: 16px;
    border: 2px dashed #d0e8dc;
    margin-top: 40px;
  }

  .fishshop-empty-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
  }

  .fishshop-empty p {
    font-size: 18px;
    color: #556b63;
    margin: 0 0 28px 0;
    font-weight: 500;
  }

  .fishshop-empty a {
    display: inline-block;
    color: #fff;
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    padding: 14px 32px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(26, 71, 42, 0.2);
  }

  .fishshop-empty a:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 71, 42, 0.3);
  }

  .fishshop-orders-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e8f5f0;
  }

  .fishshop-orders-table thead {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
  }

  .fishshop-orders-table thead th {
    color: #fff;
    padding: 18px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border: none;
  }

  .fishshop-orders-table tbody tr {
    border-bottom: 1px solid #f0f9f5;
    transition: all 0.2s ease;
  }

  .fishshop-orders-table tbody tr:hover {
    background: #f9fdfb;
    transform: translateX(2px);
    box-shadow: -3px 0 0 0 #1a472a;
  }

  .fishshop-orders-table tbody tr:last-child {
    border-bottom: none;
  }

  .fishshop-orders-table td {
    padding: 20px;
    font-size: 14px;
    color: #333;
    vertical-align: middle;
  }

  .fishshop-order-id {
    font-weight: 700;
    color: #1a472a;
    font-size: 15px;
    font-family: 'Courier New', monospace;
  }

  .fishshop-order-date {
    color: #666;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .fishshop-order-date-day {
    font-weight: 600;
    color: #333;
  }

  .fishshop-order-date-time {
    font-size: 12px;
    color: #999;
  }

  .fishshop-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    white-space: nowrap;
  }

  .fishshop-status-badge::before {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
  }

  .fishshop-status-pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
  }

  .fishshop-status-pending::before {
    background: #ffc107;
  }

  .fishshop-status-processing {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
  }

  .fishshop-status-processing::before {
    background: #17a2b8;
  }

  .fishshop-status-completed {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .fishshop-status-completed::before {
    background: #28a745;
  }

  .fishshop-status-cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .fishshop-status-cancelled::before {
    background: #dc3545;
  }

  .fishshop-order-total {
    font-weight: 700;
    color: #1a472a;
    font-size: 16px;
  }

  .fishshop-order-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
  }

  .fishshop-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
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
    box-shadow: 0 2px 8px rgba(26, 71, 42, 0.15);
  }

  .fishshop-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 71, 42, 0.25);
  }

  .fishshop-btn-primary::after {
    content: '→';
    font-size: 14px;
    transition: transform 0.2s ease;
  }

  .fishshop-btn-primary:hover::after {
    transform: translateX(3px);
  }

  /* Pagination if needed */
  .fishshop-pagination {
    display: flex;
    justify-content: center;
    margin-top: 32px;
    gap: 8px;
  }

  @media (max-width: 1024px) {
    .fishshop-order-stats {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .fishshop-container {
      margin: 24px auto;
      padding: 0 16px;
    }

    .fishshop-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
    }

    .fishshop-header h1 {
      font-size: 22px;
    }

    .fishshop-header h1::before {
      height: 28px;
    }

    .fishshop-empty {
      padding: 60px 24px;
    }

    .fishshop-empty-icon {
      width: 100px;
      height: 100px;
      font-size: 40px;
    }

    .fishshop-orders-table {
      border: none;
      box-shadow: none;
    }

    .fishshop-orders-table thead {
      display: none;
    }

    .fishshop-orders-table tbody tr {
      display: block;
      margin-bottom: 16px;
      border: 1px solid #e8f5f0;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .fishshop-orders-table tbody tr:hover {
      transform: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .fishshop-orders-table td {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
      border: none;
      border-bottom: 1px solid #f0f9f5;
    }

    .fishshop-orders-table td:last-child {
      border-bottom: none;
    }

    .fishshop-orders-table td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #666;
      font-size: 13px;
    }

    .fishshop-order-date {
      flex-direction: row;
      gap: 8px;
      text-align: right;
    }

    .fishshop-order-actions {
      width: 100%;
      justify-content: flex-start;
    }

    .fishshop-btn {
      flex: 1;
    }
  }
</style>

<div class="fishshop-container">
  <div class="fishshop-header">
    <h1>Đơn hàng của tôi</h1>
    @if (!$orders->isEmpty())
      <div class="fishshop-order-stats">
        <div class="fishshop-stat-item">
          <span class="fishshop-stat-number">{{ $orders->count() }}</span>
          <span class="fishshop-stat-label">Tổng đơn</span>
        </div>
      </div>
    @endif
  </div>

  @if ($orders->isEmpty())
    <div class="fishshop-empty">
      <div class="fishshop-empty-icon">🛒</div>
      <p>Bạn chưa có đơn hàng nào</p>
      <a href="{{ route('market.index') }}">Bắt đầu mua sắm</a>
    </div>
  @else
    <table class="fishshop-orders-table">
      <thead>
        <tr>
          <th>Mã đơn hàng</th>
          <th>Ngày đặt</th>
          <th>Trạng thái</th>
          <th>Tổng tiền</th>
          <th style="text-align: right;">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td class="fishshop-order-id" data-label="Mã đơn hàng">#{{ $order->id }}</td>
            <td data-label="Ngày đặt">
              <div class="fishshop-order-date">
                <span class="fishshop-order-date-day">{{ $order->created_at->format('d/m/Y') }}</span>
                <span class="fishshop-order-date-time">{{ $order->created_at->format('H:i') }}</span>
              </div>
            </td>
            <td data-label="Trạng thái">
              <span class="fishshop-status-badge fishshop-status-{{ strtolower($order->status) }}">
                {{ ucfirst($order->status) }}
              </span>
            </td>
            <td class="fishshop-order-total" data-label="Tổng tiền">₫{{ number_format($order->final_amount, 0, ',', '.') }}</td>
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