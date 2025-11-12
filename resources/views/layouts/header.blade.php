@php
  $cart = session('cart', []);
  $cartCount = collect($cart)->sum('quantity');
@endphp
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-lg">
    <!-- Logo với animation -->
    <a class="navbar-brand" href="/">
      <span class="brand-icon"></span>
      <span class="brand-text">FishShop</span>
    </a>

    <!-- Mobile toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFishShop"
      aria-controls="navbarFishShop" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarFishShop">
      <!-- Navigation menu với animation -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
            <span class="nav-text">Trang chủ</span>
            <span class="nav-underline"></span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('market') ? 'active' : '' }}" href="/market">
            <span class="nav-text">Cửa hàng</span>
            <span class="nav-underline"></span>
          </a>
        </li>

        <!-- Dropdown menu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="nav-text">Tin tức</span>
            <span class="nav-underline"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item dropdown-item-animated" href="#">Bài viết mới</a></li>
            <li><a class="dropdown-item dropdown-item-animated" href="/tintuc">Tin tức</a></li>
            <li><a class="dropdown-item dropdown-item-animated" href="/khuyenmai">Khuyến mãi</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item dropdown-item-animated" href="#">Xem tất cả</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/chinhsach">
            <span class="nav-text">Chính sách mua hàng</span>
            <span class="nav-underline"></span>
          </a>
        </li>
      </ul>

      @if (! (Auth::user()->is_admin ?? false))
      <a href="{{ route('cart.index') }}" class="cart-icon-link"
        style="position: relative; display: inline-block; text-decoration: none; margin-left: 12px;">
        <span class="cart-icon-emoji">🛒</span>
        @if($cartCount > 0)
          <span class="cart-badge">{{ $cartCount }}</span>
        @endif
      </a>
      @endif

      <!-- Auth buttons -->
      <div class="auth-buttons ms-lg-3">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline-nav btn-sm me-2">
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
              <li><a class="dropdown-item dropdown-item-animated" href="{{ route('orders.index') }}">Đơn hàng của tôi</a></li>
              @endif

              @if (Auth::user()->is_admin ?? false)
                <li><a class="dropdown-item dropdown-item-animated" href="{{ url('/admin') }}">Trang quản trị</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              @endif

              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger dropdown-item-animated">Đăng xuất</button>
                </form>
              </li>
            </ul>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<style>
  /* Enhanced navbar with smooth animations and visual effects */
  .navbar-custom {
    background: linear-gradient(135deg, #0f6b3d 0%, #0d8b6d 100%);
    backdrop-filter: blur(10px);
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    padding: 0.75rem 0;
    transition: all 0.3s ease;
  }

  /* Animated logo with scale and glow effect */
  .brand-icon {
    font-size: 1.8rem;
    margin-right: 0.75rem;
    display: inline-block;
    animation: iconBounce 2s ease-in-out infinite;
    transition: transform 0.3s ease;
  }

  .navbar-brand:hover .brand-icon {
    transform: scale(1.15) rotate(5deg);
    animation: none;
  }

  .brand-text {
    font-size: 1.6rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    transition: all 0.3s ease;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
  }

  .navbar-brand:hover {
    opacity: 0.95;
    filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.2));
  }

  /* Navigation links with animated underline effect */
  .navbar-nav .nav-link {
    position: relative;
    color: rgba(255, 255, 255, 0.85) !important;
    font-weight: 500;
    font-size: 0.95rem;
    margin: 0 0.25rem;
    padding: 0.5rem 0.75rem !important;
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .navbar-nav .nav-link .nav-text {
    position: relative;
    z-index: 2;
    transition: color 0.3s ease;
  }

  .nav-underline {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 2px;
  }

  .navbar-nav .nav-link:hover .nav-underline,
  .navbar-nav .nav-link.active .nav-underline {
    width: 100%;
  }

  .navbar-nav .nav-link:hover .nav-text {
    color: #fff !important;
  }

  .navbar-nav .nav-link.active .nav-text {
    color: #fff !important;
  }

  /* Dropdown menu with smooth animations */
  .dropdown-menu-custom {
    background: linear-gradient(135deg, #0d5a35 0%, #0a4a2a 100%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.1);
    min-width: 200px;
    animation: slideDown 0.3s ease;
    backdrop-filter: blur(20px);
  }

  .dropdown-menu-custom .dropdown-item-animated {
    color: rgba(255, 255, 255, 0.85);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    position: relative;
  }

  .dropdown-item-animated::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: #fbbf24;
    transform: scaleY(0);
    transform-origin: center;
    transition: transform 0.3s ease;
  }

  .dropdown-menu-custom .dropdown-item-animated:hover::before {
    transform: scaleY(1);
  }

  .dropdown-menu-custom .dropdown-item-animated:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    transform: translateX(4px);
  }

  .dropdown-menu-custom .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1);
  }

  /* Cart icon with pulse animation */
  .cart-icon-link {
    color: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
    display: inline-block;
  }

  .cart-icon-emoji {
    display: inline-block;
    animation: cartSway 1.5s ease-in-out infinite;
    transition: transform 0.3s ease;
  }

  .cart-icon-link:hover .cart-icon-emoji {
    transform: scale(1.15) rotate(10deg);
    animation: none;
  }

  .cart-badge {
    position: absolute;
    top: -8px;
    right: -12px;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: #0f6b3d;
    font-size: 11px;
    font-weight: 700;
    border-radius: 50%;
    padding: 3px 7px;
    line-height: 1;
    box-shadow: 0 2px 8px rgba(251, 191, 36, 0.4);
    animation: badgePulse 2s ease-in-out infinite;
  }

  /* Auth buttons with enhanced hover effects */
  .auth-buttons {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .btn-outline-nav {
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    padding: 0.5rem 1.2rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .btn-outline-nav::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    transition: left 0.3s ease;
  }

  .btn-outline-nav:hover::before {
    left: 0;
  }

  .btn-outline-nav:hover {
    border-color: #fff;
    color: #fff;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }

  /* User dropdown with smooth animations */
  .user-dropdown {
    position: relative;
  }

  .user-greeting {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
  }

  .user-greeting:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
  }

  .user-dropdown-menu {
    background: linear-gradient(135deg, #0d5a35 0%, #0a4a2a 100%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.3);
    min-width: 200px;
    animation: slideDown 0.3s ease;
    backdrop-filter: blur(20px);
  }

  .user-dropdown-menu .dropdown-item {
    color: rgba(255, 255, 255, 0.85);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    position: relative;
  }

  .user-dropdown-menu .dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: #fbbf24;
    transform: scaleY(0);
    transition: transform 0.3s ease;
  }

  .user-dropdown-menu .dropdown-item:hover::before {
    transform: scaleY(1);
  }

  .user-dropdown-menu .dropdown-item:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    transform: translateX(4px);
  }

  .user-dropdown-menu .dropdown-item.text-danger:hover {
    background: rgba(255, 0, 0, 0.2);
    color: #ffaaaa;
  }

  /* Animations */
  @keyframes iconBounce {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-6px) rotate(-5deg); }
  }

  @keyframes cartSway {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-8deg); }
    75% { transform: rotate(8deg); }
  }

  @keyframes badgePulse {
    0%, 100% { transform: scale(1); box-shadow: 0 2px 8px rgba(251, 191, 36, 0.4); }
    50% { transform: scale(1.1); box-shadow: 0 4px 16px rgba(251, 191, 36, 0.6); }
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Mobile responsive */
  @media (max-width: 991px) {
    .navbar-collapse {
      margin-top: 1rem;
    }

    .navbar-nav {
      flex-direction: column;
    }

    .nav-underline {
      display: none;
    }

    .auth-buttons {
      margin-top: 1rem;
      flex-direction: column;
      width: 100%;
    }

    .auth-buttons .btn {
      width: 100%;
      text-align: center;
    }

    .user-greeting {
      width: 100%;
      text-align: center;
    }
  }

  .navbar-toggler {
    border-color: rgba(255, 255, 255, 0.3);
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
</style>
