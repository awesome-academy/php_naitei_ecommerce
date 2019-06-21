<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HandleOrderRequest;
use App\User;
use App\Order;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;
use App\Enums\OrderStatus;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.orders.index');
    }

    public function getdata()
    {
        $orders = Order::select('id','slug', 'address', 'order_total','startday', 'note', 'status', 'user_id')->orderby('status');
        return Datatables::of($orders)
            ->addColumn('user_name', function($order){
                return $order->owner->name;
            })
            ->addColumn('action', function($order){
                return $order->status === OrderStatus::Pending? 
                    '<a href="javascript:void(0)" class="genric-btn success accept_order" id="'.$order->id.'">
                        <i class="fas fa-check-square"></i> '.trans('content.accept').'
                    </a>
                    &nbsp;<a href="javascript:void(0)" class="genric-btn danger reject_order" id="'.$order->id.'">
                        <i class="fas fa-window-close"></i> '.trans('content.reject').
                    '</a>' : NULL;
            })
            ->editColumn('status', function ($order) {
                if ($order->status === OrderStatus::Pending)
                    return '<a class="genric-btn success small"><i class="far fa-hourglass"></i> '.trans('orders.pending').'</a>';
                elseif ($order->status === OrderStatus::Accepted)
                    return '<a class="genric-btn primary small"><i class="fas fa-check-square"></i> '.trans('orders.accepted').'</a>';
                else 
                    return '<a class="genric-btn danger small"><i class="fas fa-window-close"></i> '.trans('orders.rejected').'</a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function handle(Order $order, HandleOrderRequest $request)
    {
        $order = Order::find($request->get('id'));
        $order->status = $request->get('handlestatus');
        $result = OrderStatus::getKey((int) $order->status);
        $order->save();
        Mail::to($order->owner->email)->send(new OrderEmail($order));
        return response()->json([ 'alert' => trans('orders.handled').' : '.$result]);
    }
}
