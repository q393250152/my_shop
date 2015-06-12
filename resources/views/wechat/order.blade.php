@extends('layouts.wechat')
@section('content')
    <header data-am-widget="header"
            class="am-header am-header-default">
        <div class="am-header-left am-header-nav">
            <a href="#left-link" class="">
    <span class="am-header-nav-title">
    首页
    </span>

                <i class="am-header-icon am-icon-home"></i>
            </a>
        </div>

        <h1 class="am-header-title">
            Amaze UI
        </h1>

        <div class="am-header-right am-header-nav">
            <a href="#right-link" class="">
    <span class="am-header-nav-title">
    菜单
    </span>

                <i class="am-header-icon am-icon-bars"></i>
            </a>
        </div>
    </header>

    <div data-am-widget="list_news" class="am-list-news am-list-news-default">

        <div class="am-list-news-bd">
            <ul class="am-list">
                @foreach($orders as $k=>$v)
                        <!--缩略图在标题左边-->
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    @foreach($v->order_goods as $g)
                        <div style="float: left;margin:10px 5px; border: 1px solid #CFCFCF;padding:10px 2px;">

                            <div class="am-u-sm-4 am-list-thumb">
                                <a href="/good/{{$g->good->id}}" class="">
                                    <img src="{{$g->good->thumb}}"/>
                                </a>
                            </div>

                            <div class=" am-u-sm-8 am-list-main">
                                <h3 class="am-list-item-hd"><a href="/good/{{$g->good->id}}"
                                                               class="">{{$g->good->name}}</a>
                                </h3>

                                <div class="am-list-item-text">
                                    <b>￥</b> {{$g->good->price}} X {{$g->number}}
                                </div>
                                <div class="am-list-item-text">
                                    下单时间： {{$v->created_at}}
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div style="padding:0 10px 10px; width: 50%;margin:auto">
                        <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block"
                                id="add_cart">
                            <i class="am-icon-shopping-cart"></i>
                            订单追踪
                        </button>
                    </div>
                </li>


                @endforeach

            </ul>
        </div>

    </div>
    {{--<!--更多在底部-->--}}
    {{--<div class="am-list-news-ft">--}}
        {{--<a class="am-list-news-more am-btn am-btn-default " href="###">查看更多 &raquo;</a>--}}
    {{--</div>--}}


@stop

