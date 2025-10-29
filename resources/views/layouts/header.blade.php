<nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255,255,255,0.1);">
  <div class="container">

    <a class="navbar-brand text-white fw-bold" href="/">🎣 FishShop</a>

    <!-- Toggle cho mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFishShop" aria-controls="navbarFishShop" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarFishShop">
      <ul class="nav nav-tabs me-auto ms-3 border-0">
        <!-- Trang chủ -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active text-primary fw-bold' : 'text-white-50' }}" href="/">Trang chủ</a>
        </li>

        <!-- Cửa hàng -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('market') ? 'active text-primary fw-bold' : 'text-white-50' }}" href="/market">Cửa hàng</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white-50" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Tin tức</a>
          <ul class="dropdown-menu bg-dark border-secondary">
            <li><a class="dropdown-item text-light" href="#">Bài viết mới</a></li>
            <li><a class="dropdown-item text-light" href="#">Sự kiện</a></li>
            <li><a class="dropdown-item text-light" href="#">Khuyến mãi</a></li>
            <li><hr class="dropdown-divider border-secondary"></li>
            <li><a class="dropdown-item text-light" href="#">Xem tất cả</a></li>
          </ul>
        </li>

        <!-- Liên hệ -->
        <li class="nav-item">
          <a class="nav-link text-white-50" href="#">Chính sách mua hàng</a>
        </li>
      </ul>

      <div class="d-flex">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Đăng nhập</a>
          <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Đăng ký</a>
        @else
          <span class="text-white me-3">Xin chào, {{ Auth::user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Đăng xuất</button>
          </form>
        @endguest
      </div>
    </div>
  </div>
</nav>
<style>
  .nav-tabs .nav-link.active {
  background: none;
  border: none;
  border-bottom: 2px solid #7055ff;
}
.nav-tabs .nav-link {
  border: none;
  color: #bbb;
  transition: 0.3s;
}
.nav-tabs .nav-link:hover {
  color: #fff;
}
.dropdown-menu {
  border-radius: 8px;
  min-width: 180px;
}
.dropdown-item:hover {
  background-color: rgba(255,255,255,0.1);
}
</style>
