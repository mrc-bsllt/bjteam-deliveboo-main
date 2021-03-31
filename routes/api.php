<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace("Api")->group(function (){
  //tutte i ristoranti in base alla categoria
  Route::get('restaurants/{categoryParam}', 'RestaurantController@getRestaurantsByCategory');

  //tutte le categorie
  Route::get('categories', 'RestaurantController@getCategories');

  //ristoranti da mostrare in homepage
  Route::get('restaurants', 'RestaurantController@getRestaurants');

  //menu ristorante da mostrare in show
  Route::get('restaurant/{slug}', 'RestaurantController@getRestaurantMenu');

  //ritorna tutti gli ordini del ristorante loggato
  Route::get('restaurant/{slug}/orders', 'RestaurantController@getOrders');

  //ricerca ristorante per nome
  Route::get('restaurant/search/{string}', 'RestaurantController@getSearchedRestaurant');

});
