<?php

use Illuminate\Database\Seeder;
use FakerRestaurant\Restaurant;
use Illuminate\Support\Str;
use App\Product;
use App\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = User::all();

      $products = config('products');
      $productOrderArray = config('product_order');

       foreach ($users as $user) {
          foreach ($products as $product) {

            if ($user->restaurant->id === $product["restaurant_id"]) {

              $newProduct = new Product();
              $newProduct->fill($product)->save();

              foreach ($productOrderArray as $relation) {
                
                if ($relation["product_id"] === $newProduct->id) {

                  $newProduct->orders()->attach([$relation["order_id"]]);
                }
              }

            }
          }
       }
    }
}
