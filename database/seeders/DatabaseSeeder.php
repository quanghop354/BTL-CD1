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
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Người Dùng Mẫu',
            'email' => 'test@example.com',
        ]);

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
