@extends('layouts.app')

@section('title', 'FishShop Market')

@section('content')
<style>
  body { background-color: #11131a; color: white; font-family: 'Poppins', sans-serif; }
  .market-banner {
    background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80') center/cover;
    height: 40vh;
    position: relative;
  }
  .market-banner::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
  }
  .market-banner h1 {
    position: absolute;
    bottom: 20px;
    left: 50px;
    font-size: 2.5rem;
    z-index: 2;
  }
  .category-bar {
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    gap: 40px;
    padding: 20px 0;
  }
  .category-item {
    text-align: center;
    color: #ccc;
    cursor: pointer;
    transition: 0.3s;
  }
  .category-item:hover {
    color: #7055ff;
  }
  .category-item img {
    width: 40px;
    height: 40px;
    filter: brightness(0.8);
  }
  .filter-bar {
    background-color: #1a1a1d;
    padding: 15px 40px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
  }
  .filter-select {
    background-color: #222;
    color: #ccc;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    outline: none;
  }
  .search-box {
    margin-left: auto;
    display: flex;
    align-items: center;
  }
  .search-box input {
    background-color: #222;
    border: none;
    color: white;
    padding: 8px 15px;
    border-radius: 6px 0 0 6px;
    width: 250px;
  }
  .search-box button {
    background-color: #7055ff;
    border: none;
    padding: 8px 15px;
    border-radius: 0 6px 6px 0;
    color: white;
  }
</style>

<!-- Banner -->
<div class="market-banner">
  <h1>FishShop Market</h1>
</div>

<!-- Category bar -->
<div class="category-bar">
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/415/415734.png" alt="Can cau"><br>
    Cần câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/3050/3050182.png" alt="May cau"><br>
    Máy câu
  </div>
  <div class="category-item">
    <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="Luoi cau"><br>
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
