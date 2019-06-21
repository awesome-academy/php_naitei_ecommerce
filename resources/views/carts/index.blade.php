@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>@lang('content.shopping_cart')</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('root') }}">@lang('header.home')<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('cart.index') }}">@lang('header.cart')</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <!--================Cart Area =================-->
    @if (Session::has('cart'))
    <section class="cart_area current_cart">
            <div class="container">
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('content.product')</th>
                                    <th scope="col">@lang('content.price')</th>
                                    <th scope="col">@lang('content.quantity')</th>
                                    <th scope="col">@lang('content.total')</th>
                                    <th scope="col">@lang('content.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="cart_item{{ $product['item']['id'] }}">
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <a href="{{ route('products.show', ['slug' => $product['item']['slug']]) }}">
                                                        <img class="resize_image" src="{{ asset($product['item']['images'][0]) }}" alt="{{ $product['item']['name'] }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $product['item']['name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>${{ $product['item']['price'] }}</h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="text" id="{{ $product['item']['id'] }}" maxlength="12" value="{{ $product['quantity'] }}" title="{{ trans('content.quantity:') }}"
                                                    min="1" max="{{ $product['quantity'] }}" class="input-text{{ $product['item']['id'] }}">
                                                <button class="increase items-count" id="{{ $product['item']['id'] }}" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                                <button class="reduced items-count" id="{{ $product['item']['id'] }}" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="price{{ $product['item']['id']}}">${{ $product['price'] }}</h5>
                                        </td>
                                        <td>
                                            <div class="rows">
                                            <a href="" class="cart_edit update_quantity" id="{{ $product['item']['id'] }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            &nbsp;
                                            <a href="" class="cart_delete delete_item" id="{{ $product['item']['id'] }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bottom_button">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="cupon_text d-flex align-items-center">
                                            <input type="text" placeholder="Coupon Code">
                                            <a class="primary-btn" href="#">@lang('content.apply') <i class="fas fa-check"></i></a>
                                            &nbsp;&nbsp;
                                            <a class="primary-btn" href="#">@lang('content.cancel') <i class="fas fa-times"></i></a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>@lang('content.subtotal')</h5>
                                    </td>
                                    <td>
                                        <h5 class="subtotal">${{ $totalPrice }}</h5>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="shipping_area">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>@lang('content.shipping')</h5>
                                    </td>
                                    <td>
                                        <div class="shipping_box">
                                            <ul class="list">
                                                <li><a href="#">@lang('Flat Rate: $5.00')</a></li>
                                                <li><a href="#">@lang('Free Shipping')</a></li>
                                                <li><a href="#">@lang('Flat Rate: $10.00')</a></li>
                                                <li class="active"><a href="#">@lang('Local Delivery: $2.00')</a></li>
                                            </ul>
                                            <h6>@lang('content.calculate_shipping') <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                            <select class="shipping_select">
                                                <option value="1">@lang('Da Nang')</option>
                                                <option value="2">@lang('Ha Noi')</option>
                                                <option value="4">@lang('Ho Chi Minh City')</option>
                                            </select>
                                            <select class="shipping_select">
                                                <option value="1">@lang('Select a State')</option>
                                                <option value="2">@lang('Select a State')</option>
                                                <option value="4">@lang('Select a State')</option>
                                            </select>
                                            <input type="text" placeholder="Postcode/Zipcode">
                                            <a class="gray_btn" href="#">@lang('content.update_details')</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="out_button_area">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="primary-btn" href="{{ route('root') }}"><i class="fas fa-chevron-left"></i> @lang('content.continue_shopping')</a>
                                            &nbsp;
                                            <a class="primary-btn" href="{{ route('order.create') }}">@lang('content.go_to_checkout') <i class="fas fa-cash-register"></i></a>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <a class="primary-btn go_back" href="{{ route('root') }}">@lang('content.continue_shopping') <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--================End Cart Area =================-->
@endsection
