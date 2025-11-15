@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<style>
  .success-page {
    max-width: 700px;
    margin: 80px auto;
    text-align: center;
    color: #1a472a;
    font-family: 'Poppins', sans-serif;
  }

  .success-icon {
    font-size: 80px;
    color: #27ae60;
    margin-bottom: 24px;
  }

  .success-page h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .success-page p {
    color: #444;
    font-size: 16px;
    margin-bottom: 24px;
  }

  .success-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
  }

  .btn-success {
    background-color: #1a472a;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn-success:hover {
    background-color: #2d5f3f;
  }

  .btn-outline {
    background: none;
    color: #1a472a;
    border: 2px solid #1a472a;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn-outline:hover {
    background-color: #1a472a;
    color: white;
  }
</style>

<div class="success-page">
  <div class="success-icon">✅</div>
  <h1>Đặt hàng thành công!</h1>
  <p>Cảm ơn bạn đã mua sắm tại <strong>FishShop</strong>. Đơn hàng của bạn đang được xử lý và sẽ sớm được giao đến.</p>
  
  <div class="success-actions">
    <a href="{{ url('/market') }}" class="btn-success">Tiếp tục mua sắm</a>
    <a href="{{ url('/orders') }}" class="btn-outline">Xem đơn hàng</a>
  </div>
</div>
@endsection
