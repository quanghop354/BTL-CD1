<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',              // Tên người dùng
        'email',             // Email đăng nhập
        'username',          // Tên đăng nhập
        'password',          // Mật khẩu (được mã hóa)
        'google_id',         // ID từ đăng nhập Google
        'role',              // Vai trò: 'admin' hoặc 'user'
        'avatar',            // Ảnh đại diện
        'phone',             // Số điện thoại
    ];

    /**
     * Các thuộc tính không nên được trả về khi serialize (chuyển đổi thành JSON)
     * Mật khẩu và token nhớ không được gửi lại phía client


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',          // Mật khẩu luôn được ẩn
        'remember_token',    // Token nhớ đăng nhập được ẩn
    ];

    /**
     * Chuyển đổi kiểu dữ liệu cho các cột trong cơ sở dữ liệu
     * email_verified_at sẽ được chuyển thành Carbon DateTime
     * password sẽ tự động được mã hóa/giải mã khi lưu/lấy
     *
     * @return array<string, string> Các cột và kiểu dữ liệu cần chuyển đổi


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Chuyển thành đối tượng DateTime
            'password' => 'hashed',             // Tự động mã hóa khi set, so sánh khi check
        ];
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Kiểm tra xem người dùng hiện tại có phải là Admin (Quản Trị Viên) không
     * 
     * Sử dụng: if ($user->isAdmin()) { ... }
     *
     * @return bool true nếu vai trò là 'admin', ngược lại false
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Kiểm tra xem người dùng hiện tại có phải là User (Độc Giả Thường) không
     * 
     * Sử dụng: if ($user->isUser()) { ... }
     *
     * @return bool true nếu vai trò là 'user', ngược lại false
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
