@extends('layouts.app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>@lang('order.confirmation')</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!--================Order Details Area =================-->
<section class="order_details section_gap">
    <div class="container">
        <div class="row order_d_inner">
            <div class="col-lg-4">
                <div class="details_item">
                    <h4>
                        @lang('Order Info') 
                        @if ( $order->status === App\Enums\OrderStatus::Pending )
                            <button class="genric-btn success-border circle small">@lang('orders.pending')</button>
                        @elseif ( $order->status === App\Enums\OrderStatus::Accepted )
                            <button class="genric-btn primary-border circle small">@lang('orders.accepted')</button>
                        @else
                            <button class="genric-btn danger-border circle small">@lang('orders.rejected')</button>
                        @endif
                    </h4>
                    <ul class="list">
                        <li><a href="#"><span>@lang('orders.number')</span> : {{ $order->slug }}</a></li>
                        <li><a href="#"><span>@lang('orders.date')</span> :
                                {{ Carbon\Carbon::parse($order->startdate)->format('d-m-Y') }}</a></li>
                        <li><a href="#"><span>@lang('orders.duedate')</span> :
                                @if(!empty($order->duedate))
                                {{ Carbon\Carbon::parse($order->duedate)->format('d-m-Y') }}</a></li>
                        @else
                            @lang('Pending Order')
                        @endif
                        <li><a href="#"><span>@lang('orders.totalprice')</span> : {{ $order->order_total }}</a></li>
                        <li><a href="#"><span>@lang('orders.shipadr')</span> : {{ $order->owner->address }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="order_details_table">
            <h2>@lang('orders.details')</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">@lang('orders.product_col_head')</th>
                            <th scope="col">@lang('orders.quantity_col_head')</th>
                            <th scope="col">@lang('orders.total_each_col')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $product)
                        <tr>
                            <td>
                                <p>{{ $product->name }}</p>
                            </td>
                            <td>
                                <h5>{{ $product->pivot->quantity}}</h5>
                            </td>
                            <td>
                                <p>{{ $product->pivot->quantity*$product->price }}</p>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>@lang('orders.subtotal')</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{$order->order_total}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@endsection
