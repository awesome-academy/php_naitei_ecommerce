<!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="/">@lang('header.home')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">@lang('header.shop')</a>
                        </li>
                        @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('header.login')</a>
                        </li>
                        @else
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('users.show', Auth::user()) }}">@lang('header.profile')<span
                                            class="caret"></span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#">@lang('header.tracking')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#" id="logout_btn_submit">
                                        {{ __('Logout') }}</a>
                                </li>
                                {!! Form::open(['method' => 'POST', 'route' => 'logout', 'id' => 'logout_form', 'class'
                                => 'd-none']) !!}
                                {!! Form::close() !!}
                            </ul>
                        </li>
                        @if (!Auth::user()->inRole('customer'))
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">@lang('Manage System')</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage_users') }}">
                                        @lang('header.manage_users')<span class="caret"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage_orders') }}">
                                        @lang('header.manage_orders')<span class="caret"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @endguest
                        <li class="nav-item"><a class="nav-link" href="/contact">@lang('header.contact')</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="cart">
                                <span class="ti-bag"></span>
                                <p class="nav-link" id="totalQuantity">
                                    {{ Session::has('cart') ? Session::get('cart')->totalQuantity : config('setting.zero_value') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light main_box alert alert-success alert_font" role="alert">
            <div class="container" id="error_msg"></div>
        </nav>
        @if (count($errors) > 0)
        <nav class="navbar navbar-expand-lg navbar-light main_box alert alert-danger alert_font" role="alert">
            <div class="container">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </nav>
        @endif
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            {!! Form::open(['route' => 'search', 'method' => 'GET', 'class' => 'd-flex justify-content-between']) !!}
            {!! Form::text('query', request()->input('query'), ['class' => 'form-control', 'id' => 'query',
            'placeholder' => trans('content.search_here')]) !!}
            <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            {!! Form::close() !!}
        </div>
    </div>
</header>
