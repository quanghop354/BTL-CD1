# Hệ Thống Kiểm Soát Truy Cập Dựa Trên Vai Trò (RBAC)

## Tổng Quan

Hệ thống quản lý thư viện hiện có hai vai trò chính: **Admin** và **User** (Độc Giả). Cả hai vai trò đều có thể đăng nhập qua cùng một giao diện, nhưng chúng có quyền truy cập và chức năng khác nhau.

## Vai Trò Và Quyền Hạn

### 1. **User (Độc Giả)**
Đây là vai trò mặc định cho các tài khoản mới được tạo thông qua đăng ký hoặc Google Login.

**Quyền Hạn:**
- ✅ Xem danh sách sách
- ✅ Xem chi tiết sách riêng lẻ
- ✅ Tạo yêu cầu mượn sách
- ✅ Xem danh sách mượn của mình
- ✅ Xem chi tiết mượn riêng lẻ
- ✅ Cập nhật thông tin cá nhân
- ✅ Xem bảng điều khiển (Dashboard) với thống kê cơ bản

**Không Có Quyền:**
- ❌ Tạo, chỉnh sửa, xóa sách
- ❌ Tạo, chỉnh sửa, xóa thể loại
- ❌ Tạo, chỉnh sửa, xóa độc giả
- ❌ Quản lý mượn trả
- ❌ Xem thống kê toàn hệ thống

### 2. **Admin (Quản Trị Viên)**
Vai trò này được gán cho các quản trị viên hệ thống.

**Quyền Hạn:**
- ✅ Thực hiện tất cả quyền của User
- ✅ Tạo, chỉnh sửa, xóa sách
- ✅ Khôi phục sách đã xóa (soft delete)
- ✅ Xóa vĩnh viễn sách
- ✅ Tạo, chỉnh sửa, xóa thể loại
- ✅ Tạo, chỉnh sửa, xóa độc giả
- ✅ Quản lý mượn trả (xác nhận trả sách)
- ✅ Xem bảng điều khiển (Dashboard) với thống kê đầy đủ
- ✅ Xem menu Quản Lý (Độc Giả, Thể Loại) trong thanh điều hướng

## Cấu Trúc Cơ Sở Dữ Liệu

### Bảng Users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    google_id VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    email_verified_at TIMESTAMP,
    remember_token VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Giá Trị Role:**
- `'admin'` - Quản trị viên
- `'user'` - Độc giả bình thường (mặc định)

## Triển Khai Kỹ Thuật

### 1. Model User
File: `app/Models/User.php`

Các phương thức trợ giúp:
```php
// Kiểm tra xem người dùng có phải admin không
$user->isAdmin(); // true/false

// Kiểm tra xem người dùng có phải user thường không
$user->isUser(); // true/false
```

### 2. Middleware - CheckAdmin
File: `app/Http/Middleware/CheckAdmin.php`

Middleware này kiểm tra xem người dùng hiện tại có vai trò 'admin' không. Nếu không, nó sẽ trả về lỗi 403 (Forbidden).

```php
if (!auth()->check() || auth()->user()->role !== 'admin') {
    abort(403, 'Bạn không có quyền truy cập trang này.');
}
```

**Đăng ký Middleware:**
File: `bootstrap/app.php`

```php
$middleware->alias([
    'admin' => \App\Http\Middleware\CheckAdmin::class,
]);
```

### 3. Định Tuyến (Routes)
File: `routes/web.php`

```php
// Các tuyến dành cho tất cả người dùng đã xác thực
Route::middleware('auth')->group(function () {
    // Đây là tuyến dành cho admin ONLY
    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('readers', ReaderController::class);
        // ...
    });
});
```

### 4. Kiểm Soát Trong Controllers
File: `app/Http/Controllers/CategoryController.php`

Các phương thức quản lý thêm kiểm tra bổ sung:

```php
public function create()
{
    if (!auth()->user()->isAdmin()) {
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }
    return view('categories.create');
}
```

### 5. Giao Diện Người Dùng
File: `resources/views/layouts/master.blade.php`

Navigation được hiển thị có điều kiện dựa trên vai trò:

```blade
@if(Auth::user()->isAdmin())
    <li class="nav-item">
        <a class="nav-link" href="{{ route('readers.index') }}">
            <i class="fas fa-users"></i> Độc Giả
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-tags"></i> Thể Loại
        </a>
    </li>
@endif
```

Badge vai trò được hiển thị bên cạnh tên người dùng:

```blade
<span class="badge bg-info ms-1">{{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}</span>
```

### 6. Dashboard Duy Nhất
File: `resources/views/dashboard.blade.php`

Dashboard được hiển thị khác nhau tùy thuộc vào vai trò:

```blade
@if(Auth::user()->isAdmin())
    <!-- Hiển thị thống kê quản trị viên -->
    <!-- Tổng số độc giả, tổng số mượn, v.v. -->
@endif
```

## Quy Trình Xác Thực

### Đăng Nhập Thông Thường
1. Người dùng điền email/tên người dùng và mật khẩu
2. Hệ thống xác thực thông tin đăng nhập
3. Người dùng được đăng nhập với vai trò được lưu trong CSDL
4. Được chuyển hướng đến Dashboard

### Đăng Nhập Google
1. Người dùng nhấp vào "Đăng Nhập bằng Google"
2. Google xác thực danh tính
3. Nếu người dùng tồn tại → Đăng nhập với vai trò hiện tại
4. Nếu người dùng không tồn tại → Tạo tài khoản mới với vai trò **'user'** (mặc định)
5. Được chuyển hướng đến Dashboard

## Cách Thay Đổi Vai Trò Người Dùng

### Cách 1: Qua Cơ Sở Dữ Liệu
Sử dụng phần mềm quản lý CSDL (phpmyadmin, DBeaver, v.v.):

```sql
UPDATE users SET role = 'admin' WHERE id = 1;
```

### Cách 2: Qua Artisan Tinker (CLI)
```bash
php artisan tinker
```

```php
$user = User::find(1);
$user->role = 'admin';
$user->save();
```

### Cách 3: Tạo Seeder Hoặc Migration
Bạn có thể tạo một migration hoặc seeder để tạo người dùng admin:

```bash
php artisan make:seeder AdminSeeder
```

## Hướng Dẫn Bảo Mật

1. **Luôn Kiểm Tra Vai Trò Ở Cả Phía Máy Chủ:** Đừng chỉ dựa vào kiểm tra phía máy khách.
2. **Sử Dụng Middleware:** Middleware là cách tốt nhất để bảo vệ các tuyến đường.
3. **Ghi Nhật Ký Các Hành Động Quản Trị:** Ghi lại tất cả các hành động của admin để kiểm tra.
4. **Mật Khẩu Mạnh:** Yêu cầu mật khẩu mạnh cho tài khoản admin.
5. **Xác Thực Hai Yếu Tố:** Cân nhắc triển khai 2FA cho admin.

## Các Tệp Liên Quan

- `app/Models/User.php` - User Model với các phương thức kiểm tra vai trò
- `app/Http/Middleware/CheckAdmin.php` - Middleware kiểm tra admin
- `app/Http/Controllers/DashboardController.php` - Dashboard với logic dựa trên vai trò
- `resources/views/layouts/master.blade.php` - Navigation với điều kiện vai trò
- `resources/views/dashboard.blade.php` - Dashboard view với điều kiện vai trò
- `routes/web.php` - Định tuyến với middleware admin
- `bootstrap/app.php` - Đăng ký middleware
- `database/migrations/2026_04_18_080740_add_role_to_users_table.php` - Migration tạo cột role

## Mở Rộng Trong Tương Lai

Để thêm những vai trò mới, bạn có thể:

1. **Thêm giá trị mới vào ENUM trong cơ sở dữ liệu:**
   ```php
   $table->enum('role', ['admin', 'user', 'librarian', 'moderator'])->default('user');
   ```

2. **Tạo middleware mới cho vai trò đó:**
   ```php
   class CheckLibrarian { /* ... */ }
   ```

3. **Đăng ký trong `bootstrap/app.php`:**
   ```php
   'librarian' => \App\Http\Middleware\CheckLibrarian::class,
   ```

4. **Sử dụng trong routes:**
   ```php
   Route::middleware('librarian')->group(function () { /* ... */ });
   ```

---

**Ngày Cập Nhật:** 18 Tháng 4, 2026
