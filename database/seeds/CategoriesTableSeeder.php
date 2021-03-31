<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $categories = config('categories');

       foreach ($categories as $category) {

            $newCategory = new Category();
            $newCategory->fill($category)->save();
            
       }

    }
}
