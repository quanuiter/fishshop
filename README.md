=======
# FishShop - Hệ Thống Thương Mại Điện Tử Dành Cho Dân Câu

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
    <!-- end list -->

    ```bash
    cp .env.example .env
    ```

      * Mở file `.env` và cấu hình thông tin database của bạn (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Tạo Key ứng dụng:**

    ```bash
    php artisan key:generate
    ```

6.  **Chạy Migration và Seed dữ liệu mẫu:**
    *(Lệnh này sẽ tạo bảng và thêm dữ liệu mẫu như Admin, Sản phẩm, Danh mục)*

    ```bash
    php artisan migrate --seed
    ```

    *Lưu ý: Kiểm tra file `database/seeders/AdminUserSeeder.php` để biết tài khoản Admin mặc định.*

7.  **Chạy dự án:**
    Bạn cần mở 2 terminal để chạy song song:

      * Terminal 1 (Chạy Laravel Server):
        ```bash
        php artisan serve
        ```
      * Terminal 2 (Chạy Vite để build assets):
        ```bash
        npm run dev
        ```

8.  **Truy cập:**
    Mở trình duyệt và truy cập: `http://localhost:8000`

## Cấu Trúc Thư Mục Chính

  * `app/Http/Controllers`: Chứa logic xử lý chính (Admin, Auth, Cart, v.v.).
  * `app/Models`: Các model tương tác với database (Product, Order, CatchLog...).
  * `resources/views`: Giao diện người dùng (Blade templates).
      * `admin/`: Giao diện trang quản trị.
      * `market/`: Giao diện cửa hàng/chợ.
  * `routes/web.php`: Định nghĩa các đường dẫn (URL) của trang web.
  * `database/migrations`: Cấu trúc cơ sở dữ liệu.

## Đóng Góp (Contributing)

Nếu bạn muốn đóng góp cho dự án:

1.  Fork dự án.
2.  Tạo nhánh mới (`git checkout -b feature/TinhNangMoi`).
3.  Commit thay đổi (`git commit -m 'Thêm tính năng mới'`).
4.  Push lên branch (`git push origin feature/TinhNangMoi`).
5.  Tạo Pull Request.

## License

Dự án này là mã nguồn mở.
