<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-lg">
    <!-- Logo với design hiện đại hơn -->
    <a class="navbar-brand" href="/">
      <span class="brand-icon">🎣</span>
      <span class="brand-text">FishShop</span>
    </a>

    <!-- Mobile toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFishShop" aria-controls="navbarFishShop" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarFishShop">
      <!-- Navigation menu với styling mới -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
            <span class="nav-text">Trang chủ</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('market') ? 'active' : '' }}" href="/market">
            <span class="nav-text">Cửa hàng</span>
          </a>
        </li>

        <!-- Dropdown menu với style mới -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="nav-text">Tin tức</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Bài viết mới</a></li>
            <li><a class="dropdown-item" href="#">Sự kiện</a></li>
            <li><a class="dropdown-item" href="#">Khuyến mãi</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Xem tất cả</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/chinhsach">
            <span class="nav-text">Chính sách mua hàng</span>
          </a>
        </li>
      </ul>

      <!-- Auth buttons với design phù hợp theme -->
      <div class="auth-buttons ms-lg-3">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline-nav btn-sm me-2">
            Đăng nhập
          </a>
          <a href="{{ route('register') }}" class="btn btn-nav btn-sm">
            Đăng ký
          </a>
        @else
          <div class="user-menu">
            <span class="user-greeting">Xin chào, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-nav-logout btn-sm ms-2">
                Đăng xuất
              </button>
            </form>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<style>
  /* Navbar styling với theme xanh lục/xanh dương */
  .navbar-custom {
    background: linear-gradient(135deg, #0f6b3d 0%, #0d8b6d 100%);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 0.75rem 0;
  }

  .brand-icon {
    font-size: 1.5rem;
    margin-right: 0.5rem;
  }

  .brand-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    transition: opacity 0.3s ease;
  }

  .navbar-brand:hover {
    opacity: 0.8;
  }

  /* Navigation link styling */
  .navbar-nav .nav-link {
    position: relative;
    color: rgba(255, 255, 255, 0.8) !important;
    font-weight: 500;
    font-size: 0.95rem;
    margin: 0 0.25rem;
    padding: 0.5rem 0.75rem !important;
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    color: #fff !important;
  }

  .navbar-nav .nav-link.active {
    color: #fff !important;
  }

  .navbar-nav .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 3px;
    background: #fff;
    border-radius: 2px;
  }

  /* Dropdown menu styling */
  .dropdown-menu-custom {
    background: #0d5a35;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    min-width: 200px;
  }

  .dropdown-menu-custom .dropdown-item {
    color: rgba(255, 255, 255, 0.85);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
  }

  .dropdown-menu-custom .dropdown-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
  }

  .dropdown-menu-custom .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.15);
  }

  /* Auth buttons styling */
  .auth-buttons {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-outline-nav {
    border: 2px solid rgba(255, 255, 255, 0.5);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    padding: 0.4rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .btn-outline-nav:hover {
    border-color: #fff;
    color: #fff;
    background: rgba(255, 255, 255, 0.1);
  }

  .btn-nav {
    background: #fbbf24;
    border: none;
    color: #0f6b3d;
    font-weight: 600;
    padding: 0.4rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .btn-nav:hover {
    background: #f59e0b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
  }

  /* User menu styling */
  .user-menu {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
  }

  .user-greeting {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    font-size: 0.95rem;
  }

  .btn-nav-logout {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #fff;
    font-weight: 600;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .btn-nav-logout:hover {
    background: rgba(255, 67, 54, 0.3);
    border-color: rgba(255, 67, 54, 0.5);
  }

  /* Mobile responsive */
  @media (max-width: 991px) {
    .navbar-collapse {
      margin-top: 1rem;
    }

    .navbar-nav {
      flex-direction: column;
    }

    .navbar-nav .nav-link.active::after {
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

    .user-menu {
      flex-direction: column;
      width: 100%;
    }

    .btn-nav-logout {
      width: 100%;
    }
  }

  .navbar-toggler {
    border-color: rgba(255, 255, 255, 0.3);
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
</style>

