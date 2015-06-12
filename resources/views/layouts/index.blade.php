<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/content.css')}}">
    @yield('css')
</head>
<body>
<div class="container-fluid">

    {{--导航栏--}}
    <nav class="navbar navbar-default head">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <div class="mune_nav">
                <ul class="nav navbar-nav">
                    <li><a href="/admin">首页</a></li>
                    <li><a href="/admin/wechat/get_menu">设置微信菜单栏</a></li>
                    <li><a href="/admin/good">商品列表</a></li>
                    <li><a href="/admin/order">订单列表</a></li>
                    <li><a href="/admin/comments">用户评论</a></li>
                    <li><a href="/admin/user">会员列表</a></li>
                </ul>
                <ul class="nav navbar-nav nav_1">
                    <li><a href="#">尊敬的:{{$admin->name}}</a></li>
                    <li><a href="/auth/logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a></li>

                </ul>
                <div class="clear"></div>

            </div>
            <div class="clear"></div>


        </div>

    </nav>
    {{--导航栏结束--}}

    <div class="container-fluid">

        {{--左边菜单栏--}}
        <div class="left">
            <div class="menu_name">
                <h2>菜单</h2>
                <span class="glyphicon glyphicon_menu glyphicon-plus" aria-hidden="true"></span>
            </div>
            <div class="bs-example nav-stacked" data-example-id="simple-nav-stacked">
                <ul class="nav nav-pills nav-stacked nav-pills-stacked-example nav-stacked">
                    <li role="presentation" class="presen">
                        <a href="#">商品管理</a>
                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        <ul class="nav nav-pills nav-stacked nav-pills-stacked-example nav-stacked">
                            <li role="presentation"><a href="{{route('admin.good.index')}}">商品列表</a></li>
                            <li role="presentation"><a href="{{route('admin.good.create')}}">添加商品</a></li>
                            <li role="presentation"><a href="{{route('admin.category.index')}}">商品分类</a></li>
                            <li role="presentation"><a href="{{route('admin.brand.index')}}">商品品牌</a></li>
                            <li role="presentation"><a href="{{route('admin.type.index')}}">商品类型</a></li>
                            <li role="presentation"><a href="{{route('admin/good/trash')}}">商品回收站</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="presen">
                        <a href="#">微信管理</a>
                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        <ul class="nav nav-pills nav-stacked nav-pills-stacked-example nav-stacked">
                            <li role="presentation"><a href="/admin/wechat/get_menu">自定义菜单</a></li>
                            <li role="presentation"><a href="/admin/wechat/api_config">接口配制</a></li>
                        </ul>
                    </li>
                    <li role="presentation" class="presen">
                        <a href="#">系统设置</a>
                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        <ul class="nav nav-pills nav-stacked nav-pills-stacked-example nav-stacked">
                            <li role="presentation"><a href="#">商店设置</a></li>
                            <li role="presentation"><a href="{{route('admin.express.index')}}">物流运费</a></li>
                        </ul>
                    </li>
                    <li role="presentation" class="presen">
                        <a href="{{route('admin.user.index')}}">会员管理</a>
                    </li>
                    <li role="presentation" class="presen">
                        <a href="{{route('admin.comments.index')}}">评论管理</a>
                    </li>
                    <li role="presentation" class="presen">
                        <a href="{{route('admin.order.index')}}">订单管理</a>
                    </li>


                </ul>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">微信手机端二维码</h3>
                </div>
                <div class="panel-body" style="padding: 0px;margin: 0px;">
                    <img src="{{asset('images/0.jpg')}}" style="padding: 0px;width: 200px;height:200px;">
                </div>
            </div>
        </div>
        {{--左边菜单栏结束--}}
        @yield('content')

        {{--右边显示区--}}
        {{--<div class="right">--}}

        {{--右边显示区结束--}}
        {{--<div class="clear"></div>--}}

        {{--</div>--}}
    </div>
</div>


<script rel="stylesheet" src="{{asset('jquery/assets/js/jquery-2.1.4.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('js/laravel.js')}}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        $(".glyphicon_menu").click(function () {
            if ($(this).attr("class") == 'glyphicon glyphicon_menu glyphicon-plus') {
                $(".presen ul").show();
                $(this).addClass("glyphicon-minus").removeClass("glyphicon-plus");
            } else {
                $(".presen ul").hide();
                $(this).addClass("glyphicon-plus").removeClass("glyphicon-minus");
            }
        })

        $(".nav-stacked .presen").click(function () {
            var index = $(this).index();
            console.log(index);
            var info = $(".presen .glyphicon").eq(index).attr("class");
            if (info == 'glyphicon glyphicon-menu-down') {
                $(".presen .glyphicon").eq(index).addClass("glyphicon-menu-up").removeClass("glyphicon-menu-down");
                $(".presen ul").eq(index).slideDown(1000);
            } else {
                $(".presen .glyphicon").eq(index).addClass("glyphicon-menu-down").removeClass("glyphicon-menu-up");
                $(".presen ul").eq(index).slideUp(1000);
            }
        })
    })

</script>
@yield('js')
</body>
</html>