@extends('layouts.app')

@section('title', 'Trang chủ - FishShop')

@section('content')
<style>
  .hero-slider {
    position: relative;
    height: 90vh;
    overflow: hidden;
  }
  .slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1s ease;
  }
  .slide.active {
    opacity: 1;
  }
  .hero-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    z-index: 2;
    color: #fff;
  }
  .hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
  }
  .hero-content p {
    font-size: 1.2rem;
    color: #ccc;
  }
  .slider-nav {
    position: absolute;
    bottom: 30px;
    left: 10%;
    display: flex;
    gap: 10px;
  }
  .nav-dot {
    width: 40px;
    height: 4px;
    background: #666;
    border-radius: 2px;
    cursor: pointer;
    transition: background 0.3s;
  }
  .nav-dot.active {
    background: #7055ff;
  }
</style>

<div class="hero-slider">
  <!-- Các slide -->
  <div class="slide active" style="background-image:url('https://images.unsplash.com/photo-1503919545889-aef636e10ad4?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80');"></div>

  <!-- Nội dung -->
  <div class="hero-content">
    <h1>Khám phá thế giới câu cá</h1>
    <p>Trang thiết bị cao cấp cho người yêu sông nước</p>
    <a href="/market" class="btn btn-primary mt-3">Mua ngay</a>
  </div>

  <!-- Navigation -->
  <div class="slider-nav">
    <div class="nav-dot active" data-index="0"></div>
    <div class="nav-dot" data-index="1"></div>
    <div class="nav-dot" data-index="2"></div>
    <div class="nav-dot" data-index="3"></div>
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

  function resetTimer() {
    clearInterval(timer);
    timer = setInterval(nextSlide, 5000); // đổi slide sau 5 giây
  }

  dots.forEach(dot => {
    dot.addEventListener('mouseenter', () => showSlide(Number(dot.dataset.index)));
  });

  resetTimer();
</script>
@endsection
