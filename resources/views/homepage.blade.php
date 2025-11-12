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

  @media (max-width: 768px) {
    .hero-content h1 { font-size: 2.2rem; }
    .hero-content p { font-size: 1rem; }
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

<script>
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
</script>
@endsection
