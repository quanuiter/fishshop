# 🧭 PROJECT_GUIDE_FOR_GPT_v3.md
*(Laravel FishShop – Chuẩn cấu trúc & ràng buộc cho nhóm và GPT)*

## 🧱 1. TỔNG QUAN DỰ ÁN
- Dự án Laravel: **FishShop**
- Mục tiêu: web bán đồ câu cá (quản lý danh mục, sản phẩm, giỏ hàng, đơn hàng).
- Đã có **Auth mặc định Laravel (login, register, logout)** → chỉ gọi route, không chỉnh sửa.
- Toàn bộ **Model & Migration đã hoàn thiện**.
- Mỗi model có **Controller riêng**, nhóm tự triển khai logic.
- Giỏ hàng **sử dụng session**, **không lưu trong database**.

---

## ⚙️ 2. CẤU TRÚC DATABASE & MODEL

### 🐟 2.1. `Category`
```php
id, name, slug (unique), description (nullable), timestamps
```
```php
class Category extends Model {
    protected $fillable = ['name','slug','description'];
    public function products() { return $this->hasMany(Product::class); }
}
```

### 🎣 2.2. `Product`
```php
id, category_id (nullable FK→categories.id ON DELETE SET NULL),
name, description (nullable), price (decimal 10,2),
stock (int default 0), image (nullable), timestamps
```
```php
class Product extends Model {
    protected $fillable = ['category_id','name','description','price','stock','image'];
    public function category() { return $this->belongsTo(Category::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
}
```

### 🛒 2.3. `Cart` (DÙNG SESSION – KHÔNG CÓ TRONG DATABASE)
- Giỏ hàng **được lưu tạm thời trong session**, theo từng user đăng nhập.
- Mỗi sản phẩm trong cart chứa các thông tin:
  ```php
  [
    'product_id' => int,
    'name' => string,
    'price' => float,
    'quantity' => int,
    'image' => string|null
  ]
  ```
- Các thao tác:
  - Thêm sản phẩm vào giỏ.
  - Cập nhật số lượng.
  - Xóa sản phẩm.
  - Xóa toàn bộ giỏ.

---

### 📦 2.4. `Order`
```php
id, user_id (FK→users.id ON DELETE CASCADE),
total_amount (decimal 10,2),
status (enum: pending|confirmed|shipping|completed|cancelled default=pending),
name, phone, address, payment_method (default='COD'), timestamps
```
```php
class Order extends Model {
    protected $fillable = ['user_id','total_amount','status','name','phone','address','payment_method'];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}
```

### 📄 2.5. `OrderItem`
```php
id, order_id (FK→orders.id ON DELETE CASCADE),
product_id (FK→products.id ON DELETE CASCADE),
quantity (int default 1), price (decimal 10,2), timestamps
```
```php
class OrderItem extends Model {
    protected $fillable = ['order_id','product_id','quantity','price'];
    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
```

### 👤 2.6. `User` (Laravel mặc định)
```php
class User extends Authenticatable {
    protected $fillable = ['name','email','password'];
    public function orders() { return $this->hasMany(Order::class); }
}
```

---

## 🔗 3. QUAN HỆ DỮ LIỆU
```
Category
 ┗ hasMany → Product
Product
 ┣ belongsTo → Category
 ┗ hasMany → OrderItem
User
 ┗ hasMany → Order
Order
 ┣ belongsTo → User
 ┗ hasMany → OrderItem
OrderItem
 ┣ belongsTo → Order
 ┗ belongsTo → Product
```

> 🛒 *Cart* không nằm trong database → không tham gia quan hệ.

---

## 📁 4. CẤU TRÚC DỰ ÁN CHUẨN
```
app/
 ┣ Http/
 ┃ ┗ Controllers/
 ┃   ┣ CategoryController.php
 ┃   ┣ ProductController.php
 ┃   ┣ CartController.php
 ┃   ┣ OrderController.php
 ┃   ┗ OrderItemController.php
 ┗ Models/
     ┣ Category.php
     ┣ Product.php
     ┣ Order.php
     ┗ OrderItem.php

resources/
 ┗ views/
     ┣ categories/
     ┣ products/
     ┣ carts/
     ┣ orders/
     ┗ order_items/

routes/
 ┗ web.php
```

---

## ⚖️ 5. QUY TẮC DÀNH CHO GPT
### ❌ Không được:
- Thêm/sửa migration hoặc model.
- Tạo bảng mới hoặc thay đổi quan hệ.
- Đụng vào Auth mặc định.
- **Lưu giỏ hàng vào database.**
- Dùng `DB::table()` thay vì model.

### ✅ Được phép:
- Viết logic trong controller tương ứng.
- Dùng session để thao tác với giỏ hàng.
- Dùng model để CRUD dữ liệu khác (Product, Order, OrderItem).
- Viết view trong đúng folder tương ứng.
- Thêm route khớp controller.
- Dùng `middleware('auth')` cho các phần cần đăng nhập (cart, order).

---

## 🧠 6. CÁCH DÙNG FILE NÀY VỚI GPT
> Khi yêu cầu GPT code, **dán nguyên file này trước**, rồi thêm mô tả công việc.  
> Ví dụ:  
> “Đây là hướng dẫn dự án Laravel FishShop.  
> Tôi đang làm phần `CartController`, hãy viết logic thêm sản phẩm vào giỏ (`add()`) sử dụng **session**, không lưu database.”

GPT sẽ hiểu:
- Database và model đã sẵn sàng.
- Route + view tương ứng đã định dạng chuẩn.
- Giỏ hàng xử lý qua session.
- Không cần tạo lại migration hoặc model.
- Chỉ cần code đúng phạm vi controller/view tương ứng.

---

## 🎯 7. MỤC TIÊU DỰ ÁN
- Toàn nhóm thống nhất **một cấu trúc thư mục, model, route, và quy tắc làm việc.**
- Mỗi người tự triển khai controller riêng, không đụng code của nhau.
- Dễ merge, dễ maintain, GPT hiểu đúng ngữ cảnh khi hỗ trợ code.

> 📘 **Tóm gọn:** Đây là “hợp đồng kỹ thuật” của nhóm.  
> GPT phải tuân thủ đúng model, quan hệ, và cấu trúc thư mục.  
> Thành viên chỉ cần nói rõ mình đang làm controller nào → GPT hiểu toàn bộ hệ thống và sinh code đúng logic.
