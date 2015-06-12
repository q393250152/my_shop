@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">订单管理</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">订单信息</span>
        </div>
        @include('layouts._message')
        <div class="form-horizontal">
            <div class="order">
                <div class="order1">
                    <span>基本信息</span>
                    <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin: 0px;"></span>
                </div>
                <div class="bs-example" data-example-id="bordered-table">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th scope="row">订单号</th>
                            <td>{{$order->id}}</td>
                            <td>订单状态</td>
                            <td>{{$order_status[$order->status]}}</td>
                        </tr>
                        <tr>
                            <th scope="row">购物人</th>
                            <td>{{$order->address->name}}</td>
                            <td>下单时间</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">支付方式</th>
                            <td>{{$order->status == 0 ? '未支付' : '微信支付'}}</td>
                            <td>付款时间</td>
                            <td>{{ $order->pay_time}}</td>
                        </tr>
                        <tr>
                            <th scope="row">配送方式</th>
                            <td>{{$order->express->name}}</td>
                            <td>发货时间</td>
                            <td>{{$order->express->created_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">发货单号</th>
                            <td colspan="3">
                                <form action="{{route('admin.order.update', $order->id)}}" method="post">
                                    {!! csrf_field() !!}
                                    {!! method_field('put') !!}
                                    <input type="text" class="col-sm-2 btn1" name="express_code"
                                           value="{{ $order->express_code}}">
                                    <button type="submit" class="btn btn-success" id="send">
                                        {{$order->status==1 ? '发货' : '修改发货单号'}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>

            </div>
            <div class="order">
                <div class="order1">
                    <span>收货人信息</span>
                    <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin: 0px;"></span>
                </div>
                <div class="bs-example" data-example-id="bordered-table">
                    <table class="table table-bordered table-hover">
                        <tbody>

                        <tr>
                            <th scope="row">收货人</th>
                            <td>{{$order->address->name}}</td>
                            <td>电话</td>
                            <td>{{$order->address->tel}}</td>
                        </tr>
                        <tr>
                            <th scope="row">地址</th>
                            <td colspan="3">
                                {{$order->address->address}}

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>

            </div>
            <div class="order">
                <div class="order1">
                    <span>货品信息</span>
                    <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin: 0px;"></span>
                </div>
                <div class="bs-example" data-example-id="bordered-table">
                    <table class="table table-bordered table-hover">
                        <tbody>

                        <tr>
                            <th scope="row">货品名称</th>
                            <th>单价</th>
                            <th>单价</th>
                            <th>数量</th>
                            <th>小计</th>
                        </tr>
                        @foreach($order->order_goods as $g)
                                <tr>
                                    <td>{{$g->good->name}}</td>
                                    <td>{{$g->good->price}}</td>
                                    <td>{{$g->number}}</td>
                                    <td>{{$g->attr}}</td>
                                    <td>￥{{number_format(($g->good->price * $g->number), 2)}}</td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>

            </div>
            <div class="order">
                <div class="order1">
                    <span>费用信息</span>
                    <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin: 0px;"></span>
                </div>
                <div class="bs-example" data-example-id="bordered-table">
                    <table class="table table-bordered table-hover">
                        <tbody>

                        <tr>
                            <th scope="row">货品总额</th>
                            <td>配送费</td>
                            <td>合计</td>
                        </tr>
                        <tr>
                            <th scope="row">￥{{number_format(($order->total_price - $order->express_money), 2)}}</th>
                            <td>
                                {{$order->express_money}}
                            </td>
                            <td>{{$order->total_price}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>

            </div>
            <div class="order">
                <div class="order1">
                    <span>物流信息</span>
                </div>

                @if($order->status >= 2)
                    <div class="am-panel am-panel-default">
                        <div class="am-panel-bd am-collapse am-in" id="collapse-panel-4">
                            <iframe src="http://m.kuaidi100.com/index_all.html?type={{ $order->express->key}}&postid={{ $order->express_code}}"
                                    frameborder="0" width="100%" height="500"></iframe>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>
@stop
@section('js')
    {{--<script>--}}
    {{--$(function () {--}}
    {{--$(".glyphicon-minus").click(function(){--}}
    {{--$(this).parent().siblings(".bs-example").hide();--}}
    {{--$(this).addClass("glyphicon-plus").removeClass("glyphicon-minus");--}}
    {{--})--}}
    {{--$(".glyphicon-plus").click(function(){--}}
    {{--console.log(123);--}}
    {{--//                $(this).parent().siblings(".bs-example").show();--}}
    {{--//                $(this).addClass("glyphicon-minus").removeClass("glyphicon-plus");--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}
@stop