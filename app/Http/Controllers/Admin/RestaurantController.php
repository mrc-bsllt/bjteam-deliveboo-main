<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Category;
use Illuminate\Support\Facades\Storage;



class RestaurantController extends Controller
{
    private $restaurantValidation = [
        'logo' => 'required|image', //da modificare a nullable (con immagine default)
        'image_hero' => 'required|image',
        'name' => 'required|max:100',
        'phone' => 'required|max:20',
        'address' => 'required',
        'p_iva' => 'required|max:11',
    ];

    //Ritorna il form per registrazione ristorante
    public function create() {
        $categories = Category::all();
        return view('admin.restaurants.create',compact('categories'));

    }

    //Creazione e salvataggio nuovo ristorante
    public function store(Request $request) {

        $data = $request->all();

        $request->validate($this->restaurantValidation);

        $newRestaurant = new Restaurant();

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name']);
        $data["logo"] = Storage::disk('public')->put('images', $data["logo"]);
        $data["logo"] = Storage::url($data['logo']);
        $data["image_hero"] = Storage::disk('public')->put('images', $data["image_hero"]);
        $data["image_hero"] = Storage::url($data['image_hero']);


        $newRestaurant->fill($data);

        $newRestaurant->save();

        $newRestaurant->categories()->attach($data["categories"]);

        return redirect()->route('admin.restaurants.dashboard');
    }

    //Modifica informazioni del ristorante
    public function update(Request $request, $id) {

      $data = $request->all();

      $this->productValidation["image"] = "nullable";

      $request->validate($this->productValidation);

      $restaurant = Restaurant::findOrFail($id);

      if(!empty($data["logo"])){
         Storage::disk('public')->delete($restaurant->logo);
         $data["logo"] = Storage::disk('public')->put('images', $data["logo"]);
         $data["logo"] = Storage::url($data['logo']);
      }

      if(!empty($data["image_hero"])){
         Storage::disk('public')->delete($restaurant->image_hero);
         $data["image_hero"] = Storage::disk('public')->put('images', $data["image_hero"]);
         $data["image_hero"] = Storage::url($data['image_hero']);
      }

      //$data['restaurant_id'] = Auth::id();
      //$data['slug'] = Str::slug($data['name']);
      $restaurant->update($data);

      /**
       * CAMBIARE MESSAGGIO AL UPDATE
       */

      return redirect()->route('admin.restaurants.dashboard');
    }

}
