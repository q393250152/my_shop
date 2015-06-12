@extends('layouts.wechat')
@section('css')
    <style>
        .option .btn-del {
            background-position: 10px -20px;
        }

        .btn-add, .btn-del {
            overflow: hidden;
            text-indent: -200px;
            background: url({{asset('images/shp-cart-icon-sprites.png')}}) no-repeat -15px -20px;
            background-size: 50px 100px;
        }

        .btn-add, .btn-del, .fm-txt {
            border: solid #ccc;
            float: left;
            width: 32px;
            height: 24px;
            line-height: 24px;
            text-align: center;
        }

        .btn-del {
            border-width: 1px 0 1px 1px;
            border-radius: 3px 0 0 3px;
            font-size: 20px;
        }

        .btn-add {
            border-width: 1px 1px 1px 0;
            border-radius: 0 3px 3px 0;
            font-size: 20px;
        }

        .fm-txt {
            border-width: 1px;
            font-size: 16px;
            border-radius: 0;
            -webkit-appearance: none;
            backgroumd-color: #fff;
        }

        .trash {
            position: absolute;
            right: 20px;
            bottom: 3px;
        }

        .am-list-news-default .am-list .am-list-thumb img {
            width: 50%;
            height: 50%;
            display: block;
        }
        .am-list>li{
            border: none;
        }
        .but{
            padding:10px 0px;
            margin-right: 20px;
            width: 30%;
            float: right;
        }
        .sun{
            float: left;
            padding: 8px;
        }
        b{
            color:#C00000;
        }

    </style>
@stop
@section('content')


    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <div class="am-list-news-bd">
            @foreach($obligation as $v)

                <ul class="am-list" style="border: 1px solid #CFCFCF;padding: 10px;">

                    <!--缩略图在标题左边-->
                    @foreach($v->order_goods as $g)
                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left lis"
                        style="margin: 0px 2px;border-bottom: 1px solid #CFCFCF;">

                            <div class="am-u-sm-4 am-list-thumb">
                                <a href="{{url('good', [$g->good->id])}}" class="">
                                    <img src="{{$g->good->thumb}}" alt="{{$g->good->name}}"/>
                                </a>
                            </div>

                            <div class=" am-u-sm-8 am-list-main">
                                <h3 class="am-list-item-hd">
                                    <a href="{{url('good', [$g->good->id])}}" class="">{{$g->good->name}}</a>
                                </h3>

                                <div class="am-list-item-text price">
                                    <b>{{$g->good->price}} x {{$g->number}}</b>
                                </div>
                            </div>

                    </li>
                    @endforeach

                    <li class="am-g" style="padding: 10px 0px;">
                        <span class="am-list-item-hd sun">
                            小计：￥<b>{{number_format($v->xj,2)}}</b>
                        </span>
                        <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block but"
                                id="add_cart">
                            <i class="am-icon-shopping-cart"></i>
                            付款
                        </button>
                    </li>
                </ul>
            @endforeach

        </div>


    </div>

@stop




