<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Pemrograman',
            'Database',
            'Jaringan',
            'Artificial Intelligence',
            'Bisnis'
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category,
                'slug' => str($category)->slug()
            ]);
        }
    }
}
