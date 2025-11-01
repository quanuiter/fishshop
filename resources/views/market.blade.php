@extends('layouts.app')

@section('title', 'FishShop Market')

@section('content')
<style>
  body { 
    background-color: #f8faf8; 
    color: #333; 
    font-family: 'Poppins', sans-serif;
  }

  /* Banner */
  .market-banner {
    position: relative;
    background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80') center/cover;
    height: 45vh;
    display: flex;
    align-items: flex-end;
    justify-content: start;
    color: white;
  }
  .market-banner::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15,107,61,0.8), rgba(15,107,61,0.3));
  }
  .market-banner h1 {
    position: relative;
    z-index: 2;
    font-size: 2.8rem;
    font-weight: 700;
    margin: 0 0 30px 60px;
  }

  /* Category Bar */
  .category-bar {
    background-color: #fff;
    display: flex;
    justify-content: center;
    gap: 50px;
    padding: 30px 0;
    flex-wrap: wrap;
    border-bottom: 2px solid #e5e7eb;
  }
  .category-item {
    text-align: center;
    color: #0f5132;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  .category-item img {
    width: 55px;
    height: 55px;
    margin-bottom: 8px;
    transition: transform 0.3s ease;
  }
  .category-item:hover img {
    transform: scale(1.1);
  }
  .category-item:hover {
    color: #fbbf24;
  }

  /* Filter Bar */
  .filter-bar {
    background-color: #0f6b3d;
    padding: 15px 40px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
  }
  .filter-select {
    background-color: #fff;
    color: #0f5132;
    border: 1px solid #ccc;
    padding: 8px 14px;
    border-radius: 6px;
    outline: none;
    font-weight: 500;
  }
  .filter-select:hover {
    border-color: #fbbf24;
  }
  .search-box {
    margin-left: auto;
    display: flex;
    align-items: center;
  }
  .search-box input {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 8px 15px;
    border-radius: 6px 0 0 6px;
    width: 250px;
  }
  .search-box button {
    background-color: #fbbf24;
    border: none;
    padding: 8px 18px;
    border-radius: 0 6px 6px 0;
    font-weight: 600;
    color: #0f5132;
    transition: 0.3s;
  }
  .search-box button:hover {
    background-color: #ffe176;
  }
</style>

<!-- Banner -->
<div class="market-banner">
  <h1>FishShop Market</h1>
</div>

<!-- Category bar -->
<div class="category-bar">
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/415/415734.png" alt="Cần câu"><br>
    Cần câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/3050/3050182.png" alt="Máy câu"><br>
    Máy câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="Lưỡi câu"><br>
    Lưỡi câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/1069/1069110.png" alt="Mồi câu"><br>
    Mồi câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/1465/1465541.png" alt="Phụ kiện"><br>
    Phụ kiện
  </div>
</div>

<!-- Filter bar -->
<div class="filter-bar">
  <select class="filter-select">
    <option>Chất lượng</option>
    <option>Cao cấp</option>
    <option>Trung bình</option>
  </select>

  <select class="filter-select">
    <option>Loại sản phẩm</option>
    <option>Cần câu</option>
    <option>Máy câu</option>
    <option>Lưỡi câu</option>
  </select>

  <select class="filter-select">
    <option>Phổ biến</option>
    <option>Bán chạy</option>
    <option>Mới nhất</option>
  </select>

  <select class="filter-select">
    <option>Màu sắc</option>
    <option>Đen</option>
    <option>Xanh</option>
    <option>Bạc</option>
  </select>

  <div class="search-box">
    <input type="text" placeholder="Nhập tên sản phẩm...">
    <button>Tìm kiếm</button>
  </div>
</div>
@endsection
