<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>手机商城</title>

    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="icon" type="image/png" href="{{ asset('amaze/i/favicon.png')}}">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ asset('amaze/i/app-icon72x72@2x.png')}}">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="{{ asset('amaze/i/app-icon72x72@2x.png')}}">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="{{ asset('amaze/i/app-icon72x72@2x.png')}}">
    <meta name="msapplication-TileColor" content="#0e90d2">

    <link rel="stylesheet" href="{{ asset('amaze/css/amazeui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('amaze/css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        .am-navbar-default .am-navbar-nav {
            background-color: #6f5499;
            background-image: linear-gradient(to bottom, #563d7c 0, #6f5499 100%);
            background-repeat: repeat-x;
            opacity: .9;
        }

        .flash_img {
            width: 300px;
            height: 300px;
        }

        .good_img {
            height: 260px;
        }

        .am-intro-default .am-intro-hd {
            background: #FFFFFF;
            border-bottom: 1px solid #c6c6c6;
            margin-bottom: -5px;
        }

        .am-intro-default .am-intro-hd {
            font-size: 1.9em;
            color: #333;
        }

        .am-intro-title {
            font-size: 18px;
            margin: 0;
            font-weight: 500;
        }

        .am-slider .am-slides img {
            width: 80%;
            height: 50%;
        }

    </style>
    @yield('css')
</head>
<body>
@yield('content')

        <!-- Navbar -->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
     id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4">
        <li>
            <a href="/">
                <span class="am-icon-home"></span>
                <span class="am-navbar-label">首页</span>
            </a>
        </li>


        <li>
            {{--<a href="#sidebar" data-am-offcanvas="{target: '#sidebar', effect: 'push'}">--}}
            <a href="/category">
                <span class="am-icon-th-list"></span>
                <span class="am-navbar-label">分类</span>
            </a>
        </li>
        <li>
            <a href="/cart">
                <span class="am-icon-shopping-cart" style="display:inline-block;"></span>
                <span class="am-badge am-badge-secondary am-round" id="cart_number">{{$cart_number}}</span>
                <span class="am-navbar-label">购物车 </span>
            </a>
        </li>
        <li>
            <a href="/account">
                <span class="am-icon-user"></span>
                <span class="am-navbar-label">我的</span>
            </a>
        </li>
    </ul>
</div>


<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" style="width: auto;">
    <a href="#top" title="回到顶部" class="am-icon-btn am-icon-arrow-up am-active" id="amz-go-top"></a>
</div>


<!--在这里编写你的代码-->
<script src="{{asset('jquery/assets/js/jquery-2.1.4.min.js')}}"></script>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('amaze/js/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('amaze/js/amazeui.min.js') }}"></script>
<script src="{{ asset('js/laravel.js') }}"></script>
<script src="{{ asset('NProgress/nprogress.js') }}"></script>
<script src="{{ asset('js/fastclick.js') }}"></script>
<script>
    $(function () {
        FastClick.attach(document.body);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    NProgress.start();
    NProgress.done();
</script>
@yield('js')
</body>
</html>