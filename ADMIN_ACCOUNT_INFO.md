# 📋 Thông Tin Tài Khoản Admin

## 👤 Tài Khoản Admin Hiện Tại

### Thông Tin Đăng Nhập
```
📧 Email (hoặc Username):  admin@email.com / admin
🔐 Mật khẩu:              admin123
⚙️ Vai trò:                admin (Quản Trị Viên)
📍 Vị trí định nghĩa:      database/seeders/DatabaseSeeder.php
```

### Nơi Tìm Tài Khoản Admin

**1️⃣ Trong Database (Bảng `users`)**
- Cột `email` = `admin@email.com`
- Cột `role` = `admin`

**2️⃣ Trong Seeder (Mã nguồn)**
```php
// File: database/seeders/DatabaseSeeder.php (dòng 34-41)
User::create([
    'name' => 'Admin Quản Trị',
    'email' => 'admin@email.com',
    'username' => 'admin',
    'password' => Hash::make('admin123'),  // Mã hóa mật khẩu
    'role' => 'admin',
]);
```

**3️⃣ Tài Khoản Test User**
```
📧 Email:    test@example.com
🔐Mật khẩu: password (mặc định từ factory)
👤 Tên:      Người Dùng Mẫu
⚙️ Vai trò:  user (Người dùng thường)
```

---

## 🚀 Cách Sử Dụng Tài Khoản Admin

### Bước 1: Chạy Seeder (Nếu chưa chạy)
```bash
php artisan db:seed
```

### Bước 2: Đăng Nhập
1. Mở: `http://localhost/library-management/login`
2. Nhập:
   - Email/Username: `admin` hoặc `admin@email.com`
   - Mật khẩu: `admin123`
3. Nhấn "Đăng Nhập"

### Bước 3: Kiểm Tra Dashboard Admin
Sau khi đăng nhập, bạn sẽ thấy:
- ✅ Menu "Độc Giả" (👥)
- ✅ Menu "Thể Loại" (🏷️)
- ✅ Dashboard với 4 thống kê (Sách, Độc Giả, Mượn, Thể Loại)
- ✅ Badge "Admin" cạnh tên người dùng

---

## 🔧 Thay Đổi Mật Khẩu Admin

### Cách 1: Qua Artisan Tinker (Dễ nhất)

```bash
php artisan tinker
```

Sau đó copy dòng này vào Tinker:

```php
$user = User::where('email', 'admin@email.com')->first();
$user->password = Hash::make('mật_khẩu_mới');
$user->save();
// Kết quả: true
```

Ví dụ: Thay đổi mật khẩu thành `admin@2026`:
```php
$user = User::where('email', 'admin@email.com')->first();
$user->password = Hash::make('admin@2026');
$user->save();
exit()
```

### Cách 2: Qua phpmyadmin

1. Mở phpmyadmin
2. Chọn database `library_management` (hoặc tên database của bạn)
3. Chọn bảng `users`
4. Tìm dòng có `email = 'admin@email.com'`
5. Nhấn "Edit"
6. Cập nhật cột `password`:
   ```
   $2y$12$....... (hash bcrypt)
   ```
   Tạo hash từ: [Online Hash Generator](https://www.php-hash-generator.com/) → Chọn bcrypt
   
⚠️ **Lưu ý**: Hãy dùng bcrypt (cost=12) hoặc dùng Tinker (dễ hơn)

---

## 📝 Thay Đổi Thông Tin Admin

### Thay Đổi Tên Admin

**Cách 1: Qua Tinker**
```bash
php artisan tinker
```

```php
$user = User::where('email', 'admin@email.com')->first();
$user->name = 'Tên Admin Mới';
$user->save();
exit()
```

**Cách 2: Qua Profile (Dashboard)**
1. Đăng nhập với tài khoản admin
2. Click vào dropdown (Tên Admin) → "Thông tin cá nhân"
3. Sửa tên, email, username
4. Nhấn "Cập nhật"

### Thay Đổi Email Admin

```bash
php artisan tinker
```

```php
$user = User::where('email', 'admin@email.com')->first();
$user->email = 'admin_moi@email.com';
$user->save();
exit()
```

---

## 🔐 Bảo Mật

### ⚠️ QUAN TRỌNG: Không Lưu Mật Khẩu Plain Text

❌ **SAI - Không làm vậy:**
```php
User::create([
    'password' => 'admin123',  // Nguy hiểm! Chưa mã hóa
]);
```

✅ **ĐÚNG - Phải dùng Hash:**
```php
User::create([
    'password' => Hash::make('admin123'),  // An toàn! Được mã hóa
]);
```

### Hàm Hash Sử Dụng
```php
use Illuminate\Support\Facades\Hash;

// Mã hóa mật khẩu
$hashed = Hash::make('admin123');

// Kiểm tra mật khẩu
Hash::check('admin123', $hashed);  // true

// Kiểm tra nếu cần hash lại
Hash::needsRehash($hashed);  // false (nếu bcrypt cost=12)
```

---

## 🆘 Nếu Quên Mật Khẩu Admin

### Cách 1: Reset Qua Seeder (Mất dữ liệu tối thiểu)

```bash
# Xóa toàn bộ dữ liệu và chạy seeder lại
php artisan migrate:fresh --seed
```

⚠️ **Cảnh báo**: Điều này sẽ xóa tất cả dữ liệu trong database!

### Cách 2: Reset Chỉ Mật Khẩu (Giữ dữ liệu)

**Qua Tinker:**
```bash
php artisan tinker
```

```php
User::where('email', 'admin@email.com')->update([
    'password' => Hash::make('admin123')
]);
exit()
```

### Cách 3: Tạo Admin Mới (Nếu sai)

```bash
php artisan tinker
```

```php
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin Mới',
    'email' => 'admin_new@email.com',
    'username' => 'admin_new',
    'password' => Hash::make('password123'),
    'role' => 'admin'
]);
exit()
```

---

## 📊 Kiểm Tra Tài Khoản Admin

### Xem Tất Cả Admin

```bash
php artisan tinker
User::where('role', 'admin')->get()
```

**Kết quả:**
```
=> Illuminate\Database\Eloquent\Collection {#3
     all: [
       App\Models\User {#4
         id: 1,
         name: "Admin Quản Trị",
         email: "admin@example.com",
         role: "admin",
         ...
       },
     ],
   }
```

### Xem Chi Tiết Một Admin

```bash
php artisan tinker
User::where('email', 'admin@email.com')->first()
```

### Xem Tất Cả User (Cả Admin lẫn User thường)

```bash
php artisan tinker
User::all()
```

---

## 📚 Các File Liên Quan

| File | Nội Dung | Vị Trí |
|------|----------|--------|
| **DatabaseSeeder.php** | Tạo Admin account | `database/seeders/DatabaseSeeder.php` |
| **UserFactory.php** | Tạo User mẫu | `database/factories/UserFactory.php` |
| **User.php** | Model User | `app/Models/User.php` |
| **CheckAdmin.php** | Middleware kiểm tra admin | `app/Http/Middleware/CheckAdmin.php` |
| **web.php** | Routes admin | `routes/web.php` |

---

## 🎯 Tóm Tắt Nhanh

| Thông Tin | Chi Tiết |
|-----------|----------|
| **Email** | admin@email.com |
| **Username** | admin |
| **Mật khẩu** | admin123 |
| **Vai trò** | admin |
| **Được tạo từ** | database/seeders/DatabaseSeeder.php |
| **Hàm tạo** | Hash::make('admin123') |
| **Middleware bảo vệ** | CheckAdmin (app/Http/Middleware/CheckAdmin.php) |
| **Quyền hạn** | Quản lý sách, độc giả, thể loại, mượn trả |

---

**Lần cập nhật cuối**: 18 Tháng 4, 2026
