@extends('layouts.app')
@section('title', 'Khuyến mãi - FishShop')
@section('content')
<x-breadcrumb />

<style>
  .promotions-page {
    background: linear-gradient(135deg, #f9fdfb 0%, #f0f9f5 100%);
    min-height: 100vh;
    padding: 60px 0;
  }

  .promotions-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .promotions-header {
    text-align: center;
    margin-bottom: 48px;
  }

  .promotions-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a472a;
    margin-bottom: 16px;
    position: relative;
    display: inline-block;
  }

  .promotions-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
    border-radius: 2px;
  }

  .promotions-subtitle {
    font-size: 1.1rem;
    color: #6b7280;
    max-width: 600px;
    margin: 24px auto 0;
    line-height: 1.6;
  }

  .promotions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 28px;
    margin-bottom: 48px;
  }

  .promo-card {
    background: white;
    border-radius: 20px;
    padding: 32px;
    border: 2px solid #e8f5f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .promo-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transition: all 0.3s ease;
  }

  .promo-card:hover {
    border-color: #FFD700;
    box-shadow: 0 12px 40px rgba(26, 71, 42, 0.15);
    transform: translateY(-8px);
  }

  .promo-card:hover::before {
    top: -30%;
    right: -30%;
  }

  .promo-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #1a472a;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
  }

  .promo-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(26, 71, 42, 0.2);
  }

  .promo-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a472a;
    margin-bottom: 12px;
    line-height: 1.3;
  }

  .promo-description {
    font-size: 15px;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
  }

  .promo-discount {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    border-radius: 12px;
    margin-bottom: 20px;
    border: 1px solid #d0e8dc;
  }

  .promo-discount-label {
    font-size: 14px;
    color: #6b7280;
    font-weight: 500;
  }

  .promo-discount-value {
    font-size: 24px;
    font-weight: 700;
    color: #1a472a;
  }

  .promo-dates {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 16px;
    background: #f9fafb;
    border-radius: 12px;
    margin-bottom: 24px;
    border-left: 3px solid #FFD700;
  }

  .promo-date-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #374151;
  }

  .promo-date-icon {
    color: #FFD700;
    font-size: 16px;
  }

  .promo-apply-btn {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
  }

  .promo-apply-btn:hover {
    background: linear-gradient(135deg, #0f2818 0%, #1a472a 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 71, 42, 0.3);
    color: white;
  }

  .empty-state {
    text-align: center;
    padding: 80px 40px;
    background: white;
    border-radius: 20px;
    border: 2px dashed #d0e8dc;
  }

  .empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f5f0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
  }

  .empty-text {
    font-size: 20px;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 12px;
  }

  .empty-subtext {
    font-size: 15px;
    color: #9ca3af;
    margin-bottom: 28px;
  }

  .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: white;
    color: #1a472a;
    border: 2px solid #1a472a;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
  }

  .back-btn:hover {
    background: #1a472a;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(26, 71, 42, 0.2);
  }

  .promotions-footer {
    text-align: center;
    margin-top: 48px;
  }

  @media (max-width: 768px) {
    .promotions-page {
      padding: 40px 0;
    }

    .promotions-container {
      padding: 0 16px;
    }

    .promotions-title {
      font-size: 1.8rem;
    }

    .promotions-subtitle {
      font-size: 1rem;
    }

    .promotions-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .promo-card {
      padding: 24px;
    }

    .promo-name {
      font-size: 1.2rem;
    }

    .empty-state {
      padding: 60px 24px;
    }

    .empty-icon {
      width: 80px;
      height: 80px;
      font-size: 40px;
    }
  }
</style>

<div class="promotions-page">
  <div class="promotions-container">
    <!-- Header -->
    <div class="promotions-header">
      <h1 class="promotions-title">Ưu đãi đặc biệt</h1>
      <p class="promotions-subtitle">
        Khám phá các chương trình khuyến mãi hấp dẫn và tiết kiệm chi phí cho đơn hàng của bạn
      </p>
    </div>

    <!-- Promotions Grid -->
    <div class="promotions-grid">
      @forelse($promotions as $promo)
        <div class="promo-card">
          <div class="promo-badge">Hot</div>
          
          <div class="promo-icon">🎁</div>
          
          <h3 class="promo-name">{{ $promo->name }}</h3>
          
          <p class="promo-description">{{ $promo->description }}</p>
          
          <div class="promo-discount">
            <span class="promo-discount-label">Giảm giá:</span>
            <span class="promo-discount-value">{{ $promo->percent }}%</span>
          </div>
          
          @if($promo->start_date || $promo->end_date)
            <div class="promo-dates">
              @if($promo->start_date)
                <div class="promo-date-item">
                  <span class="promo-date-icon">📅</span>
                  <span>Bắt đầu: {{ $promo->start_date->format('d/m/Y') }}</span>
                </div>
              @endif
              @if($promo->end_date)
                <div class="promo-date-item">
                  <span class="promo-date-icon">⏰</span>
                  <span>Kết thúc: {{ $promo->end_date->format('d/m/Y') }}</span>
                </div>
              @endif
            </div>
          @endif
          
          <a href="{{ route('checkout.index', ['promotion_id' => $promo->id]) }}" 
             class="promo-apply-btn">
            Áp dụng ngay
          </a>
        </div>
      @empty
        <div class="empty-state" style="grid-column: 1/-1;">
          <div class="empty-icon">🎉</div>
          <div class="empty-text">Chưa có chương trình khuyến mãi</div>
          <div class="empty-subtext">Hãy quay lại sau để không bỏ lỡ các ưu đãi hấp dẫn</div>
          <a href="{{ url('/') }}" class="back-btn">
            ← Về trang chủ
          </a>
        </div>
      @endforelse
    </div>

    <!-- Footer -->
    @if(count($promotions) > 0)
      <div class="promotions-footer">
        <a href="{{ url('/') }}" class="back-btn">
          ← Quay lại trang chủ
        </a>
      </div>
    @endif
  </div>
</div>

@endsection