<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(config('setting.per_page'));

        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $blob = $product->image;
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $item_quantity = config('setting.zero_value');

        if ($cart)
        {
            $item_quantity = array_key_exists($product->id, $cart->items) ? $cart->items[$product->id]['quantity'] : config('setting.zero_value');
        }

        return view('products.show', compact('product','blob', 'item_quantity'));
    }

    public function edit($slug)
    {
        //
    }
}
