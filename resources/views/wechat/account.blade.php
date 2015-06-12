@extends('layouts.wechat')
@section('css')
    <style>
        .thumb {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 100px;
            margin: 30px 0px;
        }

        .panel {
            margin-bottom: 0px;
            height: 30%;
            text-align: center;
            background: url("{{asset('images/x3.jpg')}}") no-repeat center right fixed;
            background-size: cover;

        }

    </style>

@stop
@section('content')
    <header data-am-widget="header"
            class="am-header am-header-default">
        <div class="am-header-left am-header-nav">
            <a href="#left-link" class="">

                <img class="am-header-icon-custom"
                     src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 12 20&quot;&gt;&lt;path d=&quot;M10,0l2,2l-8,8l8,8l-2,2L0,10L10,0z&quot; fill=&quot;%23fff&quot;/&gt;&lt;/svg&gt;"
                     alt=""/>
            </a>
        </div>

        <h1 class="am-header-title">
            我的商城
        </h1>

        <div class="am-header-right am-header-nav">
            <a href="#right-link" class="">

                <img class="am-header-icon-custom"
                     src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 42 26&quot; fill=&quot;%23fff&quot;&gt;&lt;rect width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;1&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;rect y=&quot;11&quot; width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;12&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;rect y=&quot;22&quot; width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;23&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;/svg&gt;"
                     alt=""/>
            </a>
        </div>
    </header>
    <div class="am-panel am-panel-default panel">
        <img src="{{$user->headimgurl}}" class="thumb">
    </div>
    <nav data-am-widget="menu" class="am-menu  am-menu-stack">
        <a href="javascript: void(0)" class="am-menu-toggle">
            <i class="am-menu-toggle-icon am-icon-bars"></i>
        </a>


        <ul class="am-menu-nav am-avg-sm-1">
            <li class="">
                <a href="/order" class="">订单查询</a>
                <a href="/order/obligation" class="">待付款订单</a>
                <a href="##" class="">地址管理</a>
                <a href="##" class="">用户信息</a>
            </li>
        </ul>
    </nav>
@stop

