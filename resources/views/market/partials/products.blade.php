@foreach ($products as $product)
    <div class="product-card" data-url="{{ route('product.show', $product->id) }}">
        <div class="product-image">
            <img src="{{ asset($product->images->first()?->image_url ?? 'https://via.placeholder.com/300x200?text=No+Image') }}">
        </div>
        <div class="product-info">
            <h3 class="product-name">{{ $product->name }}</h3>
            <div class="product-price">
                <span class="currency">₫</span> {{ number_format($product->getMinPrice(), 0, ',', '.') }}
            </div>
        </div>
    </div>
@endforeach