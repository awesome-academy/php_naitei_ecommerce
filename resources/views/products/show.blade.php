@extends('layouts.app')

@section('title', $product->name)

@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<h1>{{ $product->name }}</h1>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						@foreach ($product->images as $image)
						<div class="single-prd-item">
							<img class="img-fluid" src={{ asset($image) }} alt="">
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $product->name }}</h3>
						<h2>${{ $product->price }}</h2>
						<ul class="list">
							<li><a href="javascript:void(0)">
									<span>@lang('content.category')</span> : 
									<a class="active">
										{{ $product->category->name }}
									</a>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)">
									<span>@lang('content.available')</span> :
									<a class="stock active">
										{{ ($product->quantity - $item_quantity > config('setting.zero_value')) ? trans('content.instock') : trans('content.outstock') }}
									</a>
								</a>
							</li>
						</ul>
						<p>{{ $product->description }}</p>
						<div class="product_count">
							<label for="quantity">@lang('content.quantity:')</label>
							<input type="text" class="quantity input-text{{ $product->id }}" id="{{ $product->id }}" value="{{ config('setting.one_value') }}" title="{{ trans('content.quantity:') }}"
								min="{{ config('setting.one_value') }}" max="{{ $product->quantity }}">
							<button class="increase items-count" id="{{ $product->id }}" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button class="reduced items-count" id="{{ $product->id }}" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="card_area d-flex align-items-center">
							<a class="add_to_cart primary-btn" id="{{ $product->id}}" href="">@lang('content.add_to_cart')</a>
							<a class="icon_btn" href="javascript:void(0)"><i class="lnr lnr lnr-diamond"></i></a>
							<a class="icon_btn" href="javascript:void(0)"><i class="lnr lnr lnr-heart"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('content.description')</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
						aria-selected="false">@lang('content.specifitation')</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
						aria-selected="false">@lang('content.reviews')</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
						</table>
					</div>
				</div>
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-8">
									<div class="box_total">
										<h5>@lang('content.overall')</h5>
										<h4 class="avgPoint">{{ $product->avgPoint }}</h4>
										<h6 class="review_count">@lang('content.parentheses'){{ $product->users->count() }} @lang('content.review_parentheses')</h6>
									</div>
								</div>
							</div>
							<div class="review_list">
								@foreach ($product->users as $user)
									<div class="review_item">
										<div class="media">
											<div class="d-flex">
												<img src="{{ asset('img/product/review-1.png') }}" alt="">
											</div>
											<div class="media-body">
												<h4>{{ $user->name }}</h4>
												@for ($i = 1; $i <= $user->pivot->point; $i++)
													<i class="fa fa-star"></i>
												@endfor
											</div>
										</div>
										<p>{{ $user->pivot->review }}</p>
									</div>
								@endforeach
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>@lang('content.add_a_review')</h4>
								<p>@lang('content.your_rating')</p>
								<ul class="list">
									<li><a href="javascript:void(0)"><i id="star1" class="fa fa-star default-star" onclick="set('1')"></i></a></li>
									<li><a href="javascript:void(0)"><i id="star2" class="fa fa-star default-star" onclick="set('2')"></i></a></li>
									<li><a href="javascript:void(0)"><i id="star3" class="fa fa-star default-star" onclick="set('3')"></i></a></li>
									<li><a href="javascript:void(0)"><i id="star4" class="fa fa-star default-star" onclick="set('4')"></i></a></li>
									<li><a href="javascript:void(0)"><i id="star5" class="fa fa-star default-star" onclick="set('5')"></i></a></li>
								</ul>
								{!! Form::open(['route' => 'new_rate', 'method' => 'POST', 'class' => 'row contact_form', 'id' => 'rate-form']) !!}
									<div class="col-md-12">
										<div class="form-group">
											{!! Form::textarea('review', null, ['id' => 'review', 'class' => 'form-control review', 'placeholer' => trans('content.reviews'), 'rows' => config('setting.one_value')]) !!}
										</div>
									</div>
									{!! Form::hidden('slug', $product->slug, ['class' => 'slug']) !!}
									{!! Form::hidden('point', null, ['class' => 'point', 'id' => 'star']) !!}
									<div class="col-md-12 text-right">
										{!! Form::button(trans('content.submit_now'), ['class' => 'rate_submit primary-btn']) !!}
									</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
@endsection
