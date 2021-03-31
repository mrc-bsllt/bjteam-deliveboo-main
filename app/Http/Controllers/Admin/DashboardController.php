<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use App\Order;



class DashboardController extends Controller
{

    public function index() {

        $restaurant = Auth::user()->restaurant;


        $allOrders = Order::all();
        $orders = [];
        $totalEarnings = 0;

        foreach ($allOrders as $order) {
          foreach ($order->products as $product) {

            if ($product->restaurant_id === Auth::user()->restaurant->id && !in_array($order, $orders)) {
              $orders[] = $order;

            }
          }
        }

        //prendo i guadagni totali
        foreach ($orders as $order) {
          $totalEarnings += $order["total_price"];
        }

        return view('admin.restaurants.dashboard', compact('restaurant', 'orders', 'totalEarnings'));
    }

    //cambiare il logo del ristorante
    // public function changeLogo(Request $request, $id) {
    //   $data = $request->all();
    //
    //   //prendo il ristorante corrispondente all'utente loggato
    //   $restaurant = Restaurant::where("user_id", $id)->firstOrFail();
    //
    //   // rimuovo la vecchia immagine del logo
    //   Storage::disk('public')->delete($restaurant->logo);
    //
    //   // aggiorno l'immagine del logo del ristorante
    //   $data["logo"] = Storage::disk("public")->put("images", $data["logo"]);
    //   $restaurant->update($data);
    //
    //   return redirect()->route("admin.restaurants.dashboard");
    // }
}
