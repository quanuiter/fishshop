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
  .hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
  }
  .hero-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    z-index: 2;
    color: #fff;
    max-width: 500px;
  }
  .hero-content h1 {
    font-size: 3.2rem;
    font-weight: 700;
    line-height: 1.2;
  }
  .hero-content p {
    font-size: 1.1rem;
    color: #e5e7eb;
    margin-top: 10px;
  }
  .hero-content .btn-shop {
    background-color: #fbbf24;
    color: #0f5132;
    border: none;
    padding: 10px 28px;
    font-weight: 600;
    border-radius: 30px;
    transition: all 0.3s ease;
  }
  .hero-content .btn-shop:hover {
    background-color: #ffe176;
    transform: translateY(-2px);
  }
  .slider-nav {
    position: absolute;
    bottom: 30px;
    left: 10%;
    display: flex;
    gap: 8px;
    z-index: 2;
  }
  .nav-dot {
    width: 35px;
    height: 4px;
    background: rgba(255,255,255,0.4);
    border-radius: 2px;
    cursor: pointer;
    transition: background 0.3s;
  }
  .nav-dot.active {
    background: #fbbf24;
  }
</style>

<div class="hero-slider">
  <!-- Slide images -->
  <div class="slide active" style="background-image:url('https://images.unsplash.com/photo-1503919545889-aef636e10ad4?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80');"></div>

  <!-- Overlay -->
  <div class="hero-overlay"></div>

  <!-- Content -->
  <div class="hero-content">
    <h1>Khám phá thế giới câu cá</h1>
    <p>Trang thiết bị chính hãng – đồng hành cùng đam mê sông nước.</p>
    <a href="/market" class="btn btn-shop mt-3">Mua ngay</a>
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
    timer = setInterval(nextSlide, 5000);
  }

  dots.forEach(dot => {
    dot.addEventListener('mouseenter', () => showSlide(Number(dot.dataset.index)));
  });

  resetTimer();
</script>
@endsection
