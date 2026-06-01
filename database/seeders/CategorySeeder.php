<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        for ($i = 0; $i < 20; $i++) {
            Category::create(
                            [
                            'title' => "Category $i",
                            'slug' => "category-$i"
                            ]
                        );
        }
        */
        Category::factory(10)->create();
    }
}
