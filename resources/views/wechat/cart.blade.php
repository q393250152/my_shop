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
        .am-list-news-default .am-list .am-list-thumb img{
            width: 50%;
            height: 50%;
            display: block;
        }
    </style>
@stop
@section('content')

    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <div class="am-list-news-bd">
            <ul class="am-list">
                @foreach($carts as $cart)
                        <!--缩略图在标题左边-->
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left lis">
                    <div class="am-u-sm-4 am-list-thumb">
                        <a href="{{url('good', [$cart->good->id])}}" class="">
                            <img src="{{$cart->good->thumb}}" alt="{{$cart->good->name}}"/>
                        </a>
                    </div>

                    <div class=" am-u-sm-8 am-list-main">
                        <h3 class="am-list-item-hd">
                            <a href="{{url('good', [$cart->good->id])}}" class="">{{$cart->good->name}}</a>
                        </h3>

                        <div class="am-list-item-text price">
                            {{$cart->good->price}}
                        </div>

                        <div class="am-list-item-text sel">
                            <section class="select">
                                <p class="option">
                                    <a class="btn-del" id="minus">-</a>
                                    <input type="text" class="fm-txt" value="{{$cart->number}}" id="num">
                                    <a class="btn-add" id="plus">+</a>
                                </p>
                            </section>
                            <span class="am-icon-trash am-icon-sm trash"></span>

                        </div>


                    </div>
                </li>
                @endforeach

                <li class="am-g">
                    <a class="am-list-item-hd">
                        小计：￥<b class="sum">{{$total_price}}</b>
                    </a>
                </li>
            </ul>
        </div>

        <div style="padding:0 10px 10px;">
            <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block" id="add_cart">
                <i class="am-icon-shopping-cart"></i>
                结算
            </button>
        </div>


    </div>
@stop

@section('js')

    <script>
        $(function(){
            var price;
            var sum;
            var num;
            $(".btn-del").click(function(){
                if($(this).siblings("#num").val() !=1){
                    var number = parseInt($(this).siblings("#num").val()) - 1;
                    $(this).siblings("#num").val(number);
                    price=parseInt($(this).parents(".sel").siblings(".price").text());
                    sum=parseInt(parseInt($(".sum").text())-price);
                    $(".sum").text(sum);
                }

            })
            $(".btn-add").click(function(){
                var number = parseInt($(this).siblings("#num").val()) + 1;
                $(this).siblings("#num").val(number);
                price=parseInt($(this).parents(".sel").siblings(".price").text());
                sum=parseInt($(".sum").text())+price;
                $(".sum").text(sum);
            })
            $(".fm-txt").focus(function(){
                num=  parseInt($(this).val());
                console.log(num);
            });
            $(".fm-txt").blur(function(){
                var info;
                if (parseInt($(this).val()) < 1) {
                    $(this).val(1);
                }
                $(this).val(parseInt($(this).val()));
                price=parseInt($(this).parents(".sel").siblings(".price").text());
                info = (parseInt($(this).val())-num)*price;
                sum=parseInt($(".sum").text())+info;
                $(".sum").text(sum);
            })
        })

    </script>
@stop

