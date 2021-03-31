<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    public function index()
    {
        $restaurant = Auth::user()->restaurant;

        $allOrders = Order::orderBy('created_at', 'desc')->get();
        $orders = [];

        foreach ($allOrders as $order) {
          foreach ($order->products as $product) {

            if ($product->restaurant_id === Auth::user()->restaurant->id && !in_array($order, $orders)) {
              $orders[] = $order;

            }
          }
        }

        return view('admin.restaurants.orders.index', compact('orders', 'restaurant'));
    }

    // Funzione per vista statistiche ordini
    public function chart()
    {
        $restaurant = Auth::user()->restaurant;
        $allOrders = Order::all();

        $orders = [];

        foreach ($allOrders as $order) {
          foreach ($order->products as $product) {

            if ($product->restaurant_id === Auth::user()->restaurant->id && !in_array($order, $orders)) {
              $orders[] = $order;

            }
          }
        }

        return view('admin.restaurants.orders.chart', compact('orders', 'restaurant'));

    }

    public function storeOrder(Request $request)  {
      $order = $request->all();

      return redirect()->route('payment')->with(['order'=> $order]);
    }

}
