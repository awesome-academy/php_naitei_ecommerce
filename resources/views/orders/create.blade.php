@extends('layouts.app')

@section('title', 'Checkout Order')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>@lang('header.checkout')</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">@lang('header.home')<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">@lang('header.checkout')</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--================Checkout Area =================-->
@if (Session::has('cart'))
<section class="checkout_area">
    <div class="container">
        <div class="cupon_area">
            <div class="check_title">
                <h2>@lang('Have a coupon? ')<a href="#">@lang('Click here to enter your code')</a></h2>
            </div>
            <input type="text" placeholder="Enter coupon code">
            <a class="tp_btn" href="#">@lang('Apply Coupon')</a>
        </div>
        <section class="order_details section_gap">
            {!! Form::open(['method' => 'POST', 'route' => ['order.store']]) !!}
            <div class="container">
                <div class="order_details_table">
                    <h2>Order Details</h2>
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <p>{{ $product['item']['name'] }}</p>
                                            {!! Form::hidden('products_ids[]', $product['item']['id']) !!}
                                        </td>
                                        <td>
                                            <h5>{{ $product['quantity'] }} @lang('Items')</h5>
                                            {!! Form::hidden('products_quantities[]', $product['quantity']) !!}
                                        </td>
                                        <td>
                                            <p>${{ $product['price'] }}</p>
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
                                        <p>${{ $totalPrice }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row order_details_table">
                    <div class="col-lg-4">
                        <div class="details_item">
                            <h4>@lang('Order Info')</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">
                                        <span>@lang('orders.number')</span> : {{ $slug }}
                                    </a>
                                </li>
                                {!! Form::hidden('slug', $slug) !!}
                                <li>
                                    <a href="#"><span>@lang('orders.date')</span> :{{ $today }}
                                    </a>
                                </li>
                                {!! Form::hidden('startday', $today) !!}
                                <li>
                                    <a href="#">
                                        <span>@lang('orders.totalprice')</span> : ${{ $totalPrice }}
                                    </a>
                                </li>
                                {!! Form::hidden('order_total', $totalPrice) !!}
                                <li>
                                    <a href="#">
                                        <span>@lang('orders.shipadr')</span> : {{ Auth::user()->address }}
                                    </a>
                                </li>
                                {!! Form::hidden('address', Auth::user()->address) !!}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="details_item">
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector">
                                    <label for="f-option5">@lang('Check payments')</label>
                                    <div class="check"></div>
                                </div>
                                <p>@lang('Please send a check to Store Name, Store Street, Store Town, Store State /
                                    County,
                                    Store Postcode.')</p>
                            </div>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector">
                                    <label for="f-option6">@lang('Paypal ')</label>
                                    <img src="{{ asset('img/product/card.jpg') }}" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>@lang('Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.')</p>
                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                                {!! Form::submit(trans('orders.proceed'), ['class' => 'primary-btn']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
</section>
@else
<section class="cart_area cart_empty">
    <div class="container">
        <div class="cart_inner">
            <div class="alert alert-danger alert_font" role="alert">
                @lang('content.no_item_in_cart')
            </div>
            <div class="d-flex align-items-center">
                <a class="primary-btn go_back" href="{{ route('root') }}">@lang('content.continue_shopping') <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
