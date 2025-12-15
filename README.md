# FishShop - He thong Website Ban dung cu Cau ca

FishShop là một ứng dụng web thương mại điện tử chuyên cung cấp các dụng cụ câu cá, được xây dựng trên nền tảng Laravel Framework. Hệ thống bao gồm đầy đủ các tính năng cho người dùng mua hàng và trang quản trị dành cho Admin để quản lý sản phẩm, đơn hàng và doanh thu.

## Yeu cau he thong

Để chạy dự án này, máy tính của bạn cần cài đặt các phần mềm sau:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL hoặc MariaDB

## Huong dan cai dat

Làm theo các bước sau để thiết lập dự án trên môi trường local:

### 1. Clone du an
Sao chép mã nguồn về máy của bạn:
git clone <link-repo-cua-ban>
cd fishshop

### 2. Cai dat cac thu vien phu thuoc
Chạy lệnh sau để cài đặt các gói PHP và JavaScript cần thiết:
composer install
npm install

### 3. Cau hinh moi truong
Sao chép file cấu hình mẫu và tạo file .env mới:
cp .env.example .env

Mở file .env và cấu hình thông tin cơ sở dữ liệu của bạn (DB_DATABASE, DB_USERNAME, DB_PASSWORD). Ví dụ:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fishshop
DB_USERNAME=root
DB_PASSWORD=

### 4. Tao Application Key
Chạy lệnh sau để tạo khóa mã hóa cho ứng dụng:
php artisan key:generate

### 5. Khoi tao co so du lieu va du lieu mau (Seeding)
Bước này rất quan trọng để tạo tài khoản Admin và dữ liệu sản phẩm mẫu. Lệnh này sẽ chạy các file migration và seeder (bao gồm AdminUserSeeder, ProductSeeder, v.v.):
php artisan migrate --seed

### 6. Bien dich Assets (Frontend)
Để hiển thị giao diện chính xác, bạn cần biên dịch các file CSS và JS:
npm run build

### 7. Chay Server
Khởi chạy server local của Laravel:
php artisan serve

Sau khi chạy xong, truy cập website tại địa chỉ: http://localhost:8000

---

## Thong tin tai khoan Admin

Sau khi chạy lệnh "php artisan migrate --seed", hệ thống sẽ tự động tạo một tài khoản quản trị viên mặc định.

- Email: 1@admin.com
- Mat khau: 123

Lưu ý: Thông tin này được cấu hình trong file "database/seeders/AdminUserSeeder.php". Bạn có thể thay đổi mật khẩu sau khi đăng nhập.

---

## Huong dan su dung va Chuc nang

### 1. Danh cho Khach hang (User)
Người dùng truy cập vào trang chủ để thực hiện các chức năng:
- Dang ky / Dang nhap: Tạo tài khoản thành viên để mua hàng.
- Xem san pham: Duyệt danh sách cần câu, máy câu, mồi câu và xem chi tiết sản phẩm.
- Gio hang: Thêm sản phẩm vào giỏ, cập nhật số lượng và xem tổng tiền.
- Thanh toan (Checkout): Đặt hàng và nhập thông tin giao hàng.
- Nhat ky cau ca (Catch Log): Người dùng có thể đăng tải hình ảnh và nhật ký về các chuyến đi câu của mình để chia sẻ với cộng đồng.
- Chatbot: Hỗ trợ giải đáp thắc mắc cơ bản.

### 2. Danh cho Quan tri vien (Admin)
Truy cập vào đường dẫn "/admin" hoặc đăng nhập bằng tài khoản Admin để vào trang Dashboard. Các chức năng bao gồm:
- Quan ly Danh muc: Thêm, sửa, xóa các loại sản phẩm.
- Quan ly San pham: Quản lý thông tin chi tiết, giá cả, hình ảnh và các biến thể của sản phẩm.
- Quan ly Don hang: Xem danh sách đơn hàng mới, cập nhật trạng thái xử lý đơn hàng.
- Quan ly Khuyen mai: Tạo và quản lý các mã giảm giá hoặc chương trình khuyến mãi.
- Bao cao Doanh thu: Xem biểu đồ thống kê doanh thu theo thời gian.

## Cau truc thu muc chinh
- app/Http/Controllers/Admin: Chứa mã nguồn xử lý logic cho trang quản trị.
- app/Models: Chứa các model tương tác với cơ sở dữ liệu (Product, Order, User...).
- database/migrations: Các file định nghĩa cấu trúc bảng trong cơ sở dữ liệu.
- database/seeders: Các file tạo dữ liệu mẫu.
- resources/views: Chứa giao diện người dùng (Blade templates).
- routes/web.php: Định nghĩa các đường dẫn (URL) của trang web.