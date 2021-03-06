@extends('layouts.app')

@section('title', trans('header.shop_page'))

@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>@lang('content.shopping')</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">@lang('header.home')<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">@lang('header.shop')<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">
							@if ($category_title)
								{{ $category_title }}
							@else
								@lang('All Products')
							@endif
						</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
    <!-- End Banner Area -->
    <section class="products-list">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
					<div class="sidebar-categories">
						<div class="head">@lang('content.browse_category')</div>
						<ul class="main-categories">
							<li class="main-nav-list"><a href="{{ route('shop') }}">
								<span class="lnr lnr-arrow-right"></span>@lang('content.all_products')<span class="number">({{ $count_product }})</span></a>
							</li>
							@foreach($categories as $category)
								<li class="main-nav-list"><a href="{{ route('shop',['category' => $category->name]) }}">
									<span class="lnr lnr-arrow-right"></span>{{ $category->name }}<span class="number">({{ $category->products_count }})</span></a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-7">
					<!-- Start Filter Bar -->
					<div class="filter-bar d-flex flex-wrap align-items-center">
						<div><a href="{{ route('shop', ['category' => request()->category, 'sort' => 'low_high']) }}" class="sorting mr-auto genric-btn default">@lang('Low to High') <i class="fas fa-arrow-circle-up"></i></a></div>
						&nbsp;
						<div><a href="{{ route('shop', ['category' => request()->category, 	'sort' => 'high_low']) }}" class="sorting mr-auto genric-btn default">@lang('High to Low') <i class="fas fa-arrow-circle-down"></i></a></div>
						<div class="sorting mr-auto"></div>
						{{ $products->appends(request()->input())->links() }}
					</div>
					<!-- End Filter Bar -->
					<!-- Start Best Seller -->
					<input type="hidden" class="quantity" value="{{ config('setting.one_value') }}">
					<section class="lattest-product-area pb-40 category-list">
						<div class="row">
							<!-- single product -->
							@forelse ($products as $product)
								<div class="col-lg-4 col-md-6">
									<div class="single-product">
										<img class="resize_product_item img-fluid" src="{{ asset($product->images[config('setting.zero_value')]) }}" alt="">
										<div class="product-details">
											<h6>{{ $product->name }}</h6>
											<div class="price">
												<h6>${{ $product->price }}</h6>
												<h6 class="l-through">${{ $product->price * config('setting.sale') }}</h6>
											</div>
											<div class="prd-bottom">

												<a href="" class="add_to_cart social-info" id="{{ $product->id }}">
													<span class="ti-bag"></span>
													<p class="hover-text">@lang('Add to cart')</p>
												</a>
												<a href="" class="social-info">
													<span class="lnr lnr-heart"></span>
													<p class="hover-text">@lang('Wishlist')</p>
												</a>
												<a href="" class="social-info">
													<span class="lnr lnr-sync"></span>
													<p class="hover-text">@lang('Compare')<</p>
												</a>
												<a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="social-info">
													<span class="lnr lnr-move"></span>
													<p class="hover-text">@lang('View More')</p>
												</a>
											</div>
										</div>
									</div>
								</div>
							@empty
								<div class="col-lg-12">
										<div class="no_product">
									<div class="alert alert-danger" role="alert">
										@lang('content.no_product')
									</div>
								</div>
							</div>
							@endforelse
						</div>
					</section>
					<!-- End Best Seller -->
					<!-- Start Filter Bar -->
					<div class="filter-bar d-flex flex-wrap align-items-center">
						<div><a href="{{ route('shop', ['category' => request()->category, 'sort' => 'low_high']) }}" class="sorting mr-auto genric-btn default">@lang('Low to High') <i class="fas fa-arrow-circle-up"></i></a></div>
						&nbsp;
						<div><a href="{{ route('shop', ['category' => request()->category, 	'sort' => 'high_low']) }}" class="sorting mr-auto genric-btn default">@lang('High to Low') <i class="fas fa-arrow-circle-down"></i></a></div>
						<div class="sorting mr-auto"></div>
						{{ $products->appends(request()->input())->links() }}
					</div>
					<!-- End Filter Bar -->
				</div>
			</div>
		</div>
	</section>
@endsection
