@extends('layouts.app')

@section('title', trans('header.home'))

@section('content')
    <!-- start banner Area -->
	<section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Add to Bag</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="img/banner/banner-img.png" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Add to Bag</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="img/banner/banner-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- start features Area -->
	<section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon1.png" alt="">
                        </div>
                        <h6>@lang('Free Delivery')</h6>
                        <p>@lang('Free Shipping on all order')</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon2.png" alt="">
                        </div>
                        <h6>@lang('Return Policy')</h6>
                        <p>@lang('Free Shipping on all order')</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon3.png" alt="">
                        </div>
                        <h6>@lang('24/7 Support')</h6>
                        <p>@lang('Free Shipping on all order')</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon4.png" alt="">
                        </div>
                        <h6>@lang('Secure Payment')</h6>
                        <p>@lang('Free Shipping on all order')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end features Area -->
    
    <!-- start product Area -->
    <input type="hidden" class="quantity" value="{{ config('setting.one_value') }}">
	<section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>@lang('Hot Products')</h1>
                            <p>@lang('Our hot products')</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($hot_products as $hot_product)
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="{{ route('products.show', ['slug' => $hot_product->slug]) }}">
                                    <img class="resize_product_item img-fluid" src="{{ asset($hot_product->images[config('setting.zero_value')]) }}" alt="">
                                </a>
                                <div class="product-details">
                                    <h6>{{ $hot_product->name }}</h6>
                                    <div class="price">
                                        <h6>${{ $hot_product->price }}</h6>
                                        <h6 class="l-through">${{ $hot_product->price * config('setting.sale') }}</h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <a class="add_to_cart social-info" id="{{ $hot_product->id }}">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">@lang('Add to cart')</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">@lang('Wishlist')</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">@lang('Compare')</p>
                                        </a>
                                        <a href="{{ route('products.show', ['slug' => $hot_product->slug]) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">@lang('View More')</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>@lang('Newest Products')</h1>
                            <p>@lang('Our Newest Products')</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    @foreach ($newest_products as $newest_product)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="{{ route('products.show', ['slug' => $newest_product->slug]) }}">
                                    <img class="resize_product_item img-fluid" src="{{ asset($newest_product->images[config('setting.zero_value')]) }}" alt="">
                                </a>
                                <div class="product-details">
                                    <h6>{{ $newest_product->name }}</h6>
                                    <div class="price">
                                        <h6>${{ $newest_product->price }}</h6>
                                        <h6 class="l-through">${{ $newest_product->price * config('setting.sale') }}</h6>
                                    </div>
                                    <div class="prd-bottom">
                                            <a class="add_to_cart social-info" id="{{ $newest_product->id }}">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">@lang('Add to cart')</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">@lang('Wishlist')</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">@lang('Compare')</p>
                                        </a>
                                        <a href="{{ route('products.show', ['slug' => $newest_product->slug]) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">@lang('View More')</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end product Area -->
@endsection
