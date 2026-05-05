# Hướng Dẫn Sử Dụng RBAC - Nhanh Chóng

## Tóm Tắt Nhanh

Hệ thống hiện có **2 vai trò**:
- **Admin** 🔐 - Quản lý toàn bộ hệ thống
- **User** 👤 - Độc giả bình thường (mặc định)

Cả hai cùng login ở 1 giao diện, nhưng dashboard & menu khác nhau.

---

## Bước Kiểm Tra Hệ Thống

### 1. Tạo Tài Khoản Admin (hoặc Chuyển User Thành Admin)

**Qua Database (phpmyadmin):**
```sql
-- Tạo admin mới
INSERT INTO users (name, email, username, password, role) 
VALUES ('Admin', 'admin@example.com', 'admin', SHA2('password123', 256), 'admin');

-- Hoặc chuyển user hiện tại thành admin
UPDATE users SET role = 'admin' WHERE id = 1;
```

**Qua Artisan Tinker:**
```bash
php artisan tinker

# Copy dòng này vào tinker:
User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'username' => 'admin', 'password' => Hash::make('password123'), 'role' => 'admin'])
```

### 2. Kiểm Tra Khi Đăng Nhập

**Đăng Nhập Với Tài Khoản Admin:**
- ✅ Thấy menu **"Độc Giả"** (👥)
- ✅ Thấy menu **"Thể Loại"** (🏷️)
- ✅ Dashboard hiển thị **4 thống kê**: Sách, Độc Giả, Mượn, Thể Loại
- ✅ Badge **"Admin"** cạnh tên trong dropdown

**Đăng Nhập Với Tài Khoản User:**
- ❌ Không thấy menu **"Độc Giả"**
- ❌ Không thấy menu **"Thể Loại"**
- ✅ Dashboard hiển thị **1 thống kê**: Chỉ Sách
- ✅ Badge **"User"** cạnh tên trong dropdown

### 3. Kiểm Tra Quyền Hạn

**Admin Có Thể:**
- Tạo/Sửa/Xóa Sách
- Tạo/Sửa/Xóa Thể Loại
- Tạo/Sửa/Xóa Độc Giả
- Quản lý Mượn Trả

**User Chỉ Có Thể:**
- Xem Sách
- Tạo yêu cầu Mượn
- Xem lịch sử Mượn
- Sửa Thông Tin Cá Nhân

---

## Các Tuyến Đường (Routes) Được Bảo Vệ

### Chỉ Admin:
```
GET/POST  /books/create              (Tạo sách)
GET       /books/{id}/edit           (Sửa sách)
DELETE    /books/{id}                (Xóa sách)
GET       /categories                (Danh sách thể loại)
POST      /categories                (Tạo thể loại)
GET/POST  /categories/{id}/edit      (Sửa thể loại)
DELETE    /categories/{id}           (Xóa thể loại)
GET       /readers                   (Danh sách độc giả)
POST      /readers                   (Tạo độc giả)
GET/POST  /readers/{id}/edit         (Sửa độc giả)
DELETE    /readers/{id}              (Xóa độc giả)
POST      /borrows/{id}/return       (Xác nhận trả sách)
```

### Tất Cả User (Admin + Regular User):
```
GET       /dashboard                 (Dashboard)
GET       /books                     (Danh sách sách)
GET       /books/{id}                (Chi tiết sách)
GET       /borrows                   (Danh sách mượn)
POST      /borrows                   (Tạo mượn)
GET       /profile                   (Thông tin cá nhân)
PUT       /profile                   (Cập nhật thông tin)
POST      /logout                    (Đăng xuất)
```

---

## Kiểm Tra Lỗi

### Nếu User Cố Truy Cập Admin Route:
**Bạn sẽ thấy:** "403 | Bạn không có quyền truy cập trang này."

### Nếu Admin Không Có Quyền:
**Kiểm tra:**
1. Vai trò trong database là `'admin'` hay `'user'`?
2. Middleware `admin` có được áp dụng cho route không?

---

## Công Cụ Hữu Ích

### Kiểm Tra Vai Trò Hiện Tại (Trong Blade Template):
```blade
@if(Auth::user()->isAdmin())
    <p>Bạn là admin</p>
@endif

@if(Auth::user()->isUser())
    <p>Bạn là user thường</p>
@endif
```

### Kiểm Tra Vai Trò (Trong Controller):
```php
if (auth()->user()->isAdmin()) {
    // Làm gì đó dành cho admin
}
```

---

## Test Case

| Test | Admin | User |
|------|-------|------|
| Đăng nhập | ✅ | ✅ |
| Xem Sách | ✅ | ✅ |
| Tạo Sách | ✅ | ❌ Lỗi 403 |
| Xem Menu Độc Giả | ✅ | ❌ Ẩn |
| Xem Menu Thể Loại | ✅ | ❌ Ẩn |
| Dashboard Toàn Bộ | ✅ | ❌ Chỉ một phần |
| Mượn Sách | ✅ | ✅ |
| Xác Nhận Trả Sách | ✅ | ❌ Lỗi 403 |

---

## Ghi Chú Quan Trọng

1. **Google Login → Mặc định là User**: Khi đăng nhập bằng Google, tài khoản mới được tạo với vai trò `'user'`. Phải chuyển thành `'admin'` thủ công nếu cần.

2. **Middleware Kiểm Tra Ở Server**: Tất cả kiểm tra vai trò được thực hiện ở phía server (an toàn), không phải phía client.

3. **Hai Lớp Bảo Vệ**: 
   - Middleware ở route
   - Controller logic (kiểm tra thêm)
   - Blade template (ẩn UI)

4. **Thêm vai trò mới**: Xem [ROLE_BASED_ACCESS_CONTROL.md](ROLE_BASED_ACCESS_CONTROL.md) phần "Mở Rộng Trong Tương Lai"

---

**Lần Cập Nhật Cuối:** 18 Tháng 4, 2026
