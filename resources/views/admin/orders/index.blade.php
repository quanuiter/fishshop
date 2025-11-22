<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Quản lý đơn hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> body { padding-top: 70px; } .badge-status{font-size:.85rem;} </style>
</head>
<body>
@include('layouts.header')

<div class="container py-4">
  @php
    $statusLabels = [
      'pending' => 'Chờ xác nhận',
      'confirmed' => 'Đang xử lý',
      'completed' => 'Hoàn thành',
      'cancelled' => 'Đã hủy',
    ];
    $statusColors = [
      'pending' => 'warning',
      'confirmed' => 'primary',
      'completed' => 'success',
      'cancelled' => 'danger',
    ];
    $filterStatuses = ['pending', 'confirmed', 'completed', 'cancelled'];
  @endphp
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Quản lý đơn hàng</h1>
  </div>

  <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-end mb-3">
    <div class="col-md-3">
      <label for="status" class="form-label mb-1">Trạng thái</label>
      <select name="status" id="status" class="form-select">
        <option value="" {{ empty($status) ? 'selected' : '' }}>- Tất cả -</option>
        @foreach($filterStatuses as $key)
          @php $label = $statusLabels[$key] ?? ucfirst($key); @endphp
          <option value="{{ $key }}" {{ ($status ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label for="category_id" class="form-label mb-1">Lọc theo danh mục</label>
      <select name="category_id" id="category_id" class="form-select">
        <option value="">- Tất cả danh mục -</option>
        @isset($categories)
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (string)($categoryId ?? '') === (string)$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-4">
      <label for="product_id" class="form-label mb-1">Lọc theo sản phẩm</label>
      <select name="product_id" id="product_id" class="form-select">
        <option value="">- Tất cả sản phẩm -</option>
        @isset($products)
          @foreach($products as $prod)
            <option value="{{ $prod->id }}" {{ (string)($productId ?? '') === (string)$prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
      <button type="submit" class="btn btn-success">Áp dụng</button>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
    </div>
  </form>

  <div class="card">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th style="width:80px">ID</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th style="width:300px">Hành động</th>
          </tr>
        </thead>
        <tbody id="ordersTableBody">
          @forelse($orders as $order)
            @php
              $primaryAction = $order->status === 'pending' ? 'confirm' : ($order->status === 'confirmed' ? 'complete' : null);
              $primaryLabel = $order->status === 'pending' ? 'Xác nhận' : ($order->status === 'confirmed' ? 'Hoàn thành' : 'Hoàn thành');
              $primaryDisabled = $primaryAction === null;
              $cancelDisabled = !in_array($order->status, ['pending','confirmed']);
            @endphp
            <tr id="order-row-{{ $order->id }}">
              <td>{{ $order->id }}</td>
              <td>
                <div class="fw-semibold">{{ $order->name }}</div>
                <div class="text-muted small">{{ $order->phone }} · {{ $order->address }}</div>
              </td>
              <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
              <td>
                @php
                  $label = $statusLabels[$order->status] ?? ucfirst($order->status);
                  $color = $statusColors[$order->status] ?? 'secondary';
                @endphp
                <span class="badge bg-{{ $color }} badge-status" id="order-status-{{ $order->id }}">{{ $label }}</span>
              </td>
              <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-sm btn-outline-secondary" onclick="toggleOrderItems({{ $order->id }})">Chi tiết</button>
                  <button class="btn btn-sm btn-success{{ in_array($order->status, ['completed','cancelled']) ? ' d-none' : '' }}" data-role="primary-action" data-action="{{ $primaryAction }}" onclick="{{ $primaryAction ? "updateOrderStatus({$order->id}, '{$primaryAction}')" : '' }}" {{ $primaryDisabled ? 'disabled' : '' }}>{{ $primaryLabel }}</button>
                  <button class="btn btn-sm btn-outline-danger{{ in_array($order->status, ['completed','cancelled']) ? ' d-none' : '' }}" data-role="cancel-action" onclick="updateOrderStatus({{ $order->id }}, 'cancel')" {{ $cancelDisabled ? 'disabled' : '' }}>Hủy</button>
                </div>
              </td>
            </tr>
            <tr id="order-items-row-{{ $order->id }}" class="d-none">
              <td colspan="6" id="order-items-cell-{{ $order->id }}">
                <div class="text-muted p-3">Đang tải...</div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-4">Không có đơn hàng.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">{{ $orders->links() }}</div>
</div>

<script>
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const statusLabelMap = {
    pending: 'Chờ xác nhận',
    confirmed: 'Đang xử lý',
    completed: 'Hoàn thành',
    cancelled: 'Đã hủy',
  };
  const statusColorMap = {
    pending: 'warning',
    confirmed: 'primary',
    completed: 'success',
    cancelled: 'danger',
  };

  function setActionButtons(orderId, statusKey) {
    const row = document.getElementById(`order-row-${orderId}`);
    if (!row) return;
    const primaryBtn = row.querySelector('[data-role="primary-action"]');
    const cancelBtn = row.querySelector('[data-role="cancel-action"]');
    if (!primaryBtn || !cancelBtn) return;

    primaryBtn.disabled = false;
    cancelBtn.disabled = false;
    primaryBtn.classList.remove('d-none');
    cancelBtn.classList.remove('d-none');

    if (statusKey === 'pending') {
      primaryBtn.textContent = 'Xác nhận';
      primaryBtn.dataset.action = 'confirm';
      primaryBtn.onclick = () => updateOrderStatus(orderId, 'confirm');
      cancelBtn.disabled = false;
    } else if (statusKey === 'confirmed') {
      primaryBtn.textContent = 'Hoàn thành';
      primaryBtn.dataset.action = 'complete';
      primaryBtn.onclick = () => updateOrderStatus(orderId, 'complete');
      cancelBtn.disabled = false;
    } else {
      primaryBtn.textContent = 'Hoàn thành';
      primaryBtn.dataset.action = '';
      primaryBtn.onclick = null;
      primaryBtn.disabled = true;
      cancelBtn.disabled = true;
      primaryBtn.classList.add('d-none');
      cancelBtn.classList.add('d-none');
    }
  }

  async function updateOrderStatus(orderId, action) {
    const btns = document.querySelectorAll(`#order-row-${orderId} button`);
    btns.forEach(b => b.disabled = true);

    try {
      const res = await fetch(`{{ url('/admin/orders') }}/${orderId}/status`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token,
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ action })
      });
      const data = await res.json();
      if (data && data.success) {
        const statusEl = document.getElementById(`order-status-${orderId}`);
        const statusKey = data.order.status;
        statusEl.textContent = statusLabelMap[statusKey] || statusKey;
        statusEl.className = 'badge badge-status bg-' + (statusColorMap[statusKey] || 'secondary');

        setActionButtons(orderId, statusKey);
      } else {
        alert('Có lỗi xảy ra, vui lòng thử lại.');
        btns.forEach(b => b.disabled = false);
      }
    } catch (e) {
      console.error(e);
      alert('Không thể kết nối máy chủ.');
      btns.forEach(b => b.disabled = false);
    }
  }

  const loadedItems = new Set();
  function toggleOrderItems(orderId) {
    const row = document.getElementById(`order-items-row-${orderId}`);
    if (!row) return;
    const hidden = row.classList.contains('d-none');
    if (!hidden) {
      row.classList.add('d-none');
      return;
    }
    row.classList.remove('d-none');

    if (loadedItems.has(orderId)) return;

    const cell = document.getElementById(`order-items-cell-${orderId}`);
    cell.innerHTML = '<div class="text-muted p-3">Đang tải...</div>';

    fetch(`{{ url('/admin/orders') }}/${orderId}/items`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.text())
    .then(html => {
      cell.innerHTML = html;
      loadedItems.add(orderId);
    })
    .catch(() => {
      cell.innerHTML = '<div class="text-danger p-3">Không thể tải dữ liệu. Vui lòng thử lại.</div>';
    });
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
