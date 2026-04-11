<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Văn Học', 'description' => 'Sách văn học']);
        \App\Models\Category::create(['name' => 'Khoa Học', 'description' => 'Sách khoa học']);
        \App\Models\Category::create(['name' => 'Hành Động', 'description' => 'Sách hành động']);
        \App\Models\Category::create(['name' => 'Tình Cảm', 'description' => 'Sách tình cảm']);
        \App\Models\Category::create(['name' => 'Trinh Thám', 'description' => 'Sách trinh thám']);
        \App\Models\Category::create(['name' => 'Kinh Dị', 'description' => 'Sách kinh dị']);
        \App\Models\Category::create(['name' => 'Tâm Lý', 'description' => 'Sách tâm lý']);
    }
}
