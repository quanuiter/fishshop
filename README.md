[![FishShop Logo](https://i.imgur.com/WmMnSRt.png)](https://www.uit.edu.vn/ "Trường Đại học Công nghệ Thông tin")

# **Phát triển ứng dụng web**

## Hệ Thống Thương Mại Điện Tử Dành Cho Dân Câu — FishShop

[![PHP](https://img.shields.io/badge/Backend-PHP%208.1+-777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Framework-Laravel%2011-FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![Node.js](https://img.shields.io/badge/Frontend-Node.js%20%2B%20NPM-339933?style=flat-square&logo=nodedotjs)](https://nodejs.org/)
[![Vite](https://img.shields.io/badge/Build-Vite-646CFF?style=flat-square&logo=vite)](https://vitejs.dev/)
[![MySQL](https://img.shields.io/badge/Database-MySQL%2F%20MariaDB-00758F?style=flat-square&logo=mysql)](https://www.mysql.com/)
[![TailwindCSS](https://img.shields.io/badge/Style-TailwindCSS-38B2AC?style=flat-square&logo=tailwindcss)](https://tailwindcss.com/)

---

## Thông tin đồ án

| Mục | Nội dung |
| --- | --- |
| **Tên đồ án** | Hệ Thống Thương Mại Điện Tử Dành Cho Dân Câu — FishShop |
| **Môn học** | Nhập môn Công nghệ Phần mềm |
| **Trường** | Đại học Công nghệ Thông tin – ĐHQG TP.HCM |
| **Năm học** | 2025 – 2026 |

---

## Thành viên thực hiện

| Họ và tên | MSSV |
| --- | --- |
| Thành viên 1 | 235xxxxx |
| Thành viên 2 | 235xxxxx |
| Thành viên 3 | 235xxxxx |

---

## Mục tiêu đồ án

Đồ án xây dựng hệ thống **Thương mại Điện tử dành cho Dân Câu** hoàn chỉnh theo mô hình **Fullstack**, với các mục tiêu chính:

- Xây dựng **Backend** vừa vặn với **PHP 8.1+ & Laravel 11**
- Tích hợp cơ sở dữ liệu **MySQL / MariaDB** để quản lý sản phẩm, đơn hàng, người dùng
- Phát triển giao diện người dùng hiện đại với **Node.js, Vite & TailwindCSS**
- Phân quyền 2 vai trò chính: **Admin (Quản trị viên)** và **User (Khách hàng)**
- Tích hợp **Chatbot** hỗ trợ trả lời câu hỏi cơ bản
- Quản lý toàn bộ quy trình mua sắm: xem sản phẩm, giỏ hàng, thanh toán, lịch sử đơn hàng
- Chức năng **Nhật ký Câu cá (Catch Log)**: độc giả chia sẻ trải nghiệm, hình ảnh câu cá
- Bảo mật API với **JWT**, **bcrypt** và kiểm tra quyền truy cập

---

## Công nghệ sử dụng

### Backend — `backend/` (PHP + Laravel)

| Công nghệ | Phiên bản | Vai trò |
| --- | --- | --- |
| PHP | `>= 8.1` | Ngôn ngữ lập trình server |
| Laravel | `11.x` | Framework web MVC |
| Composer | `^2.0` | Package manager PHP |
| MySQL / MariaDB | — | Cơ sở dữ liệu quan hệ |
| Laravel Sanctum | — | Xác thực API (JWT-like tokens) |
| Laravel Tinker | — | REPL tương tác |

### Frontend — `frontend/` (Node.js + Vite)

| Công nghệ | Phiên bản | Vai trò |
| --- | --- | --- |
| Node.js | `>= 18.x` | JavaScript runtime |
| NPM | `>= 9.x` | Package manager JavaScript |
| Vite | `^8.0.1` | Build tool & dev server |
| TailwindCSS | `^3.4` | Utility-first CSS framework |
| JavaScript / TypeScript | — | Ngôn ngữ lập trình frontend |

---

## Phân quyền hệ thống

| Vai trò | Quyền truy cập |
| --- | --- |
| **Admin** | Quản lý sản phẩm, danh mục, đơn hàng, khuyến mãi, báo cáo doanh thu, nhân viên, tài khoản người dùng |
| **User (Khách hàng)** | Duyệt sản phẩm, thêm vào giỏ, checkout, xem lịch sử đơn hàng, đăng nhật ký câu cá, liên hệ chatbot |

---

## Chức năng chi tiết

### 📦 Quản lý Sản phẩm & Danh mục

- CRUD **Danh mục sản phẩm**: Cần câu, Máy câu, Mồi câu, Phụ kiện...
- CRUD **Sản phẩm**: Tên, giá, mô tả, ảnh, tồn kho, biến thể
- CRUD **Tác giả / Nhà cung cấp**: Liên kết với sản phẩm
- Tìm kiếm sản phẩm theo từ khoá, danh mục, giá cả

---

### 👤 Quản lý Người dùng & Xác thực

- CRUD **Tài khoản người dùng**: Đăng ký, đăng nhập, đổi mật khẩu
- CRUD **Hồ sơ cá nhân**: Tên, email, số điện thoại, địa chỉ giao hàng
- Xác thực bằng **Laravel Sanctum** (JWT tokens)
- Phân quyền dựa trên vai trò

---

### 🛒 Giỏ hàng & Thanh toán

- Thêm / xóa / cập nhật số lượng sản phẩm trong giỏ
- Tính toán tổng tiền, áp dụng khuyến mãi
- **Checkout**: Nhập thông tin giao hàng, chọn phương thức thanh toán
- Xem lịch sử đơn hàng và trạng thái giao hàng

---

### 📋 Quản lý Đơn hàng (Admin + User)

- **Admin**: Xem danh sách đơn hàng, cập nhật trạng thái (chờ xác nhận, đang giao, đã giao, hủy)
- **User**: Xem chi tiết đơn hàng của mình, theo dõi trạng thái giao hàng

---

### 💳 Quản lý Khuyến mãi & Mã giảm giá

- CRUD **Mã giảm giá**: Mã, phần trăm / số tiền giảm, ngày hiệu lực
- CRUD **Chương trình khuyến mãi**: Áp dụng cho danh mục hoặc sản phẩm cụ thể
- Admin quản lý các chương trình khuyến mãi

---

### 📸 Nhật ký Câu cá (Catch Log)

- **User**: Đăng tải hình ảnh, mô tả chuyến câu (địa điểm, kết quả, ngày tháng)
- **User**: Xem các nhật ký của người khác, tương tác (like, comment)
- Chia sẻ trải nghiệm với cộng đồng dân câu

---

### 📊 Báo cáo & Thống kê (Admin)

- **Dashboard Admin**: Tổng quan doanh thu, số lượng đơn hàng, sản phẩm bán chạy
- **Báo cáo Doanh thu**: Biểu đồ doanh thu theo thời gian (ngày, tháng, năm)
- **Báo cáo Sản phẩm**: Sản phẩm bán chạy, hàng tồn kho, sắp hết hàng
- Xuất báo cáo dạng **file Excel / PDF** *(tùy chọn)*

---

### 🤖 Chatbot Hỗ trợ

- Trả lời các câu hỏi thường gặp (vận chuyển, đổi trả, bảo hành...)
- Hỗ trợ tra cứu sản phẩm, thông tin tài khoản
- Giao diện chat widget tích hợp trong frontend

---

## Cấu trúc thư mục

```
fishshop/
├── backend/                            # Laravel Backend
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/            # Controllers (Auth, Product, Order, Admin, v.v.)
│   │   │   └── Middleware/             # Middleware (Auth, CORS, v.v.)
│   │   ├── Models/                     # Eloquent Models (User, Product, Order, CatchLog, v.v.)
│   │   ├── Services/                   # Business logic services
│   │   └── Jobs/                       # Background jobs (email, notification, v.v.)
│   ├── database/
│   │   ├── migrations/                 # Database migrations
│   │   ├── seeders/                    # Database seeders (AdminUserSeeder, ProductSeeder, v.v.)
│   │   └── factories/                  # Model factories (testing)
│   ├── routes/
│   │   └── api.php                     # API routes
│   ├── config/                         # Configuration files
│   ├── .env.example                    # Environment example
│   ├── artisan                         # Laravel CLI
│   └── composer.json
│
├── frontend/                           # Vite + Frontend
│   ├── src/
│   │   ├── pages/
│   │   │   ├── admin/                  # Admin Dashboard, Products, Orders, Promotions, Reports
│   │   │   └── user/                   # User Dashboard, Products, Cart, Checkout, CatchLog
│   │   ├── components/
│   │   │   ├── Header/
│   │   │   ├── Sidebar/
│   │   │   ├── Navigation/
│   │   │   ├── ProductCard/
│   │   │   ├── CartWidget/
│   │   │   ├── Chatbot/
│   │   │   └── ui/                     # Reusable UI components
│   │   ├── services/                   # API services (axios)
│   │   ├── store/                      # State management (if using)
│   │   ├── styles/                     # TailwindCSS, custom CSS
│   │   └── App.jsx / index.jsx         # Entry point
│   ├── public/
│   │   └── assets/                     # Static files (images, icons, v.v.)
│   ├── vite.config.js                  # Vite configuration
│   ├── tailwind.config.js              # TailwindCSS configuration
│   ├── .env.example
│   └── package.json
│
└── README.md                           # This file
```

---

## Yêu cầu hệ thống

### Backend

```
PHP >= 8.1
Composer >= 2.0
MySQL >= 5.7 hoặc MariaDB >= 10.3
```

### Frontend

```
Node.js >= 18.x
NPM >= 9.x
```

---

## Hướng dẫn cài đặt & chạy local

### 1. Clone repository

```bash
git clone https://github.com/quanuiter/fishshop.git
cd fishshop
```

### 2. Cài đặt & chạy Backend

#### Bước 2a: Cài đặt dependencies

```bash
cd backend
composer install
```

#### Bước 2b: Cấu hình môi trường

```bash
cp .env.example .env
```

Mở file `backend/.env` và chỉnh sửa:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fishshop
DB_USERNAME=root
DB_PASSWORD=

APP_KEY=
APP_URL=http://localhost:8000
APP_DEBUG=true
```

#### Bước 2c: Tạo Application Key

```bash
php artisan key:generate
```

#### Bước 2d: Chạy Migration và Seed

```bash
php artisan migrate --seed
```

Điều này sẽ:
- Tạo bảng cơ sở dữ liệu
- Tạo tài khoản Admin mặc định
- Thêm dữ liệu sản phẩm, danh mục mẫu

#### Bước 2e: Khởi chạy Backend Server

```bash
php artisan serve
```

Backend sẽ chạy tại: `http://localhost:8000`

---

### 3. Cài đặt & chạy Frontend

#### Bước 3a: Cài đặt dependencies

```bash
cd frontend
npm install
```

#### Bước 3b: Cấu hình môi trường

```bash
cp .env.example .env
```

Mở file `frontend/.env` và chỉnh sửa:

```env
VITE_API_URL=http://localhost:8000/api
VITE_APP_NAME=FishShop
```

#### Bước 3c: Khởi chạy Frontend Dev Server

```bash
npm run dev
```

Frontend sẽ chạy tại: `http://localhost:5173`

---

### 4. Truy cập ứng dụng

- **Frontend (User)**: http://localhost:5173
- **Backend API**: http://localhost:8000/api
- **Admin Panel**: http://localhost:5173/admin

---

## Thông tin tài khoản mặc định

Sau khi chạy `php artisan migrate --seed`, hệ thống tự động tạo tài khoản Admin:

```
Email: admin@fishshop.com
Mật khẩu: password123
```

*Lưu ý*: Thông tin này được cấu hình trong file `database/seeders/AdminUserSeeder.php`. Bạn nên thay đổi mật khẩu sau khi đăng nhập lần đầu.

---

## Build & Deployment

### Frontend - Build cho production

```bash
cd frontend
npm run build
```

Output được tạo trong thư mục `frontend/dist/`.

### Backend - Deployment

Với **Laravel**, bạn có thể deploy lên:
- **Shared Hosting** (cPanel, Plesk, v.v.)
- **VPS** (DigitalOcean, Linode, AWS, v.v.)
- **PaaS** (Heroku, Railway, Vercel, v.v.)
- **Docker** (containerize Laravel backend)

---

## API Endpoints tổng quan

| Nhóm | Prefix | Mô tả |
| --- | --- | --- |
| Auth | `/api/auth` | Đăng nhập, đăng xuất, refresh token |
| Sản phẩm | `/api/products` | CRUD sản phẩm, danh mục |
| Giỏ hàng | `/api/cart` | Quản lý giỏ hàng |
| Đơn hàng | `/api/orders` | CRUD đơn hàng, thanh toán |
| Người dùng | `/api/users` | Quản lý tài khoản, hồ sơ |
| Nhật ký | `/api/catch-logs` | CRUD nhật ký câu cá |
| Khuyến mãi | `/api/promotions` | CRUD mã giảm giá, chương trình |
| Báo cáo | `/api/reports` | Thống kê, báo cáo doanh thu |
| Chatbot | `/api/chatbot` | Chat hỗ trợ |

---

## Hướng dẫn sử dụng chính

### Cho Khách hàng (User)

1. **Đăng ký / Đăng nhập**: Tạo tài khoản hoặc đăng nhập bằng email/mật khẩu
2. **Duyệt sản phẩm**: Xem các sản phẩm câu cá (cần câu, máy câu, mồi, phụ kiện)
3. **Thêm vào giỏ hàng**: Chọn số lượng, thêm vào giỏ
4. **Thanh toán (Checkout)**: Nhập thông tin giao hàng, xác nhận đơn hàng
5. **Theo dõi đơn hàng**: Xem lịch sử, trạng thái giao hàng
6. **Nhật ký câu cá**: Chia sẻ hình ảnh và trải nghiệm câu cá của mình
7. **Chat với Chatbot**: Hỏi các thắc mắc về sản phẩm, vận chuyển, v.v.

### Cho Quản trị viên (Admin)

1. **Đăng nhập Admin**: Truy cập `/admin` với tài khoản admin
2. **Quản lý Sản phẩm**: Thêm, sửa, xóa sản phẩm và danh mục
3. **Quản lý Đơn hàng**: Xem danh sách, cập nhật trạng thái giao hàng
4. **Quản lý Khuyến mãi**: Tạo mã giảm giá, chương trình khuyến mãi
5. **Xem Báo cáo**: Dashboard doanh thu, sản phẩm bán chạy, biểu đồ thống kê
6. **Quản lý Người dùng**: Xem, chỉnh sửa, khóa tài khoản người dùng

---

## Đóng góp (Contributing)

Nếu bạn muốn đóng góp cho dự án:

1. **Fork** dự án
2. **Tạo nhánh mới** cho tính năng của bạn:
   ```bash
   git checkout -b feature/TinhNangMoi
   ```
3. **Commit** thay đổi:
   ```bash
   git commit -m 'Thêm tính năng mới: [mô tả]'
   ```
4. **Push** lên nhánh:
   ```bash
   git push origin feature/TinhNangMoi
   ```
5. **Tạo Pull Request** để chúng tôi review

---

## Hướng phát triển (Future Enhancements)

- [ ] Tích hợp **thanh toán online** (VNPay, Stripe, PayPal)
- [ ] Gửi **email thông báo** khi đơn hàng cập nhật trạng thái
- [ ] Tích hợp **barcode / QR code** cho sản phẩm
- [ ] Ứng dụng **Mobile** (React Native)
- [ ] Nâng cấp **AI Chatbot** với machine learning
- [ ] Tích hợp **video tutorial** câu cá
- [ ] Hệ thống **đánh giá / bình luận** sản phẩm
- [ ] **Affiliate marketing** cho các blogger câu cá

---

## Ghi chú quan trọng

- **Database**: Đảm bảo MySQL/MariaDB đang chạy trước khi khởi động Backend
- **Environment variables**: Luôn tạo file `.env` riêng cho mỗi môi trường (local, staging, production)
- **API URL**: Trong development, frontend trỏ tới `http://localhost:8000/api`. Thay đổi khi deploy
- **Security**: Không commit file `.env` thực lên repository; sử dụng `.env.example`

---

## Liên hệ

Mọi thắc mắc hoặc đề xuất, vui lòng:
- Mở **Issue** trên GitHub
- Tạo **Pull Request** để đóng góp
- Liên hệ nhóm phát triển qua email

---

## License

Dự án này là mã nguồn mở và được phátriển cho mục đích học tập.

---

**© 2025–2026 – UIT · Phát triển ứng dụng web · ĐHQG TP.HCM**
