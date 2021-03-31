<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $restaurants = config('restaurants');

      $restaurantCategoryArray = config('restaurant_category');


      foreach ($restaurants as $restaurant) {
        $newRestaurant = new Restaurant();
        $newRestaurant->fill($restaurant)->save();

        foreach ($restaurantCategoryArray as $relation) {
          if ($relation["restaurant_id"] === $newRestaurant->id) {

            $newRestaurant->categories()->attach([$relation["category_id"]]);
          }
        }

      }

    }
}
