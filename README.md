# Hệ Thống Quản Lý Thư Viện (LibTech)

## 1. Giới thiệu
Dự án này là một hệ thống Quản Lý Thư Viện trực tuyến (LibTech) được xây dựng trên nền tảng framework Laravel (PHP). Hệ thống được thiết kế phục vụ cả hai đối tượng là Người quản trị (Admin) và Độc giả (User). Mục tiêu của dự án là số hóa quy trình quản lý sách, theo dõi mượn trả, quản lý giao dịch thanh toán và hỗ trợ người dùng tương tác, đánh giá các đầu sách một cách hiện đại và trực quan nhất.

## 2. Mục tiêu dự án
- Xây dựng một hệ thống thư viện thân thiện, dễ sử dụng, thiết kế Responsive.
- Quản lý chi tiết hệ thống sách (Thể loại, Tác giả, Nhà xuất bản, Kệ sách).
- Số hóa quy trình mượn/trả sách và mua sách, kèm theo tính năng duyệt và theo dõi trạng thái thanh toán.
- Cung cấp tính năng tương tác hai chiều thông qua phần Đánh giá & Nhận xét sách dành cho độc giả.
- Cung cấp hệ thống Dashboard thống kê, báo cáo số lượng sách, lượt mượn trả và giao dịch để hỗ trợ công tác quản trị của Admin.

## 3. Các thực thể dữ liệu chính (Entities)
Một số đặc trưng quan trọng trong hệ thống cơ sở dữ liệu ảnh hưởng đến quy trình quản lý:
- `Users` / `Readers`: Người dùng, độc giả tham gia vào hệ thống.
- `Books`: Sách (bao gồm thông tin tên sách, giá, trạng thái, ảnh bìa, mô tả).
- `Categories`, `Authors`, `Publishers`, `Shelves`: Các danh mục hỗ trợ phân loại và tổ chức sách.
- `Borrows`: Quản lý các phiên mượn trả sách (ai mượn, mượn sách gì, ngày mượn, ngày trả, trạng thái).
- `Payments`: Lưu trữ các giao dịch thanh toán khi người dùng có nhu cầu mua hoặc mượn sách.
- `Reviews`: Phản hồi, điểm đánh giá chất lượng (1-5 sao) và bình luận của độc giả.

## 4. Quy trình thực hiện & Các tính năng cốt lõi
### Bước 1. Xác thực và Phân quyền (Authentication)
- Xây dựng hệ thống Đăng nhập / Đăng ký cơ bản và tích hợp tính năng đăng nhập nhanh qua Google OAuth.
- Phân quyền (Role-based Access Control): Admin có toàn quyền quản lý hệ thống, User (độc giả) chỉ có thể thực hiện xem sách, mượn/mua sách, theo dõi lịch sử cá nhân và đánh giá.

### Bước 2. Quản lý danh mục lõi
- Xây dựng hệ thống CRUD (Tạo, Đọc, Cập nhật, Xóa) cho các bảng Sách, Tác giả, Thể loại, Nhà xuất bản và Kệ sách.
- Hỗ trợ tính năng "Xóa mềm" (Soft Deletes) đối với Sách và hiển thị thùng rác để có thể khôi phục, tránh mất mát dữ liệu do thao tác nhầm.

### Bước 3. Quy trình Mượn/Mua và Thanh toán
- Người dùng xem chi tiết cuốn sách và tạo yêu cầu Mua đứt hoặc Mượn sách.
- Hệ thống tạo một Giao dịch (`Payment`) ở trạng thái "Chờ Xử Lý".
- Admin tiếp nhận yêu cầu, kiểm tra khoản thanh toán và tiến hành cập nhật trạng thái sang "Đã Thanh Toán". 
- Nếu giao dịch là Mượn sách, hệ thống tự động sinh ra bản ghi Mượn Trả (`Borrow`) tương ứng để Admin tiện theo dõi việc trả sách sau này.

### Bước 4. Tương tác và Đánh giá
- Xây dựng giao diện "Lịch Sử Giao Dịch" cho người dùng cá nhân theo dõi trạng thái các sách mình đã thanh toán.
- Từ danh sách này, người dùng có thể gửi Đánh giá, Nhận xét trực tiếp cho những cuốn sách đã giao dịch thành công thông qua Modal tiện lợi.
- Điểm đánh giá trung bình và các nhận xét được tổng hợp và hiển thị công khai trên trang chi tiết sách để các độc giả khác có góc nhìn khách quan.

### Bước 5. Thống kê và Bảng điều khiển (Dashboard)
- Xây dựng Admin Dashboard hiển thị thống kê tổng quan: tổng số tài khoản, số lượng sách, số giao dịch.
- Trực quan hóa dữ liệu "Mượn theo sách" và theo dõi hoạt động hệ thống.

## 5. Giải thích chi tiết các thành phần trong project
### File cơ sở dữ liệu (Migrations & Models)
- `database/migrations/`: Chứa các tệp định nghĩa cấu trúc bảng (schema), giúp tái tạo toàn bộ CSDL một cách đồng nhất.
- `app/Models/`: Chứa các Model (Eloquent ORM) định nghĩa cấu trúc dữ liệu và mối quan hệ phức tạp (Ví dụ: Một cuốn sách có nhiều đánh giá, Một User có nhiều giao dịch).

### Mã nguồn điều khiển (Controllers & Middleware)
- `app/Http/Controllers/`: Nơi chứa logic nghiệp vụ chính của dự án.
  - `BookController`: Xử lý việc hiển thị sách, thêm, sửa, xóa, khôi phục sách, lọc và phân trang.
  - `PaymentController`: Quản lý tạo giao dịch và tính năng duyệt thanh toán của Admin.
  - `BorrowController`: Quản lý danh sách mượn trả và thao tác "Xác nhận trả sách".
  - `ReviewController`: Xử lý việc nhận và lưu đánh giá từ phía người dùng.
- `app/Http/Middleware/CheckAdmin.php`: Chặn và bảo vệ các routes yêu cầu quyền quản trị, chống truy cập trái phép.

### Giao diện hiển thị (Views)
- `resources/views/`: Chứa các tệp giao diện (Blade templates) tích hợp Bootstrap 5.
  - `layouts/master.blade.php`: Tệp giao diện khung (Layout gốc) chứa cấu trúc Navbar, Sidebar và Footer dùng chung cho mọi trang.
  - Các thư mục con như `books/`, `payments/`, `borrows/` chứa các trang hiển thị danh sách và Form chi tiết của từng module.

## 6. Cấu trúc thư mục thực tế
```text
library-management/
|-- app/
|   |-- Http/Controllers/   (Logic điều khiển hệ thống)
|   |-- Http/Middleware/    (Các lớp màng lọc bảo mật)
|   |-- Models/             (Các lớp ánh xạ dữ liệu cơ sở)
|-- bootstrap/              (Khởi động ứng dụng)
|-- config/                 (Các tệp cấu hình hệ thống)
|-- database/
|   |-- migrations/         (Các tệp khởi tạo CSDL)
|   `-- database.sqlite     (Tệp CSDL SQLite cục bộ)
|-- public/
|   `-- storage/            (Nơi lưu trữ ảnh bìa sách và media tải lên)
|-- resources/
|   `-- views/              (Mã nguồn giao diện người dùng .blade.php)
|-- routes/
|   `-- web.php             (Định tuyến tất cả các URL của website)
|-- .env                    (Tệp khai báo biến môi trường)
|-- artisan                 (Công cụ chạy lệnh của Laravel)
|-- composer.json           (Khai báo các thư viện PHP cần thiết)
`-- README.md               (Tài liệu dự án)
```

## 7. Cách chạy chương trình
### Cài đặt môi trường
Đảm bảo máy tính của bạn đã cài đặt PHP (phiên bản >= 8.2), phần mềm Composer và Node.js.

### Bước 1: Clone dự án và cài đặt thư viện
Mở Terminal / Command Prompt và chạy các lệnh sau:
```bash
git clone <repository_url>
cd library-management
composer install
npm install && npm run build
```

### Bước 2: Thiết lập tệp cấu hình
Tạo tệp `.env` dựa trên bản mẫu `.env.example`:
```bash
cp .env.example .env
php artisan key:generate
```
*(Lưu ý: Mặc định hệ thống sử dụng SQLite. Nếu bạn muốn sử dụng MySQL, hãy thay đổi thông tin `DB_CONNECTION` bên trong tệp `.env` cho phù hợp).*

### Bước 3: Khởi tạo Cơ sở dữ liệu và Storage
Chạy lệnh tạo bảng và link thư mục lưu trữ ảnh:
```bash
php artisan migrate
php artisan storage:link
```
*(Lệnh `storage:link` vô cùng quan trọng để trình duyệt có thể truy cập và hiển thị được hình ảnh sách tải lên).*

### Bước 4: Khởi động Server
```bash
php artisan serve
```
Mở trình duyệt web và truy cập vào đường dẫn: `http://127.0.0.1:8000` để bắt đầu sử dụng.

## 8. Kết luận
Dự án đã hoàn thiện trọn vẹn các yêu cầu cốt lõi của một hệ thống quản lý thư viện hiện đại:
- Có quy trình mượn/trả sách, mua sách và duyệt thanh toán khép kín, minh bạch.
- Có chức năng quản trị dữ liệu thư viện đa dạng và đầy đủ (Sách, Tác giả, Độc giả, Thể loại, Kệ sách).
- Giao diện người dùng tối ưu, phân quyền rõ rệt và an toàn giữa Admin và User.
- Tích hợp thành công và mượt mà tính năng tương tác cộng đồng (đánh giá, nhận xét sách).
- Vận hành trơn tru trên framework Laravel với mô hình kiến trúc MVC vững chắc.

## 9. Thành Viên Nhóm
- [ ] Hoàng Quang Hợp(20220589)(Trưởng Nhóm): 
-Đảm nhận vai trò "kiến trúc sư" và xử lý logic khó (Thiết kế CSDL, luồng thanh toán, mượn trả, thuật toán thống kê Dashboard, tổng hợp và review code), chỉnh sửa tài liệu README. 
- [ ] Bùi Khánh Hùng:(20220656) 
- Chuyên trách Frontend. Lo toàn bộ giao diện UI/UX (Blade, Bootstrap), làm chức năng Đánh giá (Modal), và đảm bảo web hiển thị đẹp trên điện thoại.
- [ ] Đào Vũ Hoàng:(20220524) 
-Chuyên trách Backend mảng Danh mục. Lập trình CRUD và xử lý dữ liệu cho Tác giả, Thể loại, Nhà XB, Kệ sách và làm Validation.
- [ ] Vũ Hoàng Anh Tú(20220473): 
- Chuyên trách Bảo mật, Phân quyền & Document. Xử lý Đăng nhập, Google OAuth, viết Middleware phân quyền Admin/User.
