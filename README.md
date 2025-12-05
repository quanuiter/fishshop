Dưới đây là phiên bản `README.md` đã được loại bỏ các biểu tượng (icon):

-----

# FishShop - Hệ Thống Thương Mại Điện Tử Dành Cho Dân Câu

**FishShop** là một nền tảng website thương mại điện tử chuyên cung cấp dụng cụ câu cá, kết hợp với các tiện ích cộng đồng cho cần thủ như nhật ký câu cá và dự báo thời tiết. Dự án được xây dựng trên framework **Laravel** mạnh mẽ.

## Tính Năng Nổi Bật

### Dành cho Khách Hàng (Người dùng)

  * **Mua sắm trực tuyến:** Duyệt danh mục sản phẩm đa dạng (Cần câu, máy câu, mồi câu, phụ kiện...).
  * **Giỏ hàng & Thanh toán:** Thêm sản phẩm vào giỏ, quản lý số lượng và tiến hành đặt hàng.
  * **Quản lý tài khoản:** Đăng ký, đăng nhập, quên mật khẩu, xem lịch sử đơn hàng.
  * **Nhật Ký Câu Cá (Catch Logs):** Tính năng độc đáo cho phép người dùng lưu lại thành quả các chuyến đi câu (hình ảnh, loại cá, thông tin).
  * **Tiện ích:**
      * **Chatbot:** Hỗ trợ giải đáp thắc mắc tự động.
      * **Dự báo thời tiết:** Tích hợp dịch vụ thời tiết để lên kế hoạch đi câu.
  * **Tin tức & Khuyến mãi:** Cập nhật các bài viết về kỹ thuật câu và các chương trình giảm giá.

### Dành cho Quản Trị Viên (Admin)

  * **Dashboard:** Xem báo cáo doanh thu, thống kê tổng quan.
  * **Quản lý sản phẩm:** Thêm, sửa, xóa sản phẩm, biến thể sản phẩm (màu sắc, kích thước) và hình ảnh.
  * **Quản lý đơn hàng:** Theo dõi trạng thái đơn hàng, duyệt đơn.
  * **Quản lý danh mục:** Tổ chức cây danh mục sản phẩm.
  * **Báo cáo:** Xuất báo cáo doanh thu.

## Công Nghệ Sử Dụng

  * **Backend:** PHP, Laravel Framework (Phiên bản mới nhất, hỗ trợ Vite).
  * **Frontend:** Blade Templates, SCSS, JavaScript, Bootstrap.
  * **Database:** MySQL.
  * **Công cụ khác:** Composer, NPM/Yarn.

## Yêu Cầu Cài Đặt

Trước khi bắt đầu, hãy đảm bảo máy tính của bạn đã cài đặt:

  * PHP \>= 8.2
  * Composer
  * Node.js & NPM
  * MySQL

## Hướng Dẫn Cài Đặt (Installation)

Làm theo các bước sau để chạy dự án trên máy cục bộ (Localhost):

1.  **Clone dự án về máy:**

    ```bash
    git clone https://github.com/quanuiter/fishshop.git
    cd fishshop
    ```

2.  **Cài đặt các gói phụ thuộc PHP:**

    ```bash
    composer install
    ```

3.  **Cài đặt các gói phụ thuộc Frontend:**

    ```bash
    npm install
    ```

4.  **Cấu hình môi trường:**

      * Copy file `.env.example` thành `.env`:

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