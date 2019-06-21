@extends('layouts.app')
@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>@lang('orders.orders_manage')</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">@lang('header.admin')<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">@lang('orders.orders_manage')</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> @lang('orders.all_orders') </h2>
        </div>
        <table class="table" id="orders_table">
            <thead>
                <tr>
                    <th>@lang('orders.id')</th>
                    <th>@lang('orders.address')</th>
                    <th>@lang('orders.order_total')</th>
                    <th>@lang('orders.status')</th>
                    <th>@lang('orders.date')</th>
                    <th>@lang('orders.user_name')</th>
                    <th>@lang('content.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
