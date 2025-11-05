@extends('layouts.app')

@section('title', $product->name ?? 'Chi tiết sản phẩm')

@section('content')
  <p style="background: red; color: white; padding: 4px;">DEBUG CHECK</p>
  <style>
    :root {
      --primary: #1a472a;
      --primary-light: #2d5f3f;
      --accent: #e8b923;
      --accent-light: #ffd966;
      --neutral-light: #f9f9f7;
      --neutral-gray: #6b6b6b;
      --border-color: #e5e5e0;
      --bg-light: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--neutral-light);
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Breadcrumb */
    .breadcrumb {
      padding: 16px 0;
      font-size: 14px;
      color: var(--neutral-gray);
      margin-bottom: 24px;
    }

    .breadcrumb a {
      color: var(--primary);
      text-decoration: none;
      transition: 0.2s;
    }

    .breadcrumb a:hover {
      color: var(--accent);
    }

    /* Product Detail Container */
    .product-detail-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      margin-bottom: 60px;
      background: var(--bg-light);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Gallery Section */
    .gallery-section {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .main-image {
      width: 100%;
      height: 500px;
      background: #f0f0f0;
      border-radius: 8px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--border-color);
    }

    .main-image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 20px;
    }

    .thumbnail-gallery {
      display: flex;
      gap: 10px;
      overflow-x: auto;
    }

    .thumbnail-gallery::-webkit-scrollbar {
      height: 6px;
    }

    .thumbnail-gallery::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb {
      background: var(--accent);
      border-radius: 10px;
    }

    .thumbnail {
      width: 80px;
      height: 80px;
      min-flex-shrink: 0;
      border: 2px solid transparent;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.2s;
      overflow: hidden;
      background: #f5f5f5;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 8px;
    }

    .thumbnail:hover,
    .thumbnail.active {
      border-color: var(--accent);
    }

    /* Product Info Section */
    .product-info-section {
      display: flex;
      flex-direction: column;
    }

    .product-header {
      margin-bottom: 24px;
    }

    .product-name {
      font-size: 28px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 8px;
      line-height: 1.3;
    }

    .product-brand {
      font-size: 14px;
      color: var(--neutral-gray);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 12px;
    }

    .rating-section {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--border-color);
    }

    .stars {
      display: flex;
      gap: 4px;
    }

    .star {
      color: var(--accent);
      font-size: 16px;
    }

    .rating-text {
      font-size: 13px;
      color: var(--neutral-gray);
    }

    .review-count {
      color: var(--primary);
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
    }

    /* Price Section */
    .price-section {
      margin-bottom: 24px;
      padding: 20px;
      background: linear-gradient(135deg, var(--accent-light), var(--accent));
      border-radius: 8px;
    }

    .current-price {
      font-size: 32px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 8px;
    }

    .original-price {
      font-size: 16px;
      color: var(--neutral-gray);
      text-decoration: line-through;
      margin-right: 12px;
    }

    .discount-badge {
      display: inline-block;
      background: var(--primary);
      color: white;
      padding: 4px 12px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
    }

    .stock-status {
      font-size: 14px;
      font-weight: 600;
      margin-top: 12px;
    }

    .stock-status.in-stock {
      color: #27ae60;
    }

    .stock-status.low-stock {
      color: #e67e22;
    }

    /* Product Specs */
    .product-specs {
      margin-bottom: 24px;
      padding: 16px;
      background: var(--neutral-light);
      border-radius: 8px;
    }

    .spec-row {
      display: grid;
      grid-template-columns: 120px 1fr;
      gap: 16px;
      padding: 12px 0;
      border-bottom: 1px solid var(--border-color);
      font-size: 14px;
    }

    .spec-row:last-child {
      border-bottom: none;
    }

    .spec-label {
      font-weight: 600;
      color: var(--primary);
    }

    .spec-value {
      color: var(--neutral-gray);
    }

    /* Variants */
    .variants-section {
      margin-bottom: 24px;
    }

    .variant-label {
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 12px;
      display: block;
      font-size: 14px;
    }

    .variant-options {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .variant-btn {
      padding: 10px 16px;
      border: 2px solid var(--border-color);
      border-radius: 6px;
      background: white;
      color: #333;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
      font-size: 13px;
    }

    .variant-btn:hover {
      border-color: var(--accent);
    }

    .variant-btn.active {
      border-color: var(--accent);
      background: var(--accent);
      color: var(--primary);
    }

    /* Quantity & Actions */
    .quantity-section {
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .quantity-label {
      font-weight: 600;
      color: var(--primary);
      font-size: 14px;
    }

    .quantity-control {
      display: flex;
      align-items: center;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      overflow: hidden;
    }

    .qty-btn {
      width: 36px;
      height: 36px;
      border: none;
      background: white;
      cursor: pointer;
      font-weight: 600;
      color: var(--primary);
      transition: 0.2s;
    }

    .qty-btn:hover {
      background: var(--neutral-light);
    }

    .qty-input {
      width: 50px;
      height: 36px;
      border: none;
      text-align: center;
      font-weight: 600;
      font-size: 14px;
    }

    .wishlist-btn {
      width: 40px;
      height: 40px;
      border: 1px solid var(--border-color);
      background: white;
      border-radius: 6px;
      cursor: pointer;
      font-size: 18px;
      transition: 0.2s;
    }

    .wishlist-btn:hover {
      border-color: var(--accent);
    }

    .wishlist-btn.active {
      color: var(--accent);
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
    }

    .btn {
      flex: 1;
      padding: 14px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      text-align: center;
    }

    .btn-add-cart {
      background: var(--accent);
      color: var(--primary);
    }

    .btn-add-cart:hover {
      background: var(--accent-light);
    }

    .btn-buy-now {
      background: var(--primary);
      color: white;
    }

    .btn-buy-now:hover {
      background: var(--primary-light);
    }

    /* Features */
    .features-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      padding: 20px 0;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .feature-item {
      text-align: center;
      padding: 12px;
    }

    .feature-icon {
      font-size: 24px;
      margin-bottom: 8px;
    }

    .feature-text {
      font-size: 12px;
      color: var(--neutral-gray);
      font-weight: 500;
    }

    /* Description Section */
    .section-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 16px;
      padding-top: 32px;
    }

    .description-content {
      color: var(--neutral-gray);
      line-height: 1.8;
      font-size: 14px;
      margin-bottom: 32px;
    }

    /* Tabs */
    .tabs-container {
      display: flex;
      gap: 0;
      border-bottom: 2px solid var(--border-color);
      margin-bottom: 24px;
    }

    .tab-btn {
      padding: 12px 24px;
      border: none;
      background: none;
      color: var(--neutral-gray);
      font-weight: 600;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      transition: 0.2s;
      margin-bottom: -2px;
    }

    .tab-btn.active {
      color: var(--primary);
      border-bottom-color: var(--accent);
    }

    .tab-content {
      flex: 1;
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* Reviews Section */
    .reviews-section {
      margin-bottom: 60px;
    }

    .review-card {
      padding: 20px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      margin-bottom: 16px;
    }

    .review-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .review-author {
      font-weight: 600;
      color: var(--primary);
    }

    .review-date {
      font-size: 12px;
      color: var(--neutral-gray);
    }

    .review-text {
      color: var(--neutral-gray);
      line-height: 1.6;
      font-size: 14px;
    }

    /* Related Products */
    .related-products {
      margin-bottom: 60px;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 24px;
    }

    .product-card {
      border: 1px solid var(--border-color);
      border-radius: 8px;
      overflow: hidden;
      transition: 0.3s;
      background: white;
    }

    .product-card:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .product-card-image {
      width: 100%;
      height: 200px;
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
      transition: 0.2s;
    }

    .product-card-link:hover {
      color: var(--accent);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .product-detail-container {
        grid-template-columns: 1fr;
        gap: 24px;
        padding: 20px;
      }

      .product-name {
        font-size: 22px;
      }

      .current-price {
        font-size: 24px;
      }

      .main-image {
        height: 350px;
      }

      .features-section {
        grid-template-columns: 1fr;
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
      }

      .action-buttons {
        flex-direction: column;
      }
    }
  </style>

  <div class="container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Trang chủ</a> /
      <a href="{{ route('market.index') }}">Sản phẩm</a> /
      <span>{{ $product->name ?? 'Chi tiết sản phẩm' }}</span>
    </div>

    <!-- Product Detail Container -->
    <div class="product-detail-container">
      <!-- Gallery Section -->
      <div class="gallery-section">
        <div class="main-image">
          <img id="mainImage" src="{{ $product->image_url ?? 'https://via.placeholder.com/500x500?text=Product+Image' }}"
            alt="{{ $product->name }}">
        </div>
        <div class="thumbnail-gallery">
          <div class="thumbnail active"
            onclick="changeImage('{{ $product->image_url ?? 'https://via.placeholder.com/500x500?text=Product+Image' }}')">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/500x500?text=Product+Image' }}" alt="">
          </div>
          <div class="thumbnail" onclick="changeImage('https://via.placeholder.com/500x500?text=Product+Angle+2')">
            <img src="https://via.placeholder.com/500x500?text=Product+Angle+2" alt="">
          </div>
          <div class="thumbnail" onclick="changeImage('https://via.placeholder.com/500x500?text=Product+Angle+3')">
            <img src="https://via.placeholder.com/500x500?text=Product+Angle+3" alt="">
          </div>
          <div class="thumbnail" onclick="changeImage('https://via.placeholder.com/500x500?text=Product+Detail')">
            <img src="https://via.placeholder.com/500x500?text=Product+Detail" alt="">
          </div>
        </div>
      </div>

      <!-- Product Info Section -->
      <div class="product-info-section">
        <!-- Header -->
        <div class="product-header">
          <div class="product-brand">{{ $product->brand ?? 'Premium Brand' }}</div>
          <h1 class="product-name">{{ $product->name }}</h1>

          <!-- Rating -->
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
          <div class="current-price">₫{{ number_format($product->price ?? 1990000, 0, ',', '.') }}</div>
          @if($product->old_price ?? false)
            <span class="original-price">₫{{ number_format($product->old_price, 0, ',', '.') }}</span>
            <span
              class="discount-badge">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
          @endif
          <div class="stock-status in-stock">✓ Còn {{ $product->stock ?? 45 }} sản phẩm</div>
        </div>

        <!-- Product Specs -->
        <div class="product-specs">
          <div class="spec-row">
            <span class="spec-label">Danh mục:</span>
            <span class="spec-value">{{ $product->category_id ?? 'Sản phẩm' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Mã sản phẩm:</span>
            <span class="spec-value">{{ $product->sku ?? 'PRD-001' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Xuất xứ:</span>
            <span class="spec-value">{{ $product->origin ?? 'Việt Nam' }}</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Bảo hành:</span>
            <span class="spec-value">{{ $product->warranty ?? '12 tháng' }}</span>
          </div>
        </div>

        <!-- Variants -->
        @if(isset($product->colors) && count($product->colors))
          <div class="variants-section">
            <label class="variant-label">Chọn màu sắc:</label>
            <div class="variant-options">
              @foreach($product->colors as $color)
                <button class="variant-btn" onclick="selectVariant(this)" data-color="{{ $color }}">
                  {{ $color }}
                </button>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Quantity -->
        <div class="quantity-section">
          <label class="quantity-label">Số lượng:</label>
          <div class="quantity-control">
            <button class="qty-btn" onclick="decreaseQty()">−</button>
            <input type="number" class="qty-input" id="quantity" value="1" min="1">
            <button class="qty-btn" onclick="increaseQty()">+</button>
          </div>
          <button class="wishlist-btn" id="wishlistBtn" onclick="toggleWishlist()">♡</button>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
          <button class="btn btn-add-cart" onclick="addToCart()">🛒 Thêm vào giỏ hàng</button>
          <button class="btn btn-buy-now" onclick="buyNow()">Mua ngay</button>
        </div>

        <!-- Features -->
        <div class="features-section">
          <div class="feature-item">
            <div class="feature-icon">🚚</div>
            <div class="feature-text">Giao hàng miễn phí</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon">🔄</div>
            <div class="feature-text">Trả lại miễn phí</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon">⭐</div>
            <div class="feature-text">Bảo đảm chất lượng</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabs Section -->
    <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 60px;">
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
        <div style="line-height: 2; color: var(--neutral-gray); font-size: 14px;">
          <div><strong>Kích thước:</strong> {{ $product->size ?? '30 x 20 x 15 cm' }}</div>
          <div><strong>Trọng lượng:</strong> {{ $product->weight ?? '500g' }}</div>
          <div><strong>Chất liệu:</strong> {{ $product->material ?? 'Thép không gỉ + Nhựa PVC' }}</div>
          <div><strong>Màu sắc:</strong> {{ $product->color ?? 'Đen, Trắng, Xám' }}</div>
          <div><strong>Năm sản xuất:</strong> {{ $product->year ?? '2024' }}</div>
        </div>
      </div>

      <!-- Related Products -->
      <div class="related-products">
        <h2 class="section-title">Sản phẩm liên quan</h2>

        <div class="products-grid">
          @for ($i = 1; $i <= 4; $i++)
            <div class="product-card">
              <div class="product-card-image">
                <img src="https://via.placeholder.com/250x200?text=Related+Product+{{ $i }}" alt="Sản phẩm liên quan">
              </div>
              <div class="product-card-info">
                <h3 class="product-card-name">Sản phẩm liên quan {{ $i }}</h3>
                <div class="product-card-price">₫{{ number_format(1490000 + ($i * 100000), 0, ',', '.') }}</div>
                <a href="#" class="product-card-link">Xem chi tiết →</a>
              </div>
            </div>
          @endfor
        </div>
      </div>
    </div>
  </div>
  <script>
    function changeImage(src) {
      document.getElementById('mainImage').src = src;
      document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
      event.target.closest('.thumbnail').classList.add('active');
    }

    function selectVariant(btn) {
      document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
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
      alert('Đã thêm ' + document.getElementById('quantity').value + ' sản phẩm vào giỏ hàng!');
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