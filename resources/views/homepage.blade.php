@extends('layouts.app')

@section('title', 'Trang chủ - FishShop')

@section('content')
<x-breadcrumb />

<style>
  .hero-slider {
    position: relative;
    height: 90vh;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
    background: #000;
  }

  .slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transform: scale(1.05);
    transition: opacity 1s ease, transform 3s ease;
  }

  .slide.active {
    opacity: 1;
    transform: scale(1);
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.3), transparent);
    z-index: 1;
  }

  .hero-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    z-index: 2;
    color: #fff;
    max-width: 600px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease;
  }

  .slide.active .hero-content {
    opacity: 1;
    transform: translateY(-50%);
  }

  .hero-content .tag {
    color: #fbbf24;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  .hero-content h1 {
    font-size: 3.2rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0.5rem;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
  }

  .hero-content p {
    font-size: 1.1rem;
    color: #e5e7eb;
    margin-bottom: 1.5rem;
  }

  .btn-shop, .btn-more {
    display: inline-block;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .btn-shop {
    background-color: #fbbf24;
    color: #0f5132;
    border: none;
  }

  .btn-shop:hover {
    background-color: #ffe176;
    transform: translateY(-3px);
  }

  .btn-more {
    border: 2px solid #fff;
    color: #fff;
    margin-left: 12px;
  }

  .btn-more:hover {
    background: #fff;
    color: #000;
    transform: translateY(-3px);
  }

  .slider-nav {
    position: absolute;
    bottom: 30px;
    left: 10%;
    display: flex;
    gap: 8px;
    z-index: 3;
  }

  .nav-dot {
    width: 35px;
    height: 4px;
    background: rgba(255,255,255,0.4);
    border-radius: 2px;
    cursor: pointer;
    transition: all 0.3s;
  }

  .nav-dot.active {
    background: #fbbf24;
    width: 45px;
  }

  .arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    color: #fff;
    background: rgba(0,0,0,0.3);
    border-radius: 50%;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    z-index: 3;
  }

  .arrow:hover {
    background: rgba(251,191,36,0.8);
    color: #000;
    transform: translateY(-50%) scale(1.1);
  }

  .arrow.left { left: 30px; }
  .arrow.right { right: 30px; }

  /* Weather Section Styles */
  .weather-section {
    background: #f8f9fa;
    padding: 50px 0;
  }

  .weather-header {
    margin-bottom: 30px;
  }

  .weather-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1a472a;
    margin-bottom: 8px;
  }

  .weather-header p {
    font-size: 0.95rem;
    color: #6c757d;
  }

  .city-selector-wrapper {
    margin-bottom: 30px;
  }

  .city-selector {
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .city-selector select {
    flex: 1;
    max-width: 300px;
    padding: 10px 16px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 0.95rem;
    background: white;
    transition: all 0.3s;
  }

  .city-selector select:focus {
    outline: none;
    border-color: #1a472a;
    box-shadow: 0 0 0 3px rgba(26,71,42,0.1);
  }

  .btn-reset {
    padding: 10px 20px;
    background: #1a472a;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s;
  }

  .btn-reset:hover {
    background: #0f5132;
    transform: translateY(-1px);
  }

  .weather-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
  }

  .weather-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
  }

  .weather-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: #1a472a;
  }

  .weather-city {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a472a;
    margin-bottom: 12px;
    border-bottom: 2px solid #fbbf24;
    padding-bottom: 8px;
  }

  .weather-main {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }

  .weather-icon-wrapper img {
    width: 70px;
    height: 70px;
  }

  .weather-temp {
    font-size: 2.2rem;
    font-weight: 700;
    color: #212529;
  }

  .weather-description {
    color: #6c757d;
    font-size: 0.85rem;
    margin-bottom: 16px;
    text-transform: capitalize;
  }

  .weather-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 16px;
  }

  .weather-detail-item {
    font-size: 0.8rem;
    color: #495057;
    padding: 6px 0;
  }

  .weather-detail-item strong {
    color: #212529;
    font-weight: 600;
  }

  .fishing-status {
    text-align: center;
    padding-top: 12px;
    border-top: 1px solid #e9ecef;
  }

  .status-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.8rem;
  }

  .status-excellent {
    background: #d1f4dd;
    color: #0f5132;
  }

  .status-good {
    background: #fff3cd;
    color: #856404;
  }

  .status-poor {
    background: #f8d7da;
    color: #721c24;
  }

  .loading-spinner {
    text-align: center;
    padding: 40px;
    color: #6c757d;
  }

  .spinner {
    border: 3px solid #f3f3f3;
    border-top: 3px solid #1a472a;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6c757d;
  }

  .empty-state h3 {
    color: #495057;
    margin-top: 16px;
  }

  @media (max-width: 768px) {
    .hero-content h1 { font-size: 2.2rem; }
    .hero-content p { font-size: 1rem; }
    .weather-header h2 { font-size: 1.8rem; }
    .weather-grid { grid-template-columns: 1fr; }
    .city-selector { flex-direction: column; }
    .btn-reset { width: 100%; }
  }
</style>

<div class="hero-slider">
  <!-- Slide 1 -->
  <div class="slide active" style="background-image:url('{{ asset('image/home/slide1.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="tag">FISHING TRIP</div>
      <h1>Khám phá thế giới câu cá</h1>
      <p>Trang thiết bị chính hãng – đồng hành cùng đam mê sông nước.</p>
      <a href="/market" class="btn-shop">Mua ngay</a>
      <a href="/about" class="btn-more">Tìm hiểu thêm</a>
    </div>
  </div>

  <!-- Slide 2 -->
  <div class="slide" style="background-image:url('{{ asset('image/home/slide2.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="tag">PRO GEAR</div>
      <h1>Thiết bị câu hàng đầu</h1>
      <p>Chất lượng cao – giá cạnh tranh, nâng cao trải nghiệm của bạn.</p>
      <a href="/market" class="btn-shop">Mua ngay</a>
      <a href="/about" class="btn-more">Tìm hiểu thêm</a>
    </div>
  </div>

  <!-- Slide 3 -->
  <div class="slide" style="background-image:url('{{ asset('image/home/slide3.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="tag">FISHSHOP VIETNAM</div>
      <h1>Bắt đầu hành trình</h1>
      <p>Với những chuyên gia, cho những người yêu thích câu cá.</p>
      <a href="/market" class="btn-shop">Khám phá</a>
      <a href="/contact" class="btn-more">Liên hệ</a>
    </div>
  </div>

  <!-- Arrows -->
  <div class="arrow left" onclick="prevSlide()">‹</div>
  <div class="arrow right" onclick="nextSlide()">›</div>

  <!-- Navigation Dots -->
  <div class="slider-nav">
    <div class="nav-dot active" data-index="0"></div>
    <div class="nav-dot" data-index="1"></div>
    <div class="nav-dot" data-index="2"></div>
  </div>
</div>

<!-- Weather Section -->
<div class="weather-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center weather-header">
      <div>
        <h2>Thời Tiết Đi Câu</h2>
        <p>Kiểm tra điều kiện thời tiết cho chuyến câu của bạn</p>
      </div>
      <div class="city-selector">
        <select id="citySelect" class="form-select">
          <option value="">Tất cả thành phố</option>
          @foreach($availableCities as $key => $name)
            <option value="{{ $key }}" {{ $selectedCity == $key ? 'selected' : '' }}>
              {{ $name }}
            </option>
          @endforeach
        </select>
        @if($selectedCity)
          <button class="btn-reset" id="resetBtn">Đặt lại</button>
        @endif
      </div>
    </div>

    <div id="weatherContent">
      @if(isset($weatherData) && count($weatherData) > 0)
        <div class="weather-grid">
          @foreach($weatherData as $weather)
            <div class="weather-card">
              <div class="weather-city">{{ $weather['name'] }}</div>
              
              <div class="weather-main">
                <div class="weather-temp">{{ round($weather['main']['temp']) }}°C</div>
                <div class="weather-icon-wrapper">
                  <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" 
                       alt="Weather">
                </div>
              </div>
              
              <div class="weather-description">{{ ucfirst($weather['weather'][0]['description']) }}</div>
              
              <div class="weather-details">
                <div class="weather-detail-item">
                  Gió: <strong>{{ $weather['wind']['speed'] }} m/s</strong>
                </div>
                <div class="weather-detail-item">
                  Độ ẩm: <strong>{{ $weather['main']['humidity'] }}%</strong>
                </div>
                <div class="weather-detail-item">
                  Tầm nhìn: <strong>{{ round($weather['visibility']/1000, 1) }} km</strong>
                </div>
                <div class="weather-detail-item">
                  Mây: <strong>{{ $weather['clouds']['all'] }}%</strong>
                </div>
              </div>
              
              <div class="fishing-status">
                @if($weather['wind']['speed'] < 5)
                  <span class="status-badge status-excellent">Lý tưởng để câu</span>
                @elseif($weather['wind']['speed'] < 10)
                  <span class="status-badge status-good">Điều kiện tốt</span>
                @else
                  <span class="status-badge status-poor">Gió mạnh</span>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="empty-state">
          <h3>Không tìm thấy dữ liệu</h3>
          <p>Không có thông tin thời tiết cho khu vực này</p>
        </div>
      @endif
    </div>
  </div>
</div>

<script>
  // Hero Slider
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.nav-dot');
  let current = 0;
  let timer;

  function showSlide(index) {
    slides.forEach((s, i) => s.classList.toggle('active', i === index));
    dots.forEach((d, i) => d.classList.toggle('active', i === index));
    current = index;
    resetTimer();
  }

  function nextSlide() {
    showSlide((current + 1) % slides.length);
  }

  function prevSlide() {
    showSlide((current - 1 + slides.length) % slides.length);
  }

  function resetTimer() {
    clearInterval(timer);
    timer = setInterval(nextSlide, 5000);
  }

  dots.forEach(dot => {
    dot.addEventListener('click', () => showSlide(Number(dot.dataset.index)));
  });

  resetTimer();

  // Weather AJAX
  const citySelect = document.getElementById('citySelect');
  const resetBtn = document.getElementById('resetBtn');
  const weatherContent = document.getElementById('weatherContent');

  function showLoading() {
    weatherContent.innerHTML = `
      <div class="loading-spinner">
        <div class="spinner"></div>
        <p style="margin-top: 20px;">Đang tải dữ liệu thời tiết...</p>
      </div>
    `;
  }

  function loadWeatherData(city = '') {
    showLoading();

    // Sử dụng Fetch API để gọi AJAX
    fetch(`{{ route('homepage') }}?city=${city}`, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.html) {
        weatherContent.innerHTML = data.html;
      } else if (data.weatherData) {
        renderWeatherCards(data.weatherData);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      weatherContent.innerHTML = `
        <div class="empty-state">
          <h3>Có lỗi xảy ra</h3>
          <p>Không thể tải dữ liệu thời tiết. Vui lòng thử lại.</p>
        </div>
      `;
    });
  }

  function renderWeatherCards(weatherData) {
    if (!weatherData || weatherData.length === 0) {
      weatherContent.innerHTML = `
        <div class="empty-state">
          <h3>Không tìm thấy dữ liệu</h3>
          <p>Không có thông tin thời tiết cho khu vực này</p>
        </div>
      `;
      return;
    }

    let html = '<div class="weather-grid">';
    weatherData.forEach(weather => {
      const windSpeed = weather.wind.speed;
      let statusClass, statusText;
      
      if (windSpeed < 5) {
        statusClass = 'status-excellent';
        statusText = 'Lý tưởng để câu';
      } else if (windSpeed < 10) {
        statusClass = 'status-good';
        statusText = 'Điều kiện tốt';
      } else {
        statusClass = 'status-poor';
        statusText = 'Gió mạnh';
      }

      html += `
        <div class="weather-card">
          <div class="weather-city">${weather.name}</div>
          <div class="weather-main">
            <div class="weather-temp">${Math.round(weather.main.temp)}°C</div>
            <div class="weather-icon-wrapper">
              <img src="http://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png" alt="Weather">
            </div>
          </div>
          <div class="weather-description">${weather.weather[0].description}</div>
          <div class="weather-details">
            <div class="weather-detail-item">Gió: <strong>${weather.wind.speed} m/s</strong></div>
            <div class="weather-detail-item">Độ ẩm: <strong>${weather.main.humidity}%</strong></div>
            <div class="weather-detail-item">Tầm nhìn: <strong>${(weather.visibility/1000).toFixed(1)} km</strong></div>
            <div class="weather-detail-item">Mây: <strong>${weather.clouds.all}%</strong></div>
          </div>
          <div class="fishing-status">
            <span class="status-badge ${statusClass}">${statusText}</span>
          </div>
        </div>
      `;
    });
    html += '</div>';
    weatherContent.innerHTML = html;
  }

  citySelect.addEventListener('change', function() {
    loadWeatherData(this.value);
  });

  resetBtn.addEventListener('click', function() {
    citySelect.value = '';
    loadWeatherData('');
  });
</script>
@endsection