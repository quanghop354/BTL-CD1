<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Chạy seeder để tạo dữ liệu mẫu vào database
     */
    public function run(): void
    {
        /**
         * ========================================
         * TẠO TÀI KHOẢN ADMIN
         * ========================================
         * 
         * Email:    admin@example.com
         * Mật khẩu: admin123 (được mã hóa bằng Hash::make())
         * Vai trò:  admin
         * 
         * QUAN TRỌNG: Mật khẩu PHẢI được mã hóa bằng Hash::make()
         * để tránh lưu mật khẩu dưới dạng plain text (nguy hiểm)
         */
        User::create([
            'name' => 'Admin Quản Trị',                      // Tên quản trị viên
            'email' => 'admin@example.com',                  // Email đăng nhập
            'username' => 'admin',                           // Tên đăng nhập
            'password' => Hash::make('admin123'),            // Mật khẩu được mã hóa (QUAN TRỌNG!)
            'role' => 'admin',                               // Vai trò admin
        ]);

        /**
         * ========================================
         * TẠO TÀI KHOẢN USER THƯỜNG
         * ========================================
         * 
         * Tạo tài khoản người dùng thường dùng Factory
         * Email:    test@example.com
         * Vai trò:  user (mặc định)
         */
        User::factory()->create([
            'name' => 'Người Dùng Mẫu',                      // Tên người dùng
            'email' => 'test@example.com',                   // Email đăng nhập
            'username' => 'testuser',                        // Tên đăng nhập
        ]);

        /**
         * ========================================
         * TẠO DANH SÁCH THỂ LOẠI
         * ========================================
         */


        $this->call(CategorySeeder::class);

        $book1 = Book::create([
            'name' => 'Sách Mẫu 1',
            'slug' => 'sach-mau-1',
            'author' => 'Tác Giả 1',
            'price' => 10000,
            'description' => 'Một cuốn sách mẫu',
            'status' => 'available',
        ]);
        $book1->categories()->attach([1, 3]); // Văn Học và Hành Động

        $book2 = Book::create([
            'name' => 'Sách Mẫu 2',
            'slug' => 'sach-mau-2',
            'author' => 'Tác Giả 2',
            'price' => 15000,
            'description' => 'Một cuốn sách mẫu khác',
            'status' => 'available',
        ]);
        $book2->categories()->attach([2, 4]); // Khoa Học và Tình Cảm
    }
}
