@extends('layouts.app')

@section('title', $product->name)

@section('content')
<style>
  body {
    background-color: #f8faf8;
    font-family: 'Poppins', sans-serif;
  }

  .product-detail {
    max-width: 1100px;
    margin: 60px auto;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    display: flex;
    gap: 40px;
    padding: 40px;
  }

  .product-image {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .product-image img {
    width: 100%;
    max-width: 450px;
    border-radius: 12px;
    object-fit: cover;
  }

  .product-info {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .product-name {
    font-size: 1.8rem;
    font-weight: 700;
    color: #0f5132;
    margin-bottom: 16px;
  }

  .product-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f5132;
    margin-bottom: 20px;
  }

  .product-desc {
    color: #555;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 30px;
  }

  .btn-add-cart {
    background-color: #fbbf24;
    color: #0f5132;
    border: none;
    padding: 12px 18px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    width: 200px;
    transition: 0.3s;
  }

  .btn-add-cart:hover {
    background-color: #ffe176;
    transform: scale(1.05);
  }

  .back-link {
    margin-top: 30px;
    display: inline-block;
    color: #0f5132;
    font-weight: 600;
    text-decoration: none;
  }

  .back-link:hover {
    text-decoration: underline;
  }
</style>

<div class="product-detail">
  <div class="product-image">
    <img src="{{ $product->image }}" alt="{{ $product->name }}">
  </div>
  <div class="product-info">
    <h1 class="product-name">{{ $product->name }}</h1>
    <div class="product-price">₫ {{ number_format($product->price, 0, ',', '.') }}</div>
    <p class="product-desc">{{ $product->description }}</p>

    <button class="btn-add-cart">Thêm vào giỏ</button>

    <a href="{{ route('market.index') }}" class="back-link">← Quay lại Market</a>
  </div>
</div>
@endsection
