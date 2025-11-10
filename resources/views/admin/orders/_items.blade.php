<div class="p-3">
  @if($order->items->isEmpty())
    <div class="text-muted">Đơn hàng không có sản phẩm.</div>
  @else
    <div class="table-responsive">
      <table class="table table-sm align-middle mb-0">
        <thead>
          <tr>
            <th style="width:60px">ID</th>
            <th>Sản phẩm</th>
            <th style="width:100px" class="text-end">SL</th>
            <th style="width:160px" class="text-end">Giá</th>
            <th style="width:160px" class="text-end">Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          @php $sum = 0; @endphp
          @foreach($order->items as $item)
            @php $subtotal = $item->quantity * $item->price; $sum += $subtotal; @endphp
            <tr>
              <td>{{ $item->id }}</td>
              <td>
                <div class="fw-semibold">{{ $item->product->name ?? ('#'.$item->product_id) }}</div>
              </td>
              <td class="text-end">{{ $item->quantity }}</td>
              <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} đ</td>
              <td class="text-end">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Tổng cộng</th>
            <th class="text-end">{{ number_format($sum, 0, ',', '.') }} đ</th>
          </tr>
        </tfoot>
      </table>
    </div>
  @endif
</div>

