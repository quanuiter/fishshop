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
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Quản lý đơn hàng</h1>
    <div>
      <div class="btn-group" role="group">
        @php $statuses = ['pending' => 'Chờ duyệt', 'confirmed' => 'Đã xác nhận']; @endphp
        @foreach($statuses as $key => $label)
          <a href="{{ route('admin.orders.index', ['status' => $key]) }}" class="btn btn-sm {{ $status === $key ? 'btn-success' : 'btn-outline-success' }}">{{ $label }}</a>
        @endforeach
      </div>
    </div>
  </div>

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
            <th style="width:260px">Hành động</th>
          </tr>
        </thead>
        <tbody id="ordersTableBody">
          @forelse($orders as $order)
            <tr id="order-row-{{ $order->id }}">
              <td>{{ $order->id }}</td>
              <td>
                <div class="fw-semibold">{{ $order->name }}</div>
                <div class="text-muted small">{{ $order->phone }} · {{ $order->address }}</div>
              </td>
              <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
              <td>
                @php $map = ['pending' => 'warning','confirmed' => 'primary']; @endphp
                <span class="badge bg-{{ $map[$order->status] ?? 'secondary' }} badge-status" id="order-status-{{ $order->id }}">{{ $order->status }}</span>
              </td>
              <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-sm btn-outline-secondary" onclick="toggleOrderItems({{ $order->id }})">Chi tiết</button>
                  <button class="btn btn-sm btn-success" onclick="updateOrderStatus({{ $order->id }}, 'confirm')" {{ $order->status !== 'pending' ? 'disabled' : '' }}>Xác nhận</button>
                  <button class="btn btn-sm btn-outline-danger" onclick="updateOrderStatus({{ $order->id }}, 'cancel')" {{ $order->status !== 'pending' ? 'disabled' : '' }}>Huỷ</button>
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
        if (data.deleted) {
          const row = document.getElementById(`order-row-${orderId}`);
          if (row) row.remove();
          return;
        }

        const statusEl = document.getElementById(`order-status-${orderId}`);
        statusEl.textContent = data.order.status;
        statusEl.className = 'badge badge-status bg-' + ( { pending: 'warning', confirmed: 'primary' }[data.order.status] || 'secondary');

        // bật/tắt nút theo trạng thái mới
        const row = document.getElementById(`order-row-${orderId}`);
        const btns = row.querySelectorAll('button');
        const btnConfirm = btns[0];
        const btnCancel = btns[1];
        btnConfirm.disabled = data.order.status !== 'pending';
        btnCancel.disabled = data.order.status !== 'pending';
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

  // Expand/Collapse: tải danh sách sản phẩm trong đơn qua AJAX
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

    if (loadedItems.has(orderId)) return; // đã load trước đó

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
