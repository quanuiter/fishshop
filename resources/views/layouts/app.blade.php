<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'FishShop')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f5f7f6;
      color: white;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding-top: 70px; /* tránh che mất nội dung do navbar fixed-top */
    }
  </style>
</head>
<body>

  @include('layouts.header')

  <main style="background: transparent;">
    @yield('content')
  </main>

  @include('layouts.footer')

</body>
</html>
