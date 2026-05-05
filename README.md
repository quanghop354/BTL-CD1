# 📚 LibTech - Hệ Thống Quản Lý Thư Viện Hiện Đại

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)

## 🌟 Giới thiệu
**LibTech** là giải pháp quản lý thư viện trực tuyến toàn diện, được xây dựng trên nền tảng **Laravel 11**. Hệ thống được thiết kế để tối ưu hóa quy trình mượn trả, quản lý kho sách và tăng cường tương tác giữa độc giả với nhà quản lý thông qua trải nghiệm người dùng hiện đại, trực quan và bảo mật.

---

## 🚀 Tính năng nổi bật

### 🔑 Xác thực & Phân quyền (RBAC)
- **Đăng nhập đa phương thức:** Hỗ trợ đăng nhập truyền thống và **Google OAuth 2.0**.
- **Phân quyền chi tiết:** 
  - **Admin/Staff:** Toàn quyền quản trị sách, độc giả, duyệt giao dịch và xem báo cáo.
  - **User (Độc giả):** Tìm kiếm sách, đăng ký mượn/mua, theo dõi lịch sử và đánh giá sách.

### 📖 Quản lý Kho sách Thông minh
- **Danh mục đa tầng:** Quản lý chi tiết theo Thể loại, Tác giả, Nhà xuất bản và Kệ sách.
- **Trạng thái Sách:** Theo dõi thời gian thực số lượng sách sẵn có, đang mượn hoặc đã mất.
- **Thùng rác (Soft Deletes):** Khôi phục dữ liệu sách đã xóa một cách an toàn.

### 💳 Quy trình Mượn/Mua & Thanh toán Khép kín
- **Giỏ hàng tiện lợi:** Độc giả có thể chọn nhiều sách để mượn hoặc mua cùng lúc.
- **Duyệt giao dịch:** Quy trình xác nhận thanh toán minh bạch giữa Độc giả và Quản trị viên.
- **Tự động hóa:** Hệ thống tự động chuyển trạng thái mượn sách ngay khi giao dịch thanh toán thành công.

### 📊 Dashboard & Báo cáo Trực quan
- Thống kê tổng quan qua biểu đồ (Chart.js) về xu hướng mượn sách.
- Báo cáo doanh thu và tần suất mượn trả theo thời gian thực.

### 💬 Tương tác Cộng đồng
- Hệ thống **Đánh giá & Nhận xét** (Rating 1-5 sao) trực tiếp trên từng đầu sách.
- Hiển thị phản hồi từ cộng đồng giúp độc giả dễ dàng lựa chọn sách hay.

---

## 🛠 Công nghệ sử dụng
- **Backend:** Laravel 11.x (PHP 8.2+)
- **Frontend:** Blade Template Engine, Bootstrap 5.3, JavaScript (Vanilla/jQuery)
- **Database:** MySQL 8.0
- **Social Auth:** Laravel Socialite (Google Integration)
- **Icons:** FontAwesome 6.0

---

## 📂 Cấu trúc thư mục Chính
```text
library-management/
├── app/
│   ├── Http/Controllers/   # Xử lý logic nghiệp vụ
│   ├── Http/Middleware/    # Kiểm tra quyền truy cập (Admin/Staff)
│   └── Models/             # Định nghĩa thực thể và quan hệ CSDL
├── database/
│   ├── migrations/         # Cấu trúc bảng CSDL
│   └── seeders/            # Dữ liệu mẫu khởi tạo
├── resources/
│   └── views/              # Giao diện người dùng (Blade)
├── routes/
│   └── web.php             # Định tuyến hệ thống
└── .env                    # Cấu hình môi trường (DB, Mail, Google API)
```

---

## 💻 Hướng dẫn Cài đặt

### 1. Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### 2. Các bước thực hiện
```bash
# Clone dự án
git clone https://github.com/quanghop354/BTL-CD1.git
cd library-management

# Cài đặt phụ thuộc
composer install
npm install && npm run dev

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Khởi tạo CSDL
# (Lưu ý: Tạo database tên 'library_management' trong MySQL trước)
php artisan migrate --seed
php artisan storage:link

# Khởi chạy
php artisan serve
```
Truy cập: `http://127.0.0.1:8000`

---

## 👥 Đội ngũ thực hiện

| MSSV | Họ và Tên | Vai trò | Công việc chính |
| :--- | :--- | :--- | :--- |
| **20220589** | **Hoàng Quang Hợp** | **Trưởng nhóm** | Kiến trúc hệ thống, Logic mượn trả/thanh toán, Thống kê Dashboard, Git Manager. |
| **20220656** | **Bùi Khánh Hùng** | **Frontend Dev** | UI/UX Design, Hệ thống Đánh giá, Responsive Design. |
| **20220524** | **Đào Vũ Hoàng** | **Backend Dev** | Quản lý danh mục (CRUD), Validation dữ liệu, API Integration. |
| **20220473** | **Vũ Hoàng Anh Tú** | **Security/Doc** | Phân quyền Middleware, Google OAuth, Tài liệu kỹ thuật. |

---

## 📄 Bản quyền
Dự án được phát triển nhằm mục đích học tập và nghiên cứu công nghệ Web. Mọi đóng góp vui lòng gửi về địa chỉ email của trưởng nhóm.
