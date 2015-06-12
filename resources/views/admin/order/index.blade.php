@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">管理中心</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">订单管理</span>
        </div>
        <div class="center">
            <!-- Indicates a dangerous or potentially negative action -->
            <div type="button" class="btn btn-danger">订单信息</div>
            <div class="search-form">
                <form class="bs-example bs-example-form" method="get" data-example-id="input-group-with-button"
                      action="/admin/brand/search">
                    <div class="input-group">
                        <input type="search" class="form-control search" placeholder="Search for..." name="keyword"
                               value="">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                </span>
                    </div>
                </form>
            </div>

        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <form class="form1" action="">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                <table class=" table-hover Brand_table table table-bordered">
                    <thead style="background:#F3F3F3;">
                    <tr>
                        <th>编号</th>
                        <th>订单号</th>
                        <th>下单时间</th>
                        <th>收件人</th>
                        <th>总金额</th>
                        <th>订单壮态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $k=>$v)
                        <tr>
                            <th class="ID" scope="row">{{$v->id}}</th>
                            <td>{{$v->express_code}} </td>
                            <td>{{$v->created_at}}</td>
                            <td>{{$v->address->name}}
                                [<a href="tel:{{ $v->address->tel }}">{{ $v->address->tel }}</a>]<br>{{ $v->address->address }}
                            </td>
                            <td>￥{{number_format($v->total_price,2)}}</td>
                            <td>{{$order_status[$v->status]}}</td>
                            <td style="width: 150px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{ route('admin.order.edit', $v->id) }}">
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">查看订单</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        <div class="page">
            {!! $orders->render() !!}
        </div>


    </div>
    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>
@stop