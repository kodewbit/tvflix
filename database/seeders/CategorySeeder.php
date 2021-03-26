<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Category $categoryModel
     * @return void
     */
    public function run(Category $categoryModel)
    {
        $categories = config('default.categories');

        foreach ($categories as $category) {
            $categoryModel->create($category);
        }
    }
}
