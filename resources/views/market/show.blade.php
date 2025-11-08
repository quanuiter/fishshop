@extends('layouts.app')

@section('title', $product->name ?? 'Chi tiết sản phẩm')

@section('content')
<x-breadcrumb />
  <style>
    /* Complete design overhaul: improved spacing, typography hierarchy, and visual harmony */
    :root {
      --primary: #1a472a;
      --primary-light: #2d5f3f;
      --accent: #e8b923;
      --accent-light: #ffd966;
      --neutral-light: #f5f3f0;
      --neutral-gray: #6b6b6b;
      --neutral-dark: #333333;
      --border-color: #e0d9d2;
      --bg-light: #ffffff;
      --success: #27ae60;
      --shadow-sm: 0 1px 3px rgba(26, 71, 42, 0.08);
      --shadow-md: 0 4px 12px rgba(26, 71, 42, 0.12);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
      background-color: var(--neutral-light);
      color: var(--neutral-dark);
      line-height: 1.6;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Breadcrumb - Refined */
    .breadcrumb {
      padding: 20px 0;
      font-size: 13px;
      color: var(--neutral-gray);
      margin-bottom: 32px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .breadcrumb a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .breadcrumb a:hover {
      color: var(--accent);
    }

    /* Main Product Container */
    .product-detail-container {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: 48px;
      margin-bottom: 64px;
      background: var(--bg-light);
      padding: 48px;
      border-radius: 16px;
      box-shadow: var(--shadow-md);
    }

    /* Gallery Section - Enhanced */
    .gallery-section {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .main-image {
      width: 100%;
      aspect-ratio: 1;
      background: linear-gradient(135deg, var(--neutral-light) 0%, rgba(232, 185, 35, 0.05) 100%);
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--border-color);
      transition: border-color 0.3s ease;
    }

    .main-image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 24px;
    }

    .thumbnail-gallery {
      display: flex;
      gap: 12px;
      overflow-x: auto;
      padding: 2px;
    }

    .thumbnail-gallery::-webkit-scrollbar {
      height: 6px;
    }

    .thumbnail-gallery::-webkit-scrollbar-track {
      background: var(--neutral-light);
      border-radius: 10px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb {
      background: var(--accent);
      border-radius: 10px;
    }

    .thumbnail {
      width: 90px;
      height: 90px;
      flex-shrink: 0;
      border: 2px solid var(--border-color);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      overflow: hidden;
      background: white;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 8px;
    }

    .thumbnail:hover {
      border-color: var(--accent-light);
      box-shadow: var(--shadow-sm);
    }

    .thumbnail.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(232, 185, 35, 0.15);
    }

    /* Product Info Section */
    .product-info-section {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    /* Header */
    .product-header {
      margin-bottom: 28px;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 24px;
    }

    .product-brand {
      font-size: 12px;
      color: var(--accent);
      text-transform: uppercase;
      letter-spacing: 1.2px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .product-name {
      font-size: 32px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 16px;
      line-height: 1.3;
    }

    .rating-section {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .stars {
      display: flex;
      gap: 2px;
    }

    .star {
      color: var(--accent);
      font-size: 14px;
    }

    .rating-text {
      font-size: 13px;
      color: var(--neutral-gray);
      font-weight: 500;
    }

    /* Price Section - Premium */
    .price-section {
      margin-bottom: 32px;
      padding: 24px;
      background: linear-gradient(135deg, var(--accent-light) 0%, var(--accent) 100%);
      border-radius: 12px;
      position: relative;
      overflow: hidden;
    }

    .price-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 150px;
      height: 150px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
    }

    .price-row {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 12px;
      position: relative;
      z-index: 1;
    }

    .current-price {
      font-size: 36px;
      font-weight: 800;
      color: var(--primary);
    }

    .stock-status {
      font-size: 14px;
      font-weight: 600;
      color: var(--success);
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Specifications Grid */
    .product-specs {
      margin-bottom: 20px;
      padding: 10px 12px;
      background: var(--neutral-light);
      border-radius: 12px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .spec-item {
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .spec-label {
      font-weight: 600;
      color: var(--primary);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .spec-value {
      color: var(--neutral-gray);
      font-size: 14px;
    }

    /* Variants Section */
    .variants-section {
      margin-bottom: 28px;
    }

    .variant-label {
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 12px;
      display: block;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .variant-options {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .variant-btn {
      padding: 10px 18px;
      border: 2px solid var(--border-color);
      border-radius: 8px;
      background: white;
      color: var(--neutral-dark);
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 13px;
    }

    .variant-btn:hover {
      border-color: var(--accent);
      background: rgba(232, 185, 35, 0.05);
    }

    .variant-btn.active {
      border-color: var(--accent);
      background: var(--accent);
      color: var(--primary);
      font-weight: 600;
    }

    /* Quantity & Wishlist */
    .quantity-section {
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .quantity-label {
      font-weight: 600;
      color: var(--primary);
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      white-space: nowrap;
    }

    .quantity-control {
      display: flex;
      align-items: center;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      overflow: hidden;
      background: white;
    }

    .qty-btn {
      width: 40px;
      height: 40px;
      border: none;
      background: white;
      cursor: pointer;
      font-weight: 600;
      color: var(--primary);
      transition: all 0.2s ease;
      font-size: 16px;
    }

    .qty-btn:hover {
      background: var(--neutral-light);
    }

    .qty-input {
      width: 60px;
      height: 40px;
      border: none;
      text-align: center;
      font-weight: 600;
      font-size: 14px;
      border-left: 1px solid var(--border-color);
      border-right: 1px solid var(--border-color);
    }

    .qty-input:focus {
      outline: none;
    }

    .wishlist-btn {
      width: 40px;
      height: 40px;
      border: 1px solid var(--border-color);
      background: white;
      border-radius: 8px;
      cursor: pointer;
      font-size: 20px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .wishlist-btn:hover {
      border-color: var(--accent);
      background: rgba(232, 185, 35, 0.05);
    }

    .wishlist-btn.active {
      border-color: var(--accent);
      color: var(--accent);
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 12px;
      margin-bottom: 32px;
    }

    .btn {
      flex: 1;
      padding: 14px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      text-align: center;
    }

    .btn-add-cart {
      background: var(--accent);
      color: var(--primary);
    }

    .btn-add-cart:hover {
      background: var(--accent-light);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-buy-now {
      background: var(--primary);
      color: white;
    }

    .btn-buy-now:hover {
      background: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    /* Features */
    .features-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      padding: 20px 0;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .feature-item {
      text-align: center;
      padding: 16px;
    }

    .feature-icon {
      font-size: 28px;
      margin-bottom: 8px;
    }

    .feature-text {
      font-size: 12px;
      color: var(--neutral-gray);
      font-weight: 500;
    }

    /* Tabs Section */
    .tabs-section {
      background: var(--bg-light);
      padding: 40px 48px;
      border-radius: 16px;
      margin-bottom: 64px;
      box-shadow: var(--shadow-md);
    }

    .tabs-container {
      display: flex;
      gap: 0;
      border-bottom: 2px solid var(--border-color);
      margin-bottom: 32px;
    }

    .tab-btn {
      padding: 14px 24px;
      border: none;
      background: none;
      color: var(--neutral-gray);
      font-weight: 600;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all 0.3s ease;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: -2px;
    }

    .tab-btn:hover {
      color: var(--primary);
    }

    .tab-btn.active {
      color: var(--primary);
      border-bottom-color: var(--accent);
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .description-content {
      color: var(--neutral-gray);
      line-height: 1.8;
      font-size: 15px;
      margin-bottom: 0;
    }

    .specs-content {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
    }

    .specs-item {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .specs-item strong {
      color: var(--primary);
      font-weight: 600;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .specs-item div {
      color: var(--neutral-gray);
      font-size: 14px;
    }

    /* Related Products Section */
    .related-products {
      margin-bottom: 64px;
    }

    .section-title {
      font-size: 24px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 28px;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 24px;
    }

    .product-card {
      border: 1px solid var(--border-color);
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      background: white;
    }

    .product-card:hover {
      box-shadow: var(--shadow-md);
      border-color: var(--accent-light);
      transform: translateY(-4px);
    }

    .product-card-image {
      width: 100%;
      aspect-ratio: 1;
      background: var(--neutral-light);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .product-card-image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 16px;
    }

    .product-card-info {
      padding: 16px;
    }

    .product-card-name {
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 8px;
      font-size: 14px;
      line-height: 1.4;
    }

    .product-card-price {
      font-weight: 700;
      color: var(--accent);
      font-size: 16px;
      margin-bottom: 12px;
    }

    .product-card-link {
      display: inline-block;
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      font-size: 13px;
      transition: all 0.2s ease;
    }

    .product-card-link:hover {
      color: var(--accent);
      transform: translateX(4px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .product-detail-container {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 32px;
      }

      .product-specs {
        grid-template-columns: 1fr;
      }

      .specs-content {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 0 16px;
      }

      .product-detail-container {
        padding: 20px;
        gap: 24px;
      }

      .product-name {
        font-size: 24px;
      }

      .current-price {
        font-size: 28px;
      }

      .main-image {
        aspect-ratio: 1;
      }

      .features-section {
        grid-template-columns: 1fr;
        gap: 12px;
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
      }

      .action-buttons {
        flex-direction: column;
      }

      .tabs-section {
        padding: 24px 16px;
      }

      .tabs-container {
        overflow-x: auto;
        margin-bottom: 20px;
      }

      .tab-btn {
        white-space: nowrap;
        padding: 12px 16px;
      }
    }
  </style>

  <div class="container">
    <!-- Product Detail Container -->
    <div class="product-detail-container">
      <!-- Gallery Section -->
      <div class="gallery-section">
        <div class="main-image">
          <img id="mainImage"
            src="{{ $product->images->first()?->image_url ?? ($product->variants->first()?->image ?? 'https://via.placeholder.com/500x500?text=Hình+ảnh+sản+phẩm') }}"
            alt="{{ $product->name }}">
        </div>
        @if($product->images->count())
          <div class="thumbnail-gallery">
            @foreach($product->images as $image)
              <div class="thumbnail {{ $loop->first ? 'active' : '' }}" onclick="changeImage('{{ $image->image_url }}')">
                <img src="{{ $image->image_url }}" alt="{{ $product->name }}">
              </div>
            @endforeach
            @if($product->variants->count())
              @foreach($product->variants as $variant)
                @if($variant->image)
                  <div class="thumbnail" onclick="changeImage('{{ $variant->image }}')">
                    <img src="{{ $variant->image }}" alt="{{ $variant->color ?? $product->name }}">
                  </div>
                @endif
              @endforeach
            @endif
          </div>
        @endif
      </div>

      <!-- Product Info Section -->
      <div class="product-info-section">
        <!-- Header -->
        <div class="product-header">
          <div class="product-brand">{{ $product->brand ?? 'Sản phẩm' }}</div>
          <h1 class="product-name">{{ $product->name }}</h1>
          <div class="rating-section">
            <div class="stars">
              @for ($i = 1; $i <= 5; $i++)
                <span class="star">★</span>
              @endfor
            </div>
            <span class="rating-text">4.8 từ 5 sao</span>
          </div>
        </div>

        <!-- Price Section -->
        <div class="price-section">
          <div class="price-row">
            <div class="current-price">₫{{ number_format($product->variants->min('price') ?? 0, 0, ',', '.') }}</div>
          </div>
          <div class="stock-status">
            ✓ Còn {{ $product->variants->sum('stock') }} sản phẩm
          </div>
        </div>

        <!-- Product Specs -->
        <!-- Changed to 2-column grid for better visual balance -->
        <div class="product-specs">
          @if($product->origin)
            <div class="spec-item">
              <span class="spec-label">Xuất xứ</span>
              <span class="spec-value">{{ $product->origin }}</span>
            </div>
          @endif
          @if($product->warranty)
            <div class="spec-item">
              <span class="spec-label">Bảo hành</span>
              <span class="spec-value">{{ $product->warranty }}</span>
            </div>
          @endif
        </div>

        <!-- Variants -->
        @php
          $colors = $product->variants->pluck('color')->filter()->unique();
          $sizes = $product->variants->pluck('size')->filter()->unique();
        @endphp

        @if($colors->count())
          <div class="variants-section">
            <label class="variant-label">Chọn màu sắc</label>
            <div class="variant-options">
              @foreach($colors as $color)
                <button class="variant-btn {{ $loop->first ? 'active' : '' }}" onclick="selectVariant(this)"
                  data-color="{{ $color }}">
                  {{ $color }}
                </button>
              @endforeach
            </div>
          </div>
        @endif

        @if($sizes->count())
          <div class="variants-section">
            <label class="variant-label">Chọn kích thước</label>
            <div class="variant-options">
              @foreach($sizes as $size)
                <button class="variant-btn {{ $loop->first ? 'active' : '' }}" onclick="selectVariant(this)"
                  data-size="{{ $size }}">
                  {{ $size }}
                </button>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Quantity -->
        <div class="quantity-section">
          <label class="quantity-label">Số lượng</label>
          <div class="quantity-control">
            <button class="qty-btn" onclick="decreaseQty()">−</button>
            <input type="number" class="qty-input" id="quantity" value="1" min="1">
            <button class="qty-btn" onclick="increaseQty()">+</button>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
          <button class="btn btn-add-cart" onclick="addToCart()">🛒 Thêm vào giỏ hàng</button>
          <button class="btn btn-buy-now" onclick="buyNow()">Mua ngay</button>
        </div>
      </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
      <div class="tabs-container">
        <button class="tab-btn active" onclick="switchTab(event, 'description')">Mô tả sản phẩm</button>
        <button class="tab-btn" onclick="switchTab(event, 'specifications')">Thông số kỹ thuật</button>
      </div>

      <!-- Description Tab -->
      <div id="description" class="tab-content active">
        <p class="description-content">
          {{ $product->description ?? 'Sản phẩm chất lượng cao được thiết kế để đáp ứng các nhu cầu hiện đại của bạn. Với công nghệ tiên tiến và vật liệu cao cấp, sản phẩm này mang lại trải nghiệm tuyệt vời cho người dùng. Mỗi chi tiết được chú ý kỹ lưỡng để đảm bảo tính bền vững và thẩm mỹ.' }}
        </p>
      </div>

      <!-- Specifications Tab -->
      <div id="specifications" class="tab-content">
        <div class="specs-content">
          @if($product->variants->first())
            @php $variant = $product->variants->first(); @endphp
            @if($variant->size)
              <div class="specs-item">
                <strong>Kích thước:</strong>
                <div>{{ $variant->size }}</div>
              </div>
            @endif
          @endif
          @if($product->material)
            <div class="specs-item">
              <strong>Chất liệu:</strong>
              <div>{{ $product->material }}</div>
            </div>
          @endif
          @if($colors->count())
            <div class="specs-item">
              <strong>Màu sắc:</strong>
              <div>{{ $colors->implode(', ') }}</div>
            </div>
          @endif
          @if($product->year)
            <div class="specs-item">
              <strong>Năm sản xuất:</strong>
              <div>{{ $product->year }}</div>
            </div>
          @endif
          <div class="specs-item">
            <strong>Tồn kho:</strong>
            <div>{{ $product->getTotalStock() }} sản phẩm</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Related Products -->
    @if($related_products->count())
      <div class="related-products">
        <h2 class="section-title">Sản phẩm liên quan</h2>
        <div class="products-grid">
          @foreach($related_products as $related)
            <div class="product-card">
              <div class="product-card-image">
                <img
                  src="{{ $product->images->first()?->image_url ?? ($related->variants->first()?->image ?? 'https://via.placeholder.com/250x200?text=Sản+phẩm') }}"
                  alt="{{ $related->name }}">
              </div>
              <div class="product-card-info">
                <h3 class="product-card-name">{{ $related->name }}</h3>
                <div class="product-card-price">₫{{ number_format($related->variants->min('price') ?? 0, 0, ',', '.') }}</div>
                <a href="/products/{{ $related->id }}" class="product-card-link">Xem chi tiết →</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>

  <script>
    const variants = @json($product->variants);
    function changeImage(src) {
      document.getElementById('mainImage').src = src;
      document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
      event.target.closest('.thumbnail').classList.add('active');
    }

    function selectVariant(btn) {
      const color = btn.dataset.color || document.querySelector('.variant-btn.active[data-color]')?.dataset.color;
      const size = btn.dataset.size || document.querySelector('.variant-btn.active[data-size]')?.dataset.size;

      // cập nhật trạng thái nút
      if (btn.dataset.color) {
        document.querySelectorAll('.variant-btn[data-color]').forEach(b => b.classList.remove('active'));
      }
      if (btn.dataset.size) {
        document.querySelectorAll('.variant-btn[data-size]').forEach(b => b.classList.remove('active'));
      }
      btn.classList.add('active');

      // tìm biến thể tương ứng
      const variant = variants.find(v =>
        (!color || v.color === color) &&
        (!size || v.size === size)
      );

      // cập nhật giá, tồn kho và ảnh
      if (variant) {
        document.querySelector('.current-price').innerText = '₫' + new Intl.NumberFormat('vi-VN').format(variant.price);
        document.querySelector('.stock-status').innerText = `✓ Còn ${variant.stock} sản phẩm`;
        if (variant.image) {
          document.getElementById('mainImage').src = variant.image;
        }
      }
    }

    function increaseQty() {
      const qty = document.getElementById('quantity');
      qty.value = parseInt(qty.value) + 1;
    }

    function decreaseQty() {
      const qty = document.getElementById('quantity');
      if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
    }

    function toggleWishlist() {
      const btn = document.getElementById('wishlistBtn');
      btn.classList.toggle('active');
      btn.textContent = btn.classList.contains('active') ? '♥' : '♡';
    }

    function addToCart() {
      const quantity = document.getElementById('quantity').value;
      const activeColor = document.querySelector('.variant-btn[data-color].active')?.dataset.color;
      const activeSize = document.querySelector('.variant-btn[data-size].active')?.dataset.size;

      // Tìm đúng variant theo màu + size
      let variantId = null;
      @json($product->variants).forEach(v => {
        if ((!activeColor || v.color === activeColor) && (!activeSize || v.size === activeSize)) {
          variantId = v.id;
        }
      });

      if (!variantId) {
        alert('Vui lòng chọn màu hoặc kích thước trước khi thêm vào giỏ!');
        return;
      }

      fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ variant_id: variantId, quantity: quantity })
      })
        .then(res => res.json())
        .then(data => {
          alert(data.message);
        });
    }

    function buyNow() {
      alert('Tiến hành thanh toán...');
    }

    function switchTab(e, tabName) {
      document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.getElementById(tabName).classList.add('active');
      e.target.classList.add('active');
    }
  </script>
@endsection