@php
  $cart = session('cart', []);
  $cartCount = collect($cart)->sum('quantity');
@endphp

<style>
  /* Navbar chuyên nghiệp hiện đại */
  .navbar-custom {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(26, 71, 42, 0.15);
    padding: 0.5rem 0;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .navbar-custom.scrolled {
    box-shadow: 0 4px 30px rgba(26, 71, 42, 0.25);
  }

  /* Logo thiết kế đẹp */
  .navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
  }

  .brand-logo {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
  }

  .navbar-brand:hover .brand-logo {
    transform: scale(1.05) rotate(-5deg);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
  }

  .brand-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    margin: 0;
  }

  /* Navigation links hiện đại */
  .navbar-nav {
    gap: 8px;
  }

  .navbar-nav .nav-link {
    position: relative;
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    font-size: 15px;
    padding: 0.6rem 1rem !important;
    transition: all 0.3s ease;
    border-radius: 8px;
  }

  .navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 8px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 60%;
    height: 2px;
    background: #FFD700;
    transition: transform 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff !important;
  }

  .navbar-nav .nav-link:hover::after,
  .navbar-nav .nav-link.active::after {
    transform: translateX(-50%) scaleX(1);
  }

  .navbar-nav .nav-link.active {
    background: rgba(255, 255, 255, 0.15);
    color: #fff !important;
  }

  /* Dropdown menu đẹp mắt */
  .dropdown-menu-custom {
    background: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    padding: 8px;
    margin-top: 8px;
    min-width: 220px;
    animation: dropdownFade 0.3s ease;
  }

  @keyframes dropdownFade {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .dropdown-menu-custom .dropdown-item {
    color: #374151;
    padding: 0.7rem 1rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-size: 14px;
    font-weight: 500;
  }

  .dropdown-menu-custom .dropdown-item:hover {
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    color: #1a472a;
    transform: translateX(4px);
  }

  .dropdown-menu-custom .dropdown-divider {
    margin: 8px 0;
    border-color: #e5e7eb;
  }

  /* Cart icon hiện đại */
  .cart-icon-wrapper {
    position: relative;
    margin-left: 12px;
  }

  .cart-icon-link {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .cart-icon-link:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
  }

  .cart-icon-svg {
    width: 22px;
    height: 22px;
    stroke: white;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .cart-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #1a472a;
    font-size: 11px;
    font-weight: 700;
    border-radius: 10px;
    padding: 3px 7px;
    line-height: 1;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);
    min-width: 20px;
    text-align: center;
  }

  /* Auth buttons */
  .auth-buttons {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-left: 16px;
  }

  .btn-outline-nav {
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 14px;
  }

  .btn-outline-nav:hover {
    background: white;
    border-color: white;
    color: #1a472a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
  }

  /* User dropdown */
  .user-dropdown {
    position: relative;
  }

  .user-greeting {
    display: flex;
    align-items: center;
    gap: 8px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    padding: 0.5rem 1rem;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .user-greeting:hover {
    background: rgba(255, 255, 255, 0.25);
    color: white;
  }

  .user-greeting::after {
    content: '▼';
    font-size: 10px;
    transition: transform 0.3s ease;
  }

  .user-dropdown.show .user-greeting::after {
    transform: rotate(180deg);
  }

  .user-dropdown-menu {
    background: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    padding: 8px;
    margin-top: 8px;
    min-width: 200px;
    animation: dropdownFade 0.3s ease;
  }

  .user-dropdown-menu .dropdown-item {
    color: #374151;
    padding: 0.7rem 1rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-size: 14px;
    font-weight: 500;
  }

  .user-dropdown-menu .dropdown-item:hover {
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    color: #1a472a;
  }

  .user-dropdown-menu .dropdown-item.text-danger {
    color: #dc2626;
  }

  .user-dropdown-menu .dropdown-item.text-danger:hover {
    background: #fee2e2;
    color: #991b1b;
  }

  /* Mobile responsive */
  @media (max-width: 991px) {
    .navbar-collapse {
      margin-top: 1rem;
      padding: 1rem;
      background: rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }

    .navbar-nav {
      gap: 4px;
    }

    .navbar-nav .nav-link {
      padding: 0.75rem 1rem !important;
    }

    .navbar-nav .nav-link::after {
      display: none;
    }

    .cart-icon-wrapper {
      margin: 1rem 0;
    }

    .cart-icon-link {
      width: 100%;
      justify-content: center;
    }

    .auth-buttons {
      margin: 1rem 0 0 0;
      flex-direction: column;
      width: 100%;
      gap: 8px;
    }

    .btn-outline-nav,
    .user-greeting {
      width: 100%;
      justify-content: center;
      text-align: center;
    }
  }

  /* Mobile toggle button */
  .navbar-toggler {
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 0.5rem;
    border-radius: 8px;
  }

  .navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
</style>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-lg">
    <!-- Logo -->
    <a class="navbar-brand" href="/">
      <span class="brand-text">FishShop</span>
    </a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFishShop"
      aria-controls="navbarFishShop" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarFishShop">
      <!-- Navigation menu -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
            Trang chủ
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('market') ? 'active' : '' }}" href="/market">
            Cửa hàng
          </a>
        </li>

        <!-- Dropdown menu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Khám phá
          </a>
          <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Bài viết mới</a></li>
            <li><a class="dropdown-item" href="/tintuc">Nhật ký cần thủ</a></li>
            <li><a class="dropdown-item" href="/khuyenmai">Khuyến mãi</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Xem tất cả</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/chinhsach">
            Chính sách
          </a>
        </li>
      </ul>

      <!-- Cart icon -->
      @if (! (Auth::user()->is_admin ?? false))
      <div class="cart-icon-wrapper">
        <a href="{{ route('cart.index') }}" class="cart-icon-link">
          <svg class="cart-icon-svg" viewBox="0 0 24 24">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
          @endif
        </a>
      </div>
      @endif

      <!-- Auth buttons -->
      <div class="auth-buttons">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline-nav btn-sm">
            Đăng nhập
          </a>
        @else
          <div class="dropdown user-dropdown">
            <a class="user-greeting dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu">
              @if (! (Auth::user()->is_admin ?? false))
              <li><a class="dropdown-item" href="{{ route('orders.index') }}">Đơn hàng của tôi</a></li>
              @endif

              @if (Auth::user()->is_admin ?? false)
                <li><a class="dropdown-item" href="{{ url('/admin') }}">Trang quản trị</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              @endif

              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                </form>
              </li>
            </ul>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<script>
// Add scrolled class to navbar when scrolling
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar-custom');
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});
</script>