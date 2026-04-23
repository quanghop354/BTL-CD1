<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory Người Dùng - Tạo dữ liệu người dùng mẫu
 * 
 * Dùng để tạo các tài khoản người dùng ngẫu nhiên cho testing
 * Tất cả tài khoản được tạo từ factory có vai trò 'user' (mặc định)
 * 
 * @extends Factory<User>
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * Mật khẩu hiện tại đang được sử dụng bởi factory
     * Được share giữa tất cả các người dùng được tạo
     * 
     * @var string|null
     */
    protected static ?string $password;

    /**
     * Định nghĩa trạng thái mặc định của model User
     * 
     * Tạo dữ liệu ngẫu nhiên cho:
     * - Tên: Tên ngẫu nhiên từ faker
     * - Email: Email ngẫu nhiên + unique
     * - Username: Tên đăng nhập từ email (trước dấu @)
     * - Email_verified_at: Thời gian hiện tại (xác thực sẵn)
     * - Password: 'password' (được mã hóa)
     * - Role: 'user' (vai trò mặc định)
     *
     * @return array<string, mixed> Mảng dữ liệu người dùng
     */
    public function definition(): array
    {
        // Tạo email ngẫu nhiên
        $email = fake()->unique()->safeEmail();
        
        return [
            'name' => fake()->name(),                           // Tên ngẫu nhiên (vd: John Doe)
            'email' => $email,                                  // Email ngẫu nhiên
            'username' => explode('@', $email)[0],              // Username từ phần trước @ của email
            'email_verified_at' => now(),                       // Đã xác thực email
            'password' => static::$password ??= Hash::make('password'), // Mật khẩu được mã hóa: 'password'
            'remember_token' => Str::random(10),                // Token nhớ đăng nhập (10 ký tự ngẫu nhiên)
            'role' => 'user',                                   // Vai trò mặc định là 'user'
        ];
    }

    /**
     * Chỉ định rằng email của người dùng chưa được xác thực
     * 
     * Sử dụng: User::factory()->unverified()->create()
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,  // Đặt email_verified_at thành null (chưa xác thực)
        ]);
    }
}
