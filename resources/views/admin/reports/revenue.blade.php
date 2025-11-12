<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thống kê doanh thu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> body { padding-top: 70px; } </style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @php /* trạng thái không hiển thị trong UI, controller mặc định dùng completed */ @endphp
  @php
    $groupBy = $filters['group_by'] ?? 'day';
    $chartLabels = collect($rows ?? [])->map(function($r) use ($groupBy) {
      return \Carbon\Carbon::parse($r->period)->format($groupBy === 'month' ? 'm/Y' : 'd/m/Y');
    });
    $chartData = collect($rows ?? [])->map(function($r) { return (float) $r->revenue; });
  @endphp
  </head>
<body>
  @include('layouts.header')

  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h4 mb-0">Thống kê doanh thu</h1>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Quay lại Dashboard</a>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <form class="row g-3" method="get" action="{{ route('admin.reports.revenue') }}">
          <div class="col-md-3">
            <label class="form-label">Từ ngày</label>
            <input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] ?? '' }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Đến ngày</label>
            <input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] ?? '' }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Thống kê theo ngày/tháng</label>
            <select name="group_by" class="form-select">
              <option value="day" {{ ($filters['group_by'] ?? 'day')==='day' ? 'selected' : '' }}>Ngày</option>
              <option value="month" {{ ($filters['group_by'] ?? 'day')==='month' ? 'selected' : '' }}>Tháng</option>
            </select>
          </div>
          

          <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Lọc</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="text-muted">Tổng doanh thu</div>
            <div class="h4 mb-0">{{ number_format($totalRevenue, 0, ',', '.') }} đ</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="text-muted">Số đơn</div>
            <div class="h4 mb-0">{{ number_format($totalOrders) }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="text-muted">Giá trị TB/đơn</div>
            <div class="h4 mb-0">{{ number_format($avgOrderValue, 0, ',', '.') }} đ</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title mb-3">Biểu đồ doanh thu</h5>
        <div class="chart-container" style="position: relative; height: 360px;">
          <canvas id="revenueChart"></canvas>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead>
            <tr>
              <th>Kỳ</th>
              <th>Doanh thu</th>
              <th>Số đơn</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rows as $r)
              <tr>
                <td>
                  @if(($filters['group_by'] ?? 'day')==='month')
                    {{ \Carbon\Carbon::parse($r->period)->format('m/Y') }}
                  @else
                    {{ \Carbon\Carbon::parse($r->period)->format('d/m/Y') }}
                  @endif
                </td>
                <td>{{ number_format($r->revenue, 0, ',', '.') }} đ</td>
                <td>{{ number_format($r->orders) }}</td>
              </tr>
            @empty
              <tr><td colspan="3" class="text-center text-muted py-4">Không có dữ liệu.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script>
    (function() {
      const labels = @json($chartLabels->values());
      const data = @json($chartData->values());
      const ctx = document.getElementById('revenueChart');
      if (!ctx) return;
      const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels,
          datasets: [{
            label: 'Doanh thu',
            data,
            backgroundColor: 'rgba(13, 139, 109, 0.6)',
            borderColor: '#0d8b6d',
            borderWidth: 1,
            borderRadius: 4,
            maxBarThickness: 36,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          resizeDelay: 100,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: (value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'
              }
            }
          },
          plugins: {
            tooltip: {
              callbacks: {
                label: (ctx) => 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(ctx.parsed.y) + ' đ'
              }
            },
            legend: { display: false }
          }
        }
      });
    })();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
