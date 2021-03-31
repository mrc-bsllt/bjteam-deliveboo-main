<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{

    protected $productValidation = [
        'name' => 'required:max:60',
        'image' => 'image|required',
        'description' => 'required',
        'price' => 'required|numeric|min:1',
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Auth::user()->restaurant->products;
        $restaurant = Auth::user()->restaurant;
        $products = Product::where('restaurant_id', Auth::user()->restaurant->id)->orderBy('name', 'asc')->get();


        return view('admin.restaurants.products.index', compact('products', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = Auth::user()->restaurant;
        return view('admin.restaurants.products.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate($this->productValidation);

        $data['restaurant_id'] = Auth::user()->restaurant->id;
        $data['slug'] = Str::slug($data['name']);
        $data["image"] = Storage::disk('public')->put('images', $data["image"]);
        $data["image"] = Storage::url($data['image']);
        $product = new Product();
        $product->fill($data);
        $product->save();

        return redirect()->route('admin.restaurants.products.index')
            ->with('message', 'Il prodotto "' . $product->name . '" è stato creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Auth::user()->restaurant;
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('admin.restaurants.products.show', compact('product', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Auth::user()->restaurant;
        $product = Product::findOrFail($id);
        return view('admin.restaurants.products.edit', compact('product', 'restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $data = $request->all();

        $this->productValidation["image"] = "nullable";

        $request->validate($this->productValidation);
        if(!empty($data["image"])){
           Storage::disk('public')->delete($product->image);
           $data["image"] = Storage::disk('public')->put('images', $data["image"]);
        } else {
          $data["image"] = $product->image;
        }


        $data['restaurant_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name']);
        $product->update($data);

        /**
         * CAMBIARE MESSAGGIO AL UPDATE
         */

        return redirect()->route('admin.restaurants.products.index')->with('message', 'Il prodotto "' . $product->name . '" è stato modificato correttamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        /**
         * CAMBIARE MESSAGGIO AL DELETE
         */

        return redirect()->route('admin.restaurants.products.index')->with('message', 'Il prodotto "' . $product->name . '" è stato eliminato correttamente');
    }
}
