<style>
  .fishshop-footer {
    background: linear-gradient(135deg, #1a472a 0%, #2d6a47 100%);
    color: white;
    font-family: 'Poppins', sans-serif;
    margin-top: 80px;
    position: relative;
    overflow: hidden;
  }

  .fishshop-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
  }

  .fishshop-footer::after {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    border-radius: 50%;
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 24px 0;
    position: relative;
    z-index: 1;
  }

  .footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 48px;
    margin-bottom: 48px;
  }

  .footer-section {
    animation: fadeInUp 0.6s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .footer-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 12px;
    display: inline-block;
  }

  .footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #FFD700 0%, transparent 100%);
    border-radius: 2px;
  }

  .footer-description {
    font-size: 14px;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.85);
    margin-top: 16px;
  }

  .footer-list {
    list-style: none;
    padding: 0;
    margin: 16px 0 0 0;
  }

  .footer-list li {
    margin-bottom: 12px;
  }

  .footer-link {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 20px;
  }

  .footer-link::before {
    content: '→';
    position: absolute;
    left: 0;
    opacity: 0;
    transition: all 0.3s ease;
  }

  .footer-link:hover {
    color: #FFD700;
    padding-left: 24px;
  }

  .footer-link:hover::before {
    opacity: 1;
    left: 0;
  }

  .footer-contact {
    list-style: none;
    padding: 0;
    margin: 16px 0 0 0;
  }

  .footer-contact li {
    margin-bottom: 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 14px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.85);
  }

  .footer-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 215, 0, 0.15);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFD700;
    font-size: 18px;
    flex-shrink: 0;
    transition: all 0.3s ease;
  }

  .footer-contact li:hover .footer-icon {
    background: rgba(255, 215, 0, 0.25);
    transform: scale(1.1);
  }

  .social-links {
    display: flex;
    gap: 12px;
    margin-top: 16px;
  }

  .social-link {
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .social-link:hover {
    background: #FFD700;
    color: #1a472a;
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    padding: 32px 24px;
    text-align: center;
  }

  .footer-copyright {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
  }

  .footer-copyright strong {
    color: #FFD700;
    font-weight: 600;
  }

  @media (max-width: 768px) {
    .footer-container {
      padding: 40px 20px 0;
    }

    .footer-grid {
      grid-template-columns: 1fr;
      gap: 36px;
      margin-bottom: 36px;
    }

    .footer-section {
      text-align: left;
    }

    .social-links {
      justify-content: flex-start;
    }

    .footer-bottom {
      padding: 24px 20px;
    }
  }
</style>

<footer class="fishshop-footer">
  <div class="footer-container">
    <div class="footer-grid">
      
      <!-- Về FishShop -->
      <div class="footer-section">
        <h6 class="footer-title">Về FishShop</h6>
        <p class="footer-description">
          Chuyên cung cấp cần câu, mồi và phụ kiện câu cá chính hãng. 
          Cam kết uy tín – chất lượng – giá tốt nhất thị trường.
        </p>
      </div>

      <!-- Chính sách & Hỗ trợ -->
      <div class="footer-section">
        <h6 class="footer-title">Chính sách & Hỗ trợ</h6>
        <ul class="footer-list">
          <li><a href="#" class="footer-link">Chính sách đổi trả</a></li>
          <li><a href="#" class="footer-link">Giao hàng & Thanh toán</a></li>
          <li><a href="#" class="footer-link">Bảo mật thông tin</a></li>
          <li><a href="#" class="footer-link">Điều khoản sử dụng</a></li>
        </ul>
      </div>

      <!-- Liên hệ -->
      <div class="footer-section">
        <h6 class="footer-title">Liên hệ</h6>
        <ul class="footer-contact">
          <li>
            <div class="footer-icon">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <span>12 Nguyễn Văn Bảo<br>Gò Vấp, TP.HCM</span>
          </li>
          <li>
            <div class="footer-icon">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <span>0123 456 789</span>
          </li>
          <li>
            <div class="footer-icon">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <span>support@fishshop.vn</span>
          </li>
        </ul>
      </div>

      <!-- Mạng xã hội -->
      <div class="footer-section">
        <h6 class="footer-title">Theo dõi chúng tôi</h6>
        <p class="footer-description" style="margin-top: 16px; margin-bottom: 8px;">
          Kết nối với chúng tôi để cập nhật tin tức và ưu đãi mới nhất
        </p>
        <div class="social-links">
          <a href="#" class="social-link" title="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class="social-link" title="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="#" class="social-link" title="YouTube">
            <i class="bi bi-youtube"></i>
          </a>
          <a href="#" class="social-link" title="TikTok">
            <i class="bi bi-tiktok"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <p class="footer-copyright">
      © 2025 <strong>FishShop</strong> | Thiết kế & phát triển bởi Nhóm UIT
    </p>
  </div>
</footer>