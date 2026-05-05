<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
<<<<<<< HEAD
 * @extends Factory<User>
=======
<<<<<<< HEAD
 * @extends Factory<User>
=======
<<<<<<< HEAD
<<<<<<< HEAD
 * Factory Người Dùng - Tạo dữ liệu người dùng mẫu
 * 
 * Dùng để tạo các tài khoản người dùng ngẫu nhiên cho testing
 * Tất cả tài khoản được tạo từ factory có vai trò 'user' (mặc định)
 * 
 * @extends Factory<User>
 * @package Database\Factories
=======
 * @extends Factory<User>
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
 * @extends Factory<User>
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
 */
class UserFactory extends Factory
{
    /**
<<<<<<< HEAD
     * The current password being used by the factory.
=======
<<<<<<< HEAD
     * The current password being used by the factory.
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * Mật khẩu hiện tại đang được sử dụng bởi factory
     * Được share giữa tất cả các người dùng được tạo
     * 
     * @var string|null
=======
     * The current password being used by the factory.
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
     * The current password being used by the factory.
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     */
    protected static ?string $password;

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        ];
    }

    /**
<<<<<<< HEAD
     * Indicate that the model's email address should be unverified.
=======
<<<<<<< HEAD
     * Indicate that the model's email address should be unverified.
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * Chỉ định rằng email của người dùng chưa được xác thực
     * 
     * Sử dụng: User::factory()->unverified()->create()
     *
     * @return static
=======
     * Indicate that the model's email address should be unverified.
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
     * Indicate that the model's email address should be unverified.
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
<<<<<<< HEAD
            'email_verified_at' => null,
=======
<<<<<<< HEAD
            'email_verified_at' => null,
=======
<<<<<<< HEAD
<<<<<<< HEAD
            'email_verified_at' => null,  // Đặt email_verified_at thành null (chưa xác thực)
=======
            'email_verified_at' => null,
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
            'email_verified_at' => null,
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        ]);
    }
}
