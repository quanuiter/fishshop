@extends('layouts.app')

@section('title', 'FishShop Market')

@section('content')
<x-breadcrumb />
  <style>
    body {
      background-color: #f8faf8;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }

    /* Banner with categories overlay */
    .market-banner {
      position: relative;
      background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80') center/cover;
      height: 55vh;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: space-between;
      color: white;
      padding-bottom: 40px;
    }

    .market-banner::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(15, 107, 61, 0.8), rgba(15, 107, 61, 0.3));
      z-index: 1;
    }

    .market-banner h1 {
      position: relative;
      z-index: 2;
      font-size: 2.8rem;
      font-weight: 700;
      margin: 40px 0 0 60px;
    }

    /* Category bar now overlays on banner image */
    .category-bar {
      position: relative;
      z-index: 3;
      display: flex;
      justify-content: center;
      gap: 25px;
      padding: 30px 20px;
      flex-wrap: wrap;
      width: 100%;
    }

    .category-item {
      text-align: center;
      color: #fff;
      font-weight: 600;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .category-item-icon {
      background-color: rgba(31, 31, 31, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 140px;
      height: 90px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .category-item img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      transition: transform 0.3s ease;
    }

    .category-item:hover .category-item-icon {
      background-color: rgba(31, 31, 31, 1);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      transform: translateY(-5px);
    }

    .category-item:hover img {
      transform: scale(1.15);
    }

    .category-item:hover {
      color: #fbbf24;
    }

    /* Filter Bar - now below banner with white background */
    .filter-bar {
      background-color: #fff;
      padding: 25px 40px;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      border-bottom: 1px solid #e5e7eb;
    }

    .filter-select {
      background-color: #fff;
      color: #0f5132;
      border: 1px solid #ccc;
      padding: 8px 14px;
      border-radius: 6px;
      outline: none;
      font-weight: 500;
    }

    .filter-select:hover {
      border-color: #fbbf24;
    }

    .search-box {
      margin-left: auto;
      display: flex;
      align-items: center;
    }

    .search-box input {
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 8px 15px;
      border-radius: 6px 0 0 6px;
      width: 250px;
    }

    .search-box button {
      background-color: #fbbf24;
      border: none;
      padding: 8px 18px;
      border-radius: 0 6px 6px 0;
      font-weight: 600;
      color: #0f5132;
      transition: 0.3s;
      cursor: pointer;
    }

    .search-box button:hover {
      background-color: #ffe176;
    }

    /* Thêm CSS cho product grid và cards */
    .products-container {
      background-color: #f8faf8;
      padding: 40px 60px;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 24px;
      max-width: 1400px;
      margin: 0 auto;
    }

    .product-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      cursor: pointer;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(15, 107, 61, 0.15);
    }

    .product-image {
      width: 100%;
      height: 200px;
      background-color: #f0f0f0;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
      transform: scale(1.1);
    }

    .product-info {
      padding: 16px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .product-name {
      font-size: 0.95rem;
      font-weight: 600;
      color: #0f5132;
      margin-bottom: 8px;
      line-height: 1.4;
    }

    .product-rating {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 10px;
      font-size: 0.85rem;
    }

    .product-rating .stars {
      color: #fbbf24;
    }

    .product-rating .count {
      color: #999;
    }

    .product-price {
      font-size: 1.2rem;
      font-weight: 700;
      color: #0f5132;
      margin-bottom: 12px;
    }

    .product-price .currency {
      font-size: 0.9rem;
      font-weight: 600;
    }

    .product-actions {
      display: flex;
      gap: 8px;
      margin-top: auto;
    }

    .btn-add-cart {
      flex: 1;
      background-color: #fbbf24;
      color: #0f5132;
      border: none;
      padding: 10px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-add-cart:hover {
      background-color: #ffe176;
      transform: scale(1.02);
    }

    .category-item.active-category .category-item-icon {
      background-color: #207a77ff !important;
      box-shadow: 0 0 10px rgba(251, 191, 36, 0.8);
      transform: scale(1.05);
    }

    .category-item.active-category span {
      color: #e1ebf5ff;
    }
  </style>

  <!-- Banner now contains both title and category overlay -->
  <div class="market-banner">
    <h1>FishShop Market</h1>

    <!-- Category bar overlay on banner -->
    <div class="category-bar">
      <div class="category-item" data-category="1">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/fishrop.png') }}" alt="Cần câu">
        </div>
        <span>Cần câu</span>
      </div>
      <div class="category-item" data-category="2">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/machinefishrop.png') }}" alt="Máy câu">
        </div>
        <span>Máy câu</span>
      </div>
      <div class="category-item" data-category="3">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/hook.png') }}" alt="Lưỡi câu">
        </div>
        <span>Lưỡi câu</span>
      </div>
      <div class="category-item" data-category="4">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/moicau.png') }}" alt="Mồi câu">
        </div>
        <span>Mồi câu</span>
      </div>
      <div class="category-item" data-category="5">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/tool.png') }}" alt="Phụ kiện">
        </div>
        <span>Phụ kiện</span>
      </div>
      <div class="category-item" data-category="all">
        <div class="category-item-icon">
          <img src="{{ url('image/icons/all.png') }}" alt="Xem Ttất">
        </div>
        <span>Xem tất</span>
      </div>
    </div>
  </div>

  <!-- Filter bar with white background below banner -->
  <div class="filter-bar">
    <select id="sortSelect" class="filter-select">
      <option value="">Sắp xếp</option>
      <option value="price_asc">Giá tăng dần</option>
      <option value="price_desc">Giá giảm dần</option>
      <option value="name_asc">Tên A-Z</option>
      <option value="name_desc">Tên Z-A</option>
    </select>

    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Nhập tên sản phẩm...">
      <button id="searchBtn">Tìm kiếm</button>
    </div>
  </div>

  <!-- Thêm product grid để hiển thị sản phẩm -->
  <div class="products-container">
    <div class="products-grid" id="productGrid">
      @foreach ($products as $product)
        <div class="product-card" data-url="{{ route('product.show', $product->id) }}">
          <div class="product-image">
            <img src="{{ $product->images->first()?->image_url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}" alt="{{ $product->name }}">
          </div>
          <div class="product-info">
            <h3 class="product-name">{{ $product->name }}</h3>
            <div class="product-price">
              <span class="currency">₫</span> {{ number_format($product->getMinPrice(), 0, ',', '.') }}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <script>
    // chuyển sang trang chi tiết sản phẩm
    document.querySelectorAll('.product-card').forEach(card => {
      card.addEventListener('click', () => {
        const url = card.getAttribute('data-url');
        if (url) window.location.href = url;
      });
    });

    // =======================
    //  AJAX FILTER SYSTEM
    // =======================
    let currentCategory = 'all'; // lưu category hiện tại

    function setActiveCategory(catElement) {
      document.querySelectorAll('.category-item').forEach(c => c.classList.remove('active-category'));
      catElement.classList.add('active-category');
    }

    function fetchProducts(params = {}) {
      params.category = currentCategory;
      let query = new URLSearchParams(params).toString();

      fetch(`{{ route('market.filter') }}?${query}`)
        .then(res => res.text())
        .then(html => {
          document.getElementById('productGrid').innerHTML = html;
          document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', () => window.location.href = card.dataset.url);
          });
        });
    }

    // --- Event listeners ---
    document.getElementById('searchBtn').addEventListener('click', () => {
      fetchProducts({ search: document.getElementById('searchInput').value });
    });

    document.getElementById('sortSelect').addEventListener('change', (e) => {
      fetchProducts({ sort: e.target.value, search: document.getElementById('searchInput').value });
    });

    document.querySelectorAll('.category-item').forEach(cat => {
      cat.addEventListener('click', () => {
        currentCategory = cat.getAttribute('data-category');
        setActiveCategory(cat); // đổi màu category được chọn
        fetchProducts(); // load sản phẩm theo category
      });
    });

    // mặc định chọn "Xem tất"
    setActiveCategory(document.querySelector('.category-item[data-category="all"]'));
  </script>

@endsection