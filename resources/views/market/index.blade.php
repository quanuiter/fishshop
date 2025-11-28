@extends('layouts.app')

@section('title', 'FishShop Market')

@section('content')
<x-breadcrumb />
  <style>
    body {
      background: linear-gradient(135deg, #f5f7f6 0%, #e8eef0 100%);
      color: #333;
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
    }

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
      overflow: hidden;
    }

    .market-banner::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(15, 107, 61, 0.85), rgba(13, 139, 109, 0.6));
      z-index: 1;
      animation: gradientShift 8s ease-in-out infinite;
    }

    @keyframes gradientShift {
      0%, 100% { background: linear-gradient(135deg, rgba(15, 107, 61, 0.85), rgba(13, 139, 109, 0.6)); }
      50% { background: linear-gradient(135deg, rgba(13, 139, 109, 0.75), rgba(15, 107, 61, 0.7)); }
    }

    .market-banner h1 {
      position: relative;
      z-index: 2;
      font-size: 2.8rem;
      font-weight: 700;
      margin: 40px 0 0 60px;
      animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .category-bar {
      position: relative;
      z-index: 3;
      display: flex;
      justify-content: center;
      gap: 25px;
      padding: 30px 20px;
      flex-wrap: wrap;
      width: 100%;
      animation: slideUp 0.8s ease-out 0.2s backwards;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .category-item {
      text-align: center;
      color: #fff;
      font-weight: 600;
      transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      position: relative;
    }

    .category-item-icon {
      background-color: rgba(31, 31, 31, 0.85);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 140px;
      height: 90px;
      border-radius: 12px;
      transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(251, 191, 36, 0.2);
    }

    .category-item img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .category-item:hover .category-item-icon {
      background-color: rgba(31, 31, 31, 0.95);
      box-shadow: 0 12px 30px rgba(251, 191, 36, 0.3), inset 0 0 20px rgba(251, 191, 36, 0.1);
      transform: translateY(-8px) scale(1.05);
      border-color: rgba(251, 191, 36, 0.5);
    }

    .category-item:hover img {
      transform: scale(1.2) rotate(5deg);
    }

    .category-item:hover {
      color: #fbbf24;
    }

    .category-item.active-category .category-item-icon {
      background: linear-gradient(135deg, #207a77 0%, #0d8b6d 100%);
      box-shadow: 0 0 20px rgba(251, 191, 36, 0.9), inset 0 0 20px rgba(251, 191, 36, 0.2);
      transform: scale(1.1);
    }

    .category-item.active-category span {
      color: #fbbf24;
      font-weight: 700;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* Enhanced Filter Bar */
    .filter-bar {
      background: white;
      padding: 20px 40px;
      border-bottom: 1px solid #e5e7eb;
      animation: fadeIn 0.8s ease-out 0.4s backwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .filter-container {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      gap: 15px;
      align-items: center;
      flex-wrap: wrap;
    }

    .filter-group {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .filter-select {
      background-color: #fff;
      color: #333;
      border: 1px solid #dee2e6;
      padding: 10px 14px;
      border-radius: 8px;
      outline: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      cursor: pointer;
      min-width: 140px;
    }

    .filter-select:hover,
    .filter-select:focus {
      border-color: #1a472a;
      box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
    }

    .price-range-inputs {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .price-input {
      width: 110px;
      padding: 10px 12px;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .price-input:focus {
      outline: none;
      border-color: #1a472a;
      box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
    }

    .price-separator {
      color: #6c757d;
      font-weight: 500;
    }

    .search-box {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 0;
    }

    .search-box input {
      background-color: #fff;
      border: 1px solid #dee2e6;
      padding: 10px 15px;
      border-radius: 8px 0 0 8px;
      width: 250px;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 0.9rem;
    }

    .search-box input:focus {
      outline: none;
      border-color: #1a472a;
      box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
    }

    .search-box button {
      background: #1a472a;
      border: none;
      padding: 10px 20px;
      border-radius: 0 8px 8px 0;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
      cursor: pointer;
      font-size: 0.9rem;
    }

    .search-box button:hover {
      background: #0f5132;
      transform: translateY(-1px);
    }

    .btn-reset-filter {
      padding: 10px 18px;
      background: #6c757d;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 500;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .btn-reset-filter:hover {
      background: #5a6268;
      transform: translateY(-1px);
    }

    .active-filters {
      max-width: 1400px;
      margin: 0 auto;
      padding: 15px 40px 0;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .filter-tag {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #e9ecef;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      color: #495057;
      font-weight: 500;
    }

    .filter-tag-close {
      cursor: pointer;
      color: #6c757d;
      font-weight: 700;
      transition: color 0.2s;
    }

    .filter-tag-close:hover {
      color: #dc3545;
    }

    .products-container {
      background: linear-gradient(135deg, #f5f7f6 0%, #e8eef0 100%);
      padding: 40px 60px;
      position: relative;
    }

    .products-container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 20% 50%, rgba(15, 107, 61, 0.05), transparent 50%),
                  radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.03), transparent 50%);
      pointer-events: none;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 24px;
      max-width: 1400px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .product-card {
      background: white;
      border-radius: 14px;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      box-shadow: 0 4px 12px rgba(15, 107, 61, 0.08);
      display: flex;
      flex-direction: column;
      cursor: pointer;
      border: 1px solid rgba(15, 107, 61, 0.05);
      animation: fadeInScale 0.6s ease-out backwards;
    }

    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: scale(0.95) translateY(10px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.15s; }
    .product-card:nth-child(3) { animation-delay: 0.2s; }
    .product-card:nth-child(4) { animation-delay: 0.25s; }
    .product-card:nth-child(n+5) { animation-delay: 0.3s; }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 16px 32px rgba(15, 107, 61, 0.15);
      border-color: rgba(251, 191, 36, 0.3);
    }

    .product-image {
      width: 100%;
      height: 200px;
      background: linear-gradient(135deg, #f0f0f0 0%, #e5e5e5 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    .product-image::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, transparent 0%, rgba(0, 0, 0, 0.05) 100%);
      pointer-events: none;
    }

    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .product-card:hover .product-image img {
      transform: scale(1.12) rotate(2deg);
    }

    .product-info {
      padding: 18px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .product-name {
      font-size: 0.95rem;
      font-weight: 600;
      color: #0f5132;
      margin-bottom: 10px;
      line-height: 1.4;
      transition: color 0.3s ease;
    }

    .product-card:hover .product-name {
      color: #fbbf24;
    }

    .product-price {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1a472a;
      margin-bottom: 14px;
    }

    .product-price .currency {
      font-size: 0.9rem;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .filter-container {
        flex-direction: column;
        align-items: stretch;
      }
      
      .filter-group {
        flex-wrap: wrap;
      }
      
      .search-box {
        margin-left: 0;
        width: 100%;
      }
      
      .search-box input {
        flex: 1;
      }
    }
  </style>

  <div class="market-banner">
    <h1>FishShop Market</h1>

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
          <img src="{{ url('image/icons/all.png') }}" alt="Xem Tất">
        </div>
        <span>Xem tất</span>
      </div>
    </div>
  </div>

  <div class="filter-bar">
    <div class="filter-container">
      <div class="filter-group">
        <select id="sortSelect" class="filter-select">
          <option value="">Sắp xếp</option>
          <option value="price_asc">Giá tăng dần</option>
          <option value="price_desc">Giá giảm dần</option>
          <option value="name_asc">Tên A-Z</option>
          <option value="name_desc">Tên Z-A</option>
        </select>

        <select id="stockSelect" class="filter-select">
          <option value="">Tình trạng</option>
          <option value="in_stock">Còn hàng</option>
          <option value="out_of_stock">Hết hàng</option>
        </select>
      </div>

      <div class="filter-group price-range-inputs">
        <input type="number" id="minPrice" class="price-input" placeholder="Giá từ" min="0">
        <span class="price-separator">-</span>
        <input type="number" id="maxPrice" class="price-input" placeholder="Giá đến" min="0">
      </div>

      <button class="btn-reset-filter" id="resetFilters">Đặt lại</button>

      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Tìm sản phẩm...">
        <button id="searchBtn">Tìm</button>
      </div>
    </div>

    <div class="active-filters" id="activeFilters"></div>
  </div>

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
    let currentFilters = {
      category: 'all',
      sort: '',
      search: '',
      stock: '',
      minPrice: '',
      maxPrice: ''
    };

    function updateActiveFilters() {
      const container = document.getElementById('activeFilters');
      container.innerHTML = '';

      const filterLabels = {
        sort: {
          'price_asc': 'Giá tăng dần',
          'price_desc': 'Giá giảm dần',
          'name_asc': 'Tên A-Z',
          'name_desc': 'Tên Z-A'
        },
        stock: {
          'in_stock': 'Còn hàng',
          'out_of_stock': 'Hết hàng'
        }
      };

      if (currentFilters.search) {
        addFilterTag('search', `Tìm kiếm: ${currentFilters.search}`);
      }

      if (currentFilters.sort) {
        addFilterTag('sort', filterLabels.sort[currentFilters.sort]);
      }

      if (currentFilters.stock) {
        addFilterTag('stock', filterLabels.stock[currentFilters.stock]);
      }

      if (currentFilters.minPrice || currentFilters.maxPrice) {
        const min = currentFilters.minPrice ? `${Number(currentFilters.minPrice).toLocaleString()}đ` : '0đ';
        const max = currentFilters.maxPrice ? `${Number(currentFilters.maxPrice).toLocaleString()}đ` : '∞';
        addFilterTag('price', `Giá: ${min} - ${max}`);
      }
    }

    function addFilterTag(key, label) {
      const container = document.getElementById('activeFilters');
      const tag = document.createElement('div');
      tag.className = 'filter-tag';
      tag.innerHTML = `
        ${label}
        <span class="filter-tag-close" data-filter="${key}">×</span>
      `;
      container.appendChild(tag);

      tag.querySelector('.filter-tag-close').addEventListener('click', () => {
        removeFilter(key);
      });
    }

    function removeFilter(key) {
      if (key === 'search') {
        currentFilters.search = '';
        document.getElementById('searchInput').value = '';
      } else if (key === 'sort') {
        currentFilters.sort = '';
        document.getElementById('sortSelect').value = '';
      } else if (key === 'stock') {
        currentFilters.stock = '';
        document.getElementById('stockSelect').value = '';
      } else if (key === 'price') {
        currentFilters.minPrice = '';
        currentFilters.maxPrice = '';
        document.getElementById('minPrice').value = '';
        document.getElementById('maxPrice').value = '';
      }
      fetchProducts();
    }

    function setActiveCategory(catElement) {
      document.querySelectorAll('.category-item').forEach(c => c.classList.remove('active-category'));
      catElement.classList.add('active-category');
    }

    function fetchProducts() {
      const params = new URLSearchParams(currentFilters).toString();

      fetch(`{{ route('market.filter') }}?${params}`)
        .then(res => res.text())
        .then(html => {
          document.getElementById('productGrid').innerHTML = html;
          document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', () => window.location.href = card.dataset.url);
          });
          updateActiveFilters();
        })
        .catch(error => console.error('Error:', error));
    }

    // Event Listeners
    document.getElementById('searchBtn').addEventListener('click', () => {
      currentFilters.search = document.getElementById('searchInput').value;
      fetchProducts();
    });

    document.getElementById('searchInput').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        currentFilters.search = e.target.value;
        fetchProducts();
      }
    });

    document.getElementById('sortSelect').addEventListener('change', (e) => {
      currentFilters.sort = e.target.value;
      fetchProducts();
    });

    document.getElementById('stockSelect').addEventListener('change', (e) => {
      currentFilters.stock = e.target.value;
      fetchProducts();
    });

    document.getElementById('minPrice').addEventListener('change', (e) => {
      currentFilters.minPrice = e.target.value;
      fetchProducts();
    });

    document.getElementById('maxPrice').addEventListener('change', (e) => {
      currentFilters.maxPrice = e.target.value;
      fetchProducts();
    });

    document.getElementById('resetFilters').addEventListener('click', () => {
      currentFilters = {
        category: currentFilters.category,
        sort: '',
        search: '',
        stock: '',
        minPrice: '',
        maxPrice: ''
      };
      document.getElementById('searchInput').value = '';
      document.getElementById('sortSelect').value = '';
      document.getElementById('stockSelect').value = '';
      document.getElementById('minPrice').value = '';
      document.getElementById('maxPrice').value = '';
      fetchProducts();
    });

    document.querySelectorAll('.category-item').forEach(cat => {
      cat.addEventListener('click', () => {
        currentFilters.category = cat.getAttribute('data-category');
        setActiveCategory(cat);
        fetchProducts();
      });
    });

    document.querySelectorAll('.product-card').forEach(card => {
      card.addEventListener('click', () => {
        const url = card.getAttribute('data-url');
        if (url) window.location.href = url;
      });
    });

    setActiveCategory(document.querySelector('.category-item[data-category="all"]'));
  </script>

@endsection