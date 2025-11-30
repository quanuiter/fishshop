@extends('layouts.app')

@section('title', $product->name ?? 'Chi tiết sản phẩm')

@section('content')
  <x-breadcrumb />
  <style>
    /* Improved CSS organization and animation system */
    :root {
      --primary: #1a472a;
      --primary-light: #2d5f3f;
      --accent: #e8b923;
      --accent-light: #ffd966;
      --neutral-light: #faf8f6;
      --neutral-gray: #6b6b6b;
      --neutral-dark: #2c2c2c;
      --border-color: #e5ddd5;
      --bg-light: #ffffff;
      --success: #27ae60;
      --shadow-sm: 0 2px 8px rgba(26, 71, 42, 0.06);
      --shadow-md: 0 8px 24px rgba(26, 71, 42, 0.1);
      --shadow-lg: 0 12px 32px rgba(26, 71, 42, 0.12);
      --transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
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

    .variant-btn.unavailable {
      opacity: 0.5;
      background: #f8f8f8;
      color: #999;
      position: relative;
      cursor: not-allowed;
      border-color: #ddd;
    }


    .variant-btn.unavailable::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 5%;
      right: 5%;
      height: 2px;
      background: #999;
      transform: rotate(-15deg);
    }

    .variant-btn.unavailable:hover {
      border-color: #ddd;
      background: #f8f8f8;
      transform: none;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Enhanced animations for smooth transitions */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(12px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-8px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Breadcrumb - Refined */
    .breadcrumb {
      padding: 24px 0;
      font-size: 13px;
      color: var(--neutral-gray);
      margin-bottom: 40px;
      display: flex;
      align-items: center;
      gap: 6px;
      animation: slideIn 0.5s var(--transition);
    }

    .breadcrumb a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.25s ease;
    }

    .breadcrumb a:hover {
      color: var(--accent);
    }

    /* Balanced grid layout for better visual harmony */
    .product-detail-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 56px;
      margin-bottom: 64px;
      background: var(--bg-light);
      padding: 56px;
      border-radius: 16px;
      box-shadow: var(--shadow-md);
      animation: fadeInUp 0.6s var(--transition);
    }

    /* Gallery section with improved image handling */
    .gallery-section {
      display: flex;
      flex-direction: column;
      gap: 16px;
      position: relative;
    }

    .main-image {
      position: relative;
      width: 100%;
      aspect-ratio: 1;
      background: linear-gradient(135deg, var(--neutral-light) 0%, rgba(232, 185, 35, 0.03) 100%);
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--border-color);
      cursor: crosshair;
      transition: all 0.3s ease;
    }

    .main-image:hover {
      border-color: var(--accent-light);
      box-shadow: var(--shadow-sm);
    }

    .main-image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 16px;
      display: block;
    }

    .img-lens {
      position: absolute;
      width: 150px;
      height: 150px;
      border: 3px solid var(--accent);
      border-radius: 50%;
      background: rgba(232, 185, 35, 0.15);
      display: none;
      pointer-events: none;
      z-index: 100;
      backdrop-filter: blur(2px);
    }

    .zoom-result {
      position: fixed;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      width: 500px;
      height: 500px;
      border: 2px solid var(--accent);
      overflow: hidden;
      display: none;
      background-color: #fff;
      box-shadow: var(--shadow-lg);
      border-radius: 12px;
      z-index: 9999;
    }

    .zoom-result img {
      position: absolute;
      max-width: none;
    }

    @media (max-width: 1400px) {
      .zoom-result {
        width: 400px;
        height: 400px;
      }
    }

    @media (max-width: 1024px) {
      .zoom-result {
        display: none !important;
      }

      .main-image {
        cursor: zoom-in;
      }
    }

    /* Thumbnail gallery */
    .thumbnail-gallery {
      display: flex;
      gap: 12px;
      overflow-x: auto;
      padding: 2px;
      animation: slideIn 0.6s var(--transition) 0.1s backwards;
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
      width: 100px;
      height: 100px;
      flex-shrink: 0;
      border: 2px solid var(--border-color);
      border-radius: 10px;
      cursor: pointer;
      transition: all var(--transition);
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
      transform: translateY(-4px);
    }

    .thumbnail.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 4px rgba(232, 185, 35, 0.15);
      background: rgba(232, 185, 35, 0.05);
    }

    /* Product Info Section */
    .product-info-section {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      animation: fadeInUp 0.6s var(--transition) 0.15s backwards;
    }

    /* Product Header */
    .product-header {
      margin-bottom: 32px;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 28px;
    }

    .product-brand {
      font-size: 12px;
      color: var(--accent);
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 700;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .product-name {
      font-size: 28px;
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
      gap: 3px;
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

    /* Simplified price section with subtle gradient */
    .price-section {
      margin-bottom: 32px;
      padding: 28px;
      background: linear-gradient(135deg, rgba(232, 185, 35, 0.08) 0%, rgba(232, 185, 35, 0.03) 100%);
      border: 1px solid rgba(232, 185, 35, 0.2);
      border-radius: 12px;
      position: relative;
      overflow: hidden;
      transition: all var(--transition);
    }

    .price-section:hover {
      background: linear-gradient(135deg, rgba(232, 185, 35, 0.12) 0%, rgba(232, 185, 35, 0.05) 100%);
      box-shadow: var(--shadow-sm);
    }

    .price-row {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 12px;
    }

    .current-price {
      font-size: 36px;
      font-weight: 800;
      color: var(--accent);
      transition: all 0.3s ease;
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
      margin-bottom: 28px;
      padding: 16px;
      background: linear-gradient(135deg, var(--neutral-light) 0%, rgba(232, 185, 35, 0.02) 100%);
      border-radius: 12px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
      border: 1px solid rgba(232, 185, 35, 0.1);
    }

    .spec-item {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .spec-label {
      font-weight: 700;
      color: var(--primary);
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    .spec-value {
      color: var(--neutral-gray);
      font-size: 14px;
      font-weight: 500;
    }

    /* Variants Section */
    .variants-section {
      margin-bottom: 28px;
      animation: fadeInUp 0.6s var(--transition);
    }

    .variant-label {
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 12px;
      display: block;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    .variant-options {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .variant-btn {
      padding: 11px 18px;
      border: 2px solid var(--border-color);
      border-radius: 8px;
      background: white;
      color: var(--neutral-dark);
      font-weight: 500;
      cursor: pointer;
      transition: all var(--transition);
      font-size: 13px;
    }

    .variant-btn:hover {
      border-color: var(--accent);
      background: rgba(232, 185, 35, 0.06);
      transform: translateY(-2px);
    }

    .variant-btn.active {
      border-color: var(--accent);
      background: var(--accent);
      color: var(--primary);
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(232, 185, 35, 0.2);
    }

    /* Quantity & Wishlist */
    .quantity-section {
      margin-bottom: 32px;
      display: flex;
      align-items: center;
      gap: 16px;
      animation: fadeInUp 0.6s var(--transition);
    }

    .quantity-label {
      font-weight: 700;
      color: var(--primary);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      white-space: nowrap;
    }

    .quantity-control {
      display: flex;
      align-items: center;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      overflow: hidden;
      background: white;
      transition: all 0.25s ease;
    }

    .quantity-control:focus-within {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(232, 185, 35, 0.1);
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

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 12px;
      margin-bottom: 28px;
      animation: fadeInUp 0.6s var(--transition) 0.2s backwards;
    }

    .btn {
      flex: 1;
      padding: 16px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: all var(--transition);
      text-decoration: none;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.15);
      transition: left 0.3s ease;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-add-cart {
      background: var(--accent);
      color: var(--primary);
    }

    .btn-add-cart:hover {
      background: var(--accent-light);
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(232, 185, 35, 0.25);
    }

    .btn-buy-now {
      background: var(--primary);
      color: white;
    }

    .btn-buy-now:hover {
      background: var(--primary-light);
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(26, 71, 42, 0.25);
    }

    /* Features */
    .features-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      padding: 24px 0;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .feature-item {
      text-align: center;
      padding: 16px;
      transition: all 0.3s ease;
      border-radius: 8px;
    }

    .feature-item:hover {
      background: var(--neutral-light);
    }

    .feature-icon {
      font-size: 28px;
      margin-bottom: 10px;
      transition: transform 0.3s ease;
    }

    .feature-item:hover .feature-icon {
      transform: scale(1.1);
    }

    .feature-text {
      font-size: 12px;
      color: var(--neutral-gray);
      font-weight: 500;
    }

    /* Tabs Section */
    .tabs-section {
      background: var(--bg-light);
      padding: 48px 56px;
      border-radius: 16px;
      margin-bottom: 64px;
      box-shadow: var(--shadow-md);
      animation: fadeInUp 0.6s var(--transition) 0.3s backwards;
    }

    .tabs-container {
      display: flex;
      gap: 0;
      border-bottom: 2px solid var(--border-color);
      margin-bottom: 32px;
    }

    .tab-btn {
      padding: 14px 28px;
      border: none;
      background: none;
      color: var(--neutral-gray);
      font-weight: 700;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all var(--transition);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
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
      animation: fadeInUp 0.4s var(--transition);
    }

    .tab-content.active {
      display: block;
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
      gap: 32px;
    }

    .specs-item {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .specs-item strong {
      color: var(--primary);
      font-weight: 700;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
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
      margin-bottom: 32px;
      animation: fadeInUp 0.6s var(--transition);
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 24px;
    }

    .product-card {
      border: 1px solid var(--border-color);
      border-radius: 12px;
      overflow: hidden;
      transition: all var(--transition);
      background: white;
      animation: fadeInUp 0.6s var(--transition);
    }

    .product-card:hover {
      box-shadow: var(--shadow-md);
      border-color: var(--accent-light);
      transform: translateY(-6px);
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
      transition: transform 0.3s ease;
    }

    .product-card:hover .product-card-image img {
      transform: scale(1.05);
    }

    .product-card-info {
      padding: 18px;
    }

    .product-card-name {
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 10px;
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
        gap: 40px;
        padding: 40px;
      }

      .zoom-result {
        position: absolute;
        left: calc(100% + 16px);
        width: 350px;
        height: 350px;
      }

      .product-specs {
        grid-template-columns: 1fr;
      }

      .specs-content {
        grid-template-columns: 1fr;
      }

      .features-section {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 0 16px;
      }

      .product-detail-container {
        padding: 24px;
        gap: 28px;
      }

      .product-name {
        font-size: 22px;
      }

      .current-price {
        font-size: 28px;
      }

      .main-image {
        aspect-ratio: 1;
      }

      .thumbnail {
        width: 80px;
        height: 80px;
      }

      .features-section {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .zoom-result {
        display: none !important;
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
      }

      .action-buttons {
        flex-direction: column;
      }

      .tabs-section {
        padding: 28px 20px;
      }

      .tabs-container {
        overflow-x: auto;
        margin-bottom: 20px;
      }

      .tab-btn {
        white-space: nowrap;
        padding: 12px 16px;
      }

      .specs-content {
        gap: 16px;
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
            src="{{ $product->images->first()?->image_url ?? ($product->variants->first()?->image ?? 'https://via.placeholder.com/500x500?text=Fishing+Gear') }}"
            alt="{{ $product->name }}">
        </div>
        @if($product->images->count())
          <div class="thumbnail-gallery">
            @foreach($product->images as $image)
              <div class="thumbnail {{ $loop->first ? 'active' : '' }}"
                onclick="changeImage('{{ $image->image_url }}', this)">
                <img src="{{ $image->image_url }}" alt="{{ $product->name }}">
              </div>
            @endforeach
            @if($product->variants->count())
              @foreach($product->variants as $variant)
                @if($variant->image)
                  <div class="thumbnail" onclick="changeImage('{{ $variant->image }}', this)">
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
          <div class="product-brand">{{ $product->brand ?? 'Premium Gear' }}</div>
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
  </div>

  </style>

  <!-- JavaScript Fixes - Thay thế toàn bộ phần zoom script -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const mainImage = document.getElementById('mainImage');
      if (!mainImage) return;

      const mainImageContainer = mainImage.parentElement;

      // Create lens element
      const lens = document.createElement('div');
      lens.classList.add('img-lens');
      mainImageContainer.appendChild(lens);

      // Create zoom result container
      const zoomResult = document.createElement('div');
      zoomResult.classList.add('zoom-result');
      document.body.appendChild(zoomResult); // Append to body instead

      const zoomImg = document.createElement('img');
      zoomResult.appendChild(zoomImg);

      // Update zoom image when main image changes
      const observer = new MutationObserver(() => {
        zoomImg.src = mainImage.src;
        imageLoaded();
      });
      observer.observe(mainImage, { attributes: true, attributeFilter: ['src'] });

      const ZOOM_LEVEL = 2.5;
      let cx, cy;

      function imageLoaded() {
        // Wait for image to load to get natural dimensions
        if (mainImage.complete) {
          calculateZoom();
        } else {
          mainImage.onload = calculateZoom;
        }
      }

      function calculateZoom() {
        const containerRect = mainImageContainer.getBoundingClientRect();
        const resultRect = zoomResult.getBoundingClientRect();

        // Calculate zoom ratio
        cx = resultRect.width / lens.offsetWidth;
        cy = resultRect.height / lens.offsetHeight;

        // Set zoomed image size
        zoomImg.style.width = (containerRect.width * cx) + 'px';
        zoomImg.style.height = (containerRect.height * cy) + 'px';
      }

      // Event listeners
      mainImageContainer.addEventListener('mouseenter', () => {
        lens.style.display = 'block';
        zoomResult.style.display = 'block';
        zoomImg.src = mainImage.src;
        imageLoaded();
      });

      mainImageContainer.addEventListener('mouseleave', () => {
        lens.style.display = 'none';
        zoomResult.style.display = 'none';
      });

      mainImageContainer.addEventListener('mousemove', moveLens);

      function moveLens(e) {
        e.preventDefault();

        const containerRect = mainImageContainer.getBoundingClientRect();

        // Calculate cursor position
        let x = e.clientX - containerRect.left;
        let y = e.clientY - containerRect.top;

        // Calculate lens position (centered on cursor)
        let lensX = x - (lens.offsetWidth / 2);
        let lensY = y - (lens.offsetHeight / 2);

        // Prevent lens from going outside image
        if (lensX > containerRect.width - lens.offsetWidth) {
          lensX = containerRect.width - lens.offsetWidth;
        }
        if (lensX < 0) {
          lensX = 0;
        }
        if (lensY > containerRect.height - lens.offsetHeight) {
          lensY = containerRect.height - lens.offsetHeight;
        }
        if (lensY < 0) {
          lensY = 0;
        }

        // Set lens position
        lens.style.left = lensX + 'px';
        lens.style.top = lensY + 'px';

        // Display zoomed image
        zoomImg.style.left = '-' + (lensX * cx) + 'px';
        zoomImg.style.top = '-' + (lensY * cy) + 'px';
      }

      // Initialize
      imageLoaded();
    });

    // Fix các function khác
    const variants = @json($product->variants ?? []);

    function changeImage(src, el) {
      const mainImg = document.getElementById('mainImage');
      if (mainImg) {
        mainImg.src = src;
      }
      document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
      if (el) el.classList.add('active');
    }

        function selectVariant(btn) {
      const colorBtns = document.querySelectorAll('.variant-btn[data-color]');
      const sizeBtns = document.querySelectorAll('.variant-btn[data-size]');

      // Nếu click vào màu
      if (btn.dataset.color) {
        colorBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const selectedColor = btn.dataset.color;

        // Reset size selection khi đổi màu
        sizeBtns.forEach(b => b.classList.remove('active'));

        // Cập nhật availability cho các kích thước dựa trên màu đã chọn
        sizeBtns.forEach(sizeBtn => {
          const size = sizeBtn.dataset.size;
          const hasVariant = variants.some(v => v.color === selectedColor && v.size === size && v.stock > 0);

          if (hasVariant) {
            sizeBtn.classList.remove('unavailable');
            sizeBtn.disabled = false;
          } else {
            sizeBtn.classList.add('unavailable');
            sizeBtn.disabled = true;
          }
        });
      }

      // Nếu click vào kích thước
      if (btn.dataset.size) {
        const selectedColor = document.querySelector('.variant-btn[data-color].active')?.dataset.color;

        // Chỉ cho phép chọn size nếu đã chọn màu
        if (!selectedColor) {
          alert('Vui lòng chọn màu sắc trước!');
          return;
        }

        // Kiểm tra xem size có available với màu đã chọn không
        if (btn.classList.contains('unavailable') || btn.disabled) {
          alert('Kích thước này không có sẵn với màu đã chọn!');
          return;
        }

        sizeBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }

      // Get selected color and size
      const selectedColor = document.querySelector('.variant-btn[data-color].active')?.dataset.color;
      const selectedSize = document.querySelector('.variant-btn[data-size].active')?.dataset.size;

      // Find matching variant
      const variant = variants.find(v => {
        const colorMatch = !selectedColor || !v.color || v.color === selectedColor;
        const sizeMatch = !selectedSize || !v.size || v.size === selectedSize;
        return colorMatch && sizeMatch;
      });

      if (variant) {
        // Update price
        const priceEl = document.querySelector('.current-price');
        if (priceEl) {
          priceEl.innerText = '₫' + new Intl.NumberFormat('vi-VN').format(variant.price);
        }

        // Update stock
        const stockEl = document.querySelector('.stock-status');
        if (stockEl) {
          stockEl.innerHTML = `✓ Còn ${variant.stock} sản phẩm`;
        }

        // Update image if available
        if (variant.image) {
          const mainImg = document.getElementById('mainImage');
          if (mainImg) {
            mainImg.src = variant.image;
          }
        }
      }
    }



    function increaseQty() {
      const qtyInput = document.getElementById('quantity');
      if (!qtyInput) return;

      const currentVariant = getSelectedVariant();
      const maxStock = currentVariant ? currentVariant.stock : 999;
      const currentVal = parseInt(qtyInput.value) || 1;

      if (currentVal < maxStock) {
        qtyInput.value = currentVal + 1;
      } else {
        alert('Vượt quá số lượng tồn kho!');
      }
    }

    function decreaseQty() {
      const qtyInput = document.getElementById('quantity');
      if (!qtyInput) return;

      const currentVal = parseInt(qtyInput.value) || 1;
      if (currentVal > 1) {
        qtyInput.value = currentVal - 1;
      }
    }

    function getSelectedVariant() {
      const activeColor = document.querySelector('.variant-btn[data-color].active')?.dataset.color;
      const activeSize = document.querySelector('.variant-btn[data-size].active')?.dataset.size;

      return variants.find(v => {
        const colorMatch = !activeColor || !v.color || v.color === activeColor;
        const sizeMatch = !activeSize || !v.size || v.size === activeSize;
        return colorMatch && sizeMatch;
      });
    }

    function addToCart() {
      const quantity = parseInt(document.getElementById('quantity')?.value) || 1;
      const currentVariant = getSelectedVariant();

      if (!currentVariant) {
        alert('Vui lòng chọn phiên bản sản phẩm!');
        return;
      }

      if (quantity > currentVariant.stock) {
        alert('Số lượng vượt quá tồn kho!');
        return;
      }

      fetch('/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
          variant_id: currentVariant.id,
          quantity: quantity
        })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Đã thêm vào giỏ hàng!');
          } else {
            alert(data.message || 'Có lỗi xảy ra!');
          }
        })
        .catch(err => {
          console.error('Error:', err);
          alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
        });
    }

    function buyNow() {
      const currentVariant = getSelectedVariant();
      if (!currentVariant) {
        alert('Vui lòng chọn phiên bản sản phẩm!');
        return;
      }

      // Add to cart then redirect to checkout
      addToCart();
      setTimeout(() => {
        window.location.href = '/checkout';
      }, 500);
    }

    function switchTab(e, tabName) {
      document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

      const targetTab = document.getElementById(tabName);
      if (targetTab) {
        targetTab.classList.add('active');
      }

      if (e && e.target) {
        e.target.classList.add('active');
      }
    }
  </script>
@endsection