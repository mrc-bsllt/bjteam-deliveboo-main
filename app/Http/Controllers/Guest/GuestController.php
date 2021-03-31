<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class GuestController extends Controller
{
  public function homePage() {

    $categories = Category::all();

    return view("guests.homepage", compact("categories"));
  }

  public function menuRestaurant() {

    return view("guests.menu-restaurant");
    
  }

  public function success(){
    return view('guests.success');
  }

}
