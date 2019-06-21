<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutFormRequest;
use App\Models\Cart;
use App\Order;
use Carbon\Carbon;
use Session;
use Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = Session::get('cart');
        $slug = uniqid();
        $today = Carbon::now()->toDateString();
        return view('orders.create', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'slug' => $slug,
            'today' => $today
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutFormRequest $request)
    {
        $order = Order::create([
            'address' => $request->address,
            'slug' => $request->slug,
            'startday' => Carbon::now()->toDateString(),
            'order_total' => $request->order_total,
            'user_id' => $request->user_id
        ]);
        for($i = 0; $i < sizeof($request->products_ids); $i++){
            $order->products()->attach($request->products_ids[$i]);
            $product_quantity = $request->products_quantities[$i];
            $order->products()
                ->updateExistingPivot($request->products_ids[$i], [ 
                    'quantity' => $product_quantity 
            ]);
        }
        Session::forget('cart');
        return redirect()->route('order.show', [$order])->with('status', trans('orders.created').''.$request->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $order = Order::whereSlug($slug)->first();
        if(Auth::user()->id == $order->user_id)
            return view('orders.show', compact('order'));
        else return redirect('/')->with('status', trans('orders.invalid_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
