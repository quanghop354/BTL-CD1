# Bài tập lớn: Đề tài số 6 - Website Quản lý Thư viện
<<<<<<< HEAD
=======

Dự án Website Quản lý Thư viện được xây dựng bằng framework Laravel, cung cấp các chức năng quản lý thư viện toàn diện, từ quản lý sách, người dùng đến mượn trả và thanh toán.

## 🚀 Các chức năng đã làm

Hệ thống bao gồm các nhóm chức năng chính được phân quyền rõ ràng:

1. **Xác thực và Phân quyền (Authentication & Authorization):**
   - Đăng nhập, đăng ký tài khoản.
   - Đăng nhập nhanh bằng tài khoản Google (Google OAuth).
   - Phân quyền người dùng: Quản trị viên (Admin) và Người dùng thường (User).
   - Quản lý thông tin cá nhân (Profile).

2. **Quản lý Sách và Thể loại (Admin):**
   - Thêm, sửa, xóa (CRUD) thông tin sách.
   - Quản lý danh mục thể loại sách.
   - Hỗ trợ xóa mềm (Soft Delete) và khôi phục sách đã xóa.
   - Mối quan hệ nhiều-nhiều giữa Sách và Thể loại.

3. **Quản lý Độc giả (Admin):**
   - Quản lý thông tin các độc giả trong hệ thống.

4. **Quản lý Mượn/Trả sách:**
   - **Người dùng:** Xem danh sách sách, tạo yêu cầu mượn sách, theo dõi lịch sử mượn trả của cá nhân.
   - **Admin:** Quản lý toàn bộ danh sách mượn sách, xác nhận trả sách, cập nhật trạng thái mượn trả.

5. **Quản lý Thanh toán (Payment):**
   - Hỗ trợ tạo yêu cầu thanh toán (phí mượn sách, mua sách,...).
   - Tích hợp mã QR Code thanh toán (MB Bank).
   - **Người dùng:** Xem lịch sử giao dịch thanh toán cá nhân.
   - **Admin:** Quản lý danh sách giao dịch, cập nhật trạng thái thanh toán.

6. **Dashboard (Bảng điều khiển):**
   - Thống kê tổng quan: Tổng số tài khoản, giao dịch thanh toán gần nhất.
   - Hiển thị thông tin thống kê khác nhau tùy thuộc vào vai trò (Admin/User).

---

## 🏗️ Mối liên kết MVC (Model - View - Controller)

Dự án tuân thủ chặt chẽ mô hình kiến trúc MVC của Laravel:

- **Model (`app/Models`):**
  - Đại diện cho cấu trúc dữ liệu và logic nghiệp vụ tương tác với cơ sở dữ liệu.
  - Các models chính: `User`, `Book`, `Category`, `Reader`, `Borrow`, `Payment`.
  - Định nghĩa các mối quan hệ: Ví dụ: `Book` `belongsToMany` `Category`, `Borrow` `belongsTo` `User` và `Book`.
- **View (`resources/views`):**
  - Chịu trách nhiệm hiển thị giao diện người dùng, sử dụng Blade template engine.
  - Tái sử dụng layout (`layouts/app.blade.php`, `layouts/guest.blade.php`).
  - Nhận dữ liệu từ Controller để render ra HTML (ví dụ: hiển thị danh sách sách, form mượn sách, bảng lịch sử thanh toán).
- **Controller (`app/Http/Controllers`):**
  - Đóng vai trò trung gian, tiếp nhận HTTP Request từ Route.
  - Các controllers chính: `AuthController`, `BookController`, `BorrowController`, `PaymentController`, `DashboardController`.
  - **Quy trình:** Controller nhận request -> Gọi Model để lấy/cập nhật dữ liệu -> Trả về View tương ứng kèm theo dữ liệu đó.

---

## 🗄️ Database (Cơ sở dữ liệu)

Cơ sở dữ liệu được thiết kế với các bảng chính sau (quản lý qua Migrations trong `database/migrations`):

- `users`: Lưu trữ thông tin tài khoản người dùng, mật khẩu, vai trò (`role`) và `google_id` cho tính năng đăng nhập Google.
- `categories`: Danh mục thể loại sách.
- `books`: Thông tin chi tiết của sách (tiêu đề, tác giả, mô tả...).
- `readers`: Thông tin người đọc trong thư viện.
- `borrows`: Bảng quản lý việc mượn trả. Liên kết người mượn, sách, ngày mượn, ngày trả dự kiến/thực tế và trạng thái.
- `book_category`: Bảng trung gian (Pivot table) thể hiện mối quan hệ n-n giữa sách và thể loại.
- `payments`: Quản lý các giao dịch thanh toán, liên kết với người dùng và trạng thái thanh toán.

---

## 🛣️ Routes (Hệ thống Định tuyến)

Hệ thống định tuyến (`routes/web.php`) được phân chia rõ ràng và bảo vệ bởi Middleware:

1. **Public Routes (Guest):** Dành cho khách chưa đăng nhập.
   - `/`, `/login`, `/register`, `/login/google`, `/login/google/callback`.
2. **Protected Routes (Auth):** Dành cho mọi người dùng đã đăng nhập (cả Admin và User).
   - `/dashboard`, `/profile` (Cập nhật thông tin cá nhân).
   - `/books` (Xem danh sách sách).
   - `/borrows` (Quản lý mượn trả cá nhân).
   - `/payments` (Lịch sử thanh toán cá nhân).
3. **Admin Routes (Auth + Admin Role):** Chỉ quản trị viên mới được truy cập.
   - Resource routes cho: `books` (ngoại trừ index/show), `categories`, `readers`.
   - Routes quản lý nâng cao: Khôi phục sách xóa mềm (`books/{id}/restore`), quản lý trả sách (`borrows/{borrow}/return`), cập nhật trạng thái thanh toán (`payments/{payment}/status`).

---

## ⚙️ Cách chạy dự án (How to Run)

Yêu cầu môi trường: PHP >= 8.2, Composer, Node.js, MySQL.

**Bước 1:** Clone dự án từ kho lưu trữ.
```bash
git clone <repository_url>
cd library-management
```

**Bước 2:** Cài đặt các thư viện PHP phụ thuộc.
```bash
composer install
```

**Bước 3:** Cài đặt các gói NPM và build assets.
```bash
npm install
npm run build # hoặc npm run dev nếu đang phát triển
```

**Bước 4:** Cấu hình môi trường.
Sao chép file `.env.example` thành `.env` và cấu hình thông tin kết nối Database.
```bash
cp .env.example .env
```
Mở file `.env` và cập nhật thông tin DB:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_management # Tạo database này trong MySQL trước
DB_USERNAME=root
DB_PASSWORD=
```
*(Lưu ý: Nếu sử dụng đăng nhập Google, cần cấu hình thêm `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI` trong file `.env`)*

**Bước 5:** Tạo Application Key cho Laravel.
```bash
php artisan key:generate
```

**Bước 6:** Chạy Migrations để tạo các bảng trong cơ sở dữ liệu.
```bash
php artisan migrate
```
*(Tuỳ chọn: Chạy seed để tạo dữ liệu mẫu nếu có: `php artisan db:seed`)*

**Bước 7:** Khởi động server phát triển.
```bash
php artisan serve
```

Dự án sẽ chạy tại địa chỉ: `http://localhost:8000`
>>>>>>> 02881ed072d5bdb0d0b2449a8eead3bc847e23d4

Dự án Website Quản lý Thư viện được xây dựng bằng framework Laravel, cung cấp các chức năng quản lý thư viện toàn diện, từ quản lý sách, người dùng đến mượn trả và thanh toán.

## 🚀 Các chức năng đã làm

Hệ thống bao gồm các nhóm chức năng chính được phân quyền rõ ràng:

1. **Xác thực và Phân quyền (Authentication & Authorization):**
   - Đăng nhập, đăng ký tài khoản.
   - Đăng nhập nhanh bằng tài khoản Google (Google OAuth).
   - Phân quyền người dùng: Quản trị viên (Admin) và Người dùng thường (User).
   - Quản lý thông tin cá nhân (Profile).

2. **Quản lý Sách và Thể loại (Admin):**
   - Thêm, sửa, xóa (CRUD) thông tin sách.
   - Quản lý danh mục thể loại sách.
   - Hỗ trợ xóa mềm (Soft Delete) và khôi phục sách đã xóa.
   - Mối quan hệ nhiều-nhiều giữa Sách và Thể loại.

3. **Quản lý Độc giả (Admin):**
   - Quản lý thông tin các độc giả trong hệ thống.

4. **Quản lý Mượn/Trả sách:**
   - **Người dùng:** Xem danh sách sách, tạo yêu cầu mượn sách, theo dõi lịch sử mượn trả của cá nhân.
   - **Admin:** Quản lý toàn bộ danh sách mượn sách, xác nhận trả sách, cập nhật trạng thái mượn trả.

5. **Quản lý Thanh toán (Payment):**
   - Hỗ trợ tạo yêu cầu thanh toán (phí mượn sách, mua sách,...).
   - Tích hợp mã QR Code thanh toán (MB Bank).
   - **Người dùng:** Xem lịch sử giao dịch thanh toán cá nhân.
   - **Admin:** Quản lý danh sách giao dịch, cập nhật trạng thái thanh toán.

6. **Dashboard (Bảng điều khiển):**
   - Thống kê tổng quan: Tổng số tài khoản, giao dịch thanh toán gần nhất.
   - Hiển thị thông tin thống kê khác nhau tùy thuộc vào vai trò (Admin/User).

---

## 🏗️ Mối liên kết MVC (Model - View - Controller)

Dự án tuân thủ chặt chẽ mô hình kiến trúc MVC của Laravel:

- **Model (`app/Models`):**
  - Đại diện cho cấu trúc dữ liệu và logic nghiệp vụ tương tác với cơ sở dữ liệu.
  - Các models chính: `User`, `Book`, `Category`, `Reader`, `Borrow`, `Payment`.
  - Định nghĩa các mối quan hệ: Ví dụ: `Book` `belongsToMany` `Category`, `Borrow` `belongsTo` `User` và `Book`.
- **View (`resources/views`):**
  - Chịu trách nhiệm hiển thị giao diện người dùng, sử dụng Blade template engine.
  - Tái sử dụng layout (`layouts/app.blade.php`, `layouts/guest.blade.php`).
  - Nhận dữ liệu từ Controller để render ra HTML (ví dụ: hiển thị danh sách sách, form mượn sách, bảng lịch sử thanh toán).
- **Controller (`app/Http/Controllers`):**
  - Đóng vai trò trung gian, tiếp nhận HTTP Request từ Route.
  - Các controllers chính: `AuthController`, `BookController`, `BorrowController`, `PaymentController`, `DashboardController`.
  - **Quy trình:** Controller nhận request -> Gọi Model để lấy/cập nhật dữ liệu -> Trả về View tương ứng kèm theo dữ liệu đó.

---

## 🗄️ Database (Cơ sở dữ liệu)

Cơ sở dữ liệu được thiết kế với các bảng chính sau (quản lý qua Migrations trong `database/migrations`):

- `users`: Lưu trữ thông tin tài khoản người dùng, mật khẩu, vai trò (`role`) và `google_id` cho tính năng đăng nhập Google.
- `categories`: Danh mục thể loại sách.
- `books`: Thông tin chi tiết của sách (tiêu đề, tác giả, mô tả...).
- `readers`: Thông tin người đọc trong thư viện.
- `borrows`: Bảng quản lý việc mượn trả. Liên kết người mượn, sách, ngày mượn, ngày trả dự kiến/thực tế và trạng thái.
- `book_category`: Bảng trung gian (Pivot table) thể hiện mối quan hệ n-n giữa sách và thể loại.
- `payments`: Quản lý các giao dịch thanh toán, liên kết với người dùng và trạng thái thanh toán.

---

## 🛣️ Routes (Hệ thống Định tuyến)

Hệ thống định tuyến (`routes/web.php`) được phân chia rõ ràng và bảo vệ bởi Middleware:

1. **Public Routes (Guest):** Dành cho khách chưa đăng nhập.
   - `/`, `/login`, `/register`, `/login/google`, `/login/google/callback`.
2. **Protected Routes (Auth):** Dành cho mọi người dùng đã đăng nhập (cả Admin và User).
   - `/dashboard`, `/profile` (Cập nhật thông tin cá nhân).
   - `/books` (Xem danh sách sách).
   - `/borrows` (Quản lý mượn trả cá nhân).
   - `/payments` (Lịch sử thanh toán cá nhân).
3. **Admin Routes (Auth + Admin Role):** Chỉ quản trị viên mới được truy cập.
   - Resource routes cho: `books` (ngoại trừ index/show), `categories`, `readers`.
   - Routes quản lý nâng cao: Khôi phục sách xóa mềm (`books/{id}/restore`), quản lý trả sách (`borrows/{borrow}/return`), cập nhật trạng thái thanh toán (`payments/{payment}/status`).

---

## ⚙️ Cách chạy dự án (How to Run)

Yêu cầu môi trường: PHP >= 8.2, Composer, Node.js, MySQL.

**Bước 1:** Clone dự án từ kho lưu trữ.
```bash
git clone <repository_url>
cd library-management
```

**Bước 2:** Cài đặt các thư viện PHP phụ thuộc.
```bash
composer install
```

**Bước 3:** Cài đặt các gói NPM và build assets.
```bash
npm install
npm run build # hoặc npm run dev nếu đang phát triển
```

**Bước 4:** Cấu hình môi trường.
Sao chép file `.env.example` thành `.env` và cấu hình thông tin kết nối Database.
```bash
cp .env.example .env
```
Mở file `.env` và cập nhật thông tin DB:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_management # Tạo database này trong MySQL trước
DB_USERNAME=root
DB_PASSWORD=
```
*(Lưu ý: Nếu sử dụng đăng nhập Google, cần cấu hình thêm `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI` trong file `.env`)*

**Bước 5:** Tạo Application Key cho Laravel.
```bash
php artisan key:generate
```

**Bước 6:** Chạy Migrations để tạo các bảng trong cơ sở dữ liệu.
```bash
php artisan migrate
```
*(Tuỳ chọn: Chạy seed để tạo dữ liệu mẫu nếu có: `php artisan db:seed`)*

**Bước 7:** Khởi động server phát triển.
```bash
php artisan serve
```

Dự án sẽ chạy tại địa chỉ: `http://localhost:8000`
