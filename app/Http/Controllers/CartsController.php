<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Moddel\Category;
use Session;

class CartsController extends Controller
{    
    public function store(Request $request) 
    {
        try
        {
            $id = $request->id;
            $product = Product::findOrFail($id);
            $stock = $product->quantity;
            $quantity = $request->quantity;
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $item_quantity = config('setting.zero_value');

            if($oldCart)
            {
                $item_quantity = array_key_exists($id, $oldCart->items) ? $oldCart->items[$id]['quantity'] : config('setting.zero_value');
            }
            
            if ($stock - $quantity - $item_quantity < config('setting.zero_value'))
            {
                return response()->json([
                    'message' => trans('content.only').$stock.trans('content.products!'),
                ]);
            }
            else
            {
                $image = $product->images[config('setting.zero_value')];
                $cart = new Cart($oldCart);
                $cart->add($product, $product->id, $quantity);
                $request->session()->put('cart', $cart);
                
                return response()->json([
                    'totalQuantity' => $cart->totalQuantity,
                    'totalPrice' => $cart->totalPrice,
                    'message' => trans('content.added_to_cart'),
                ]);    
            }
        }
        catch (\Exception $e)
        {
            
        }
    }

    public function index()
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('carts.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function update(Request $request)
    {
        try
        {
            $id = $request->id;
            $product = Product::findOrFail($id);
            $new_quantity = $request->quantity;
            $cart = Session::get('cart');
            
            if ($product->quantity - $new_quantity < config('setting.zero_value'))
            {
                return response()->json([
                    'message' => trans('content.not_enough_in_stock'),
                    'new_price' => $cart->items[$id]['price'],
                    'subtotal' => $cart->totalPrice,
                    'new_quantity' => $cart->items[$id]['quantity']
                ]);
            }
            else
            {
                $old_quantity = $cart->items[$id]['quantity'];
                $cart->items[$id]['quantity'] = $new_quantity;
                $cart->items[$id]['price'] = round($cart->items[$id]['quantity'] * $cart->items[$id]['item']['price'],config('setting.two_value'));
                $cart->totalQuantity = $cart->totalQuantity + $cart->items[$id]['quantity'] - $old_quantity;
                $cart->totalPrice = round($cart->totalPrice + ($cart->items[$id]['quantity'] - $old_quantity) * $cart->items[$id]['item']['price'],config('setting.two_value'));
                $request->session()->put('cart', $cart);

                return response()->json([
                    'new_price' => $cart->items[$id]['price'],
                    'totalQuantity' => $cart->totalQuantity,
                    'subtotal' => $cart->totalPrice,
                    'message' => trans('content.product_updated'),
                    'new_quantity' => $cart->items[$id]['quantity']
                ]);
            }
        }
        catch(\Exception $e)
        {

        }
        
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);

        if (count($cart->items) > config('setting.zero_value'))
        {
            Session::put('cart', $cart);

            return response()->json([
                'totalQuantity' => $cart->totalQuantity,
                'totalPrice' => $cart->totalPrice,
                'message' => trans('content.item_deleted'),
            ]);
        }
        else 
        {
            Session::forget('cart', $cart);
            return response()->json([
                'totalQuantity' => null,
                'totalPrice' => null,
                'message' => trans('content.no_item_in_cart'),
            ]);
        }
    }
}
