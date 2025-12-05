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
  <div id="chatbot-toggle-btn" onclick="toggleChatbot()">
    <i class="bi bi-chat-dots-fill"></i>
</div>

<div id="chatbot-container" class="card shadow-lg">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <span><i class="bi bi-robot"></i> Trợ lý câu cá</span>
        <button type="button" class="btn-close btn-close-white" onclick="toggleChatbot()"></button>
    </div>
    
    <div class="card-body p-2" id="chat-box">
        <div class="bot-message mb-2">
            <strong>Bot:</strong> Xin chào! Tôi là chuyên gia câu cá. Bạn cần tư vấn về cần, máy hay mồi câu nào?
        </div>
    </div>
    
    <div class="card-footer p-2">
        <div class="input-group">
            <input type="text" id="user-input" class="form-control" placeholder="Nhập câu hỏi..." onkeypress="handleEnter(event)">
            <button class="btn btn-success" onclick="sendMessage()"><i class="bi bi-send"></i></button>
        </div>
    </div>
</div>

<style>
    /* Nút tròn nổi ở góc màn hình */
    #chatbot-toggle-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background-color: #198754; /* Màu xanh lá hợp chủ đề câu cá */
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 60px;
        font-size: 30px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        z-index: 9999;
        transition: transform 0.3s;
    }
    #chatbot-toggle-btn:hover {
        transform: scale(1.1);
    }

    /* Khung chat */
    #chatbot-container {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 350px;
        height: 450px;
        z-index: 9999;
        display: none; /* Ẩn mặc định */
        flex-direction: column;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Vùng hiển thị tin nhắn */
    #chat-box {
        flex: 1;
        overflow-y: auto;
        background-color: #f8f9fa;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Bong bóng tin nhắn */
    .user-message {
        align-self: flex-end;
        background-color: #e9ecef;
        padding: 8px 12px;
        border-radius: 15px 15px 0 15px;
        max-width: 80%;
    }
    .bot-message {
        align-self: flex-start;
        background-color: #d1e7dd;
        padding: 8px 12px;
        border-radius: 15px 15px 15px 0;
        max-width: 80%;
    }
</style>

<script>
    // Hàm bật/tắt khung chat
    function toggleChatbot() {
        const container = document.getElementById('chatbot-container');
        const btn = document.getElementById('chatbot-toggle-btn');
        
        if (container.style.display === 'none' || container.style.display === '') {
            container.style.display = 'flex';
            btn.style.display = 'none'; // Ẩn nút tròn khi mở chat
        } else {
            container.style.display = 'none';
            btn.style.display = 'block'; // Hiện lại nút tròn
        }
    }

    // Xử lý khi nhấn Enter
    function handleEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }

    async function sendMessage() {
        const input = document.getElementById('user-input');
        const message = input.value;
        const chatBox = document.getElementById('chat-box');

        if(!message.trim()) return;

        // 1. Hiện tin nhắn người dùng
        const userDiv = document.createElement('div');
        userDiv.className = 'user-message';
        userDiv.innerHTML = `<strong>Bạn:</strong> ${message}`;
        chatBox.appendChild(userDiv);
        
        input.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        // 2. Hiệu ứng "Đang gõ..." (Tuỳ chọn thêm cho sinh động)
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'bot-message text-muted';
        loadingDiv.id = 'loading-msg';
        loadingDiv.innerHTML = '<small><em>Đang suy nghĩ...</em></small>';
        chatBox.appendChild(loadingDiv);

        // 3. Gửi request lên Laravel
        try {
            const response = await fetch('{{ route('chatbot.send') }}', { // Dùng route() của Blade cho chuẩn
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            // Xóa hiệu ứng đang gõ
            document.getElementById('loading-msg').remove();

            // Hiện tin nhắn Bot
            const botDiv = document.createElement('div');
            botDiv.className = 'bot-message';
            botDiv.innerHTML = `<strong>Bot:</strong> ${data.reply}`;
            chatBox.appendChild(botDiv);
            
            chatBox.scrollTop = chatBox.scrollHeight;
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('loading-msg').innerHTML = 'Lỗi kết nối!';
        }
    }
</script>
</body>
</html>
