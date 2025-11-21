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

  /* Cards */
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
    display: flex;
    justify-content: space-between;
    align-items: center;
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

  /* Info Grid */
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
    position: relative;
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

  /* Editable Input */
  .info-value input {
    width: 100%;
    padding: 12px;
    border: 2px solid #d0e8dc;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    color: #1a472a;
    transition: all 0.3s ease;
  }

  .info-value input:focus {
    outline: none;
    border-color: #1a472a;
    box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
  }

  /* Products Table */
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

  /* Order Summary */
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

  /* Action Buttons */
  .action-section {
    display: flex;
    gap: 12px;
    margin-top: 32px;
    flex-wrap: wrap;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
  }

  .btn-back {
    background: white;
    color: #1a472a;
    border: 2px solid #1a472a;
  }

  .btn-back:hover {
    background: #1a472a;
    color: white;
    transform: translateX(-4px);
  }

  .btn-edit {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
  }

  .btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
  }

  .btn-save {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    color: white;
  }

  .btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(34, 197, 94, 0.3);
  }

  .btn-cancel-edit {
    background: #e5e7eb;
    color: #374151;
  }

  .btn-cancel-edit:hover {
    background: #d1d5db;
  }

  .btn-cancel-order {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
  }

  .btn-cancel-order:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
  }

  .btn-contact {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
  }

  .btn-contact:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);
  }

  /* Alert Box */
  .alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    line-height: 1.6;
  }

  .alert-info {
    background: #dbeafe;
    color: #1e40af;
    border-left: 4px solid #3b82f6;
  }

  .alert-warning {
    background: #fef3c7;
    color: #92400e;
    border-left: 4px solid #f59e0b;
  }

  .alert-icon {
    font-size: 20px;
  }

  /* Hidden class */
  .hidden {
    display: none !important;
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

    .card-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
      padding: 24px 20px;
    }

    .card-body {
      padding: 24px 20px;
    }

    .info-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .action-section {
      flex-direction: column;
    }

    .btn {
      width: 100%;
      justify-content: center;
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

    <!-- Alert Messages -->
    @if(session('success'))
      <div class="alert alert-info">
        <span class="alert-icon">✓</span>
        <div>{{ session('success') }}</div>
      </div>
    @endif

    @if($order->status === 'pending')
      <div class="alert alert-info">
        <span class="alert-icon">ℹ</span>
        <div>
          <strong>Đơn hàng đang chờ xác nhận.</strong> 
          Bạn có thể chỉnh sửa thông tin giao hàng hoặc hủy đơn hàng trong thời gian này.
        </div>
      </div>
    @elseif($order->status === 'processing')
      <div class="alert alert-warning">
        <span class="alert-icon">⚠</span>
        <div>
          <strong>Đơn hàng đang được xử lý.</strong> 
          Nếu cần thay đổi thông tin, vui lòng liên hệ với chúng tôi để được hỗ trợ.
        </div>
      </div>
    @endif

    <!-- Customer Information -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Thông tin giao hàng</h2>
        @if(in_array($order->status, ['pending', 'processing']))
          <button id="btnEditInfo" class="btn btn-edit" onclick="toggleEditMode()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Chỉnh sửa
          </button>
        @endif
      </div>
      <div class="card-body">
        <form id="formEditInfo" action="{{ route('orders.update', $order->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="info-grid">
            <div class="info-item">
              <div class="info-label">Người nhận</div>
              <div class="info-value">
                <span id="displayName">{{ $order->name }}</span>
                <input type="text" name="name" value="{{ $order->name }}" class="hidden" id="inputName" required>
              </div>
            </div>
            <div class="info-item">
              <div class="info-label">Số điện thoại</div>
              <div class="info-value">
                <span id="displayPhone">{{ $order->phone }}</span>
                <input type="text" name="phone" value="{{ $order->phone }}" class="hidden" id="inputPhone" required>
              </div>
            </div>
            <div class="info-item">
              <div class="info-label">Địa chỉ giao hàng</div>
              <div class="info-value">
                <span id="displayAddress">{{ $order->address }}</span>
                <input type="text" name="address" value="{{ $order->address }}" class="hidden" id="inputAddress" required>
              </div>
            </div>
          </div>

          <div id="editActions" class="action-section hidden" style="margin-top: 24px;">
            <button type="submit" class="btn btn-save">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              Lưu thay đổi
            </button>
            <button type="button" class="btn btn-cancel-edit" onclick="cancelEdit()">
              Hủy bỏ
            </button>
          </div>
        </form>
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
                  <td class="product-name" data-label="Sản phẩm">
                    {{ $item->product->name ?? 'Sản phẩm đã xóa' }}
<small style="display:block; color:#6b7280; font-size:13px;">
  @if($item->variant)
    {{ $item->variant->color ?: '' }}{{ ($item->variant->color && $item->variant->size) ? ' · ' : '' }}{{ $item->variant->size ?: '' }}
  @else
    Không có biến thể
  @endif
</small>
                  </td>
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
        @endif
      </div>
    </div>

    <!-- Actions -->
    <div class="action-section">
      <a href="{{ route('orders.index') }}" class="btn btn-back">
        ← Quay lại danh sách
      </a>

      @if($order->status === 'pending')
        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
          @csrf
          @method('PUT')
          <button type="submit" class="btn btn-cancel-order">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Hủy đơn hàng
          </button>
        </form>
      @endif

      @if(in_array($order->status, ['processing']))
        <a href="mailto:support@example.com?subject=Yêu cầu thay đổi đơn hàng #{{ $order->id }}" class="btn btn-contact">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          Liên hệ hỗ trợ
        </a>
      @endif
    </div>
  </div>
</div>

<script>
  let isEditMode = false;
  const originalValues = {
    name: '{{ $order->name }}',
    phone: '{{ $order->phone }}',
    address: '{{ $order->address }}'
  };

  function toggleEditMode() {
    isEditMode = true;
    
    // Hide display elements
    document.getElementById('displayName').classList.add('hidden');
    document.getElementById('displayPhone').classList.add('hidden');
    document.getElementById('displayAddress').classList.add('hidden');
    
    // Show input elements
    document.getElementById('inputName').classList.remove('hidden');
    document.getElementById('inputPhone').classList.remove('hidden');
    document.getElementById('inputAddress').classList.remove('hidden');
    
    // Show action buttons, hide edit button
    document.getElementById('editActions').classList.remove('hidden');
    document.getElementById('btnEditInfo').classList.add('hidden');
  }

  function cancelEdit() {
    isEditMode = false;
    
    // Restore original values
    document.getElementById('inputName').value = originalValues.name;
    document.getElementById('inputPhone').value = originalValues.phone;
    document.getElementById('inputAddress').value = originalValues.address;
    
    // Show display elements
    document.getElementById('displayName').classList.remove('hidden');
    document.getElementById('displayPhone').classList.remove('hidden');
    document.getElementById('displayAddress').classList.remove('hidden');
    
    // Hide input elements
    document.getElementById('inputName').classList.add('hidden');
    document.getElementById('inputPhone').classList.add('hidden');
    document.getElementById('inputAddress').classList.add('hidden');
    
    // Hide action buttons, show edit button
    document.getElementById('editActions').classList.add('hidden');
    document.getElementById('btnEditInfo').classList.remove('hidden');
  }
</script>

@endsection