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
            <span class="p3">商品管理</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">商品列表</span>
        </div>
        @include('layouts._message')
        <div class="center att3">

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <a href="{{route('admin.good.create')}}">
                <button type="button" class="btn btn-primary"> 新增</button>
            </a>

            <!-- Indicates a dangerous or potentially negative action -->
            <button type="button" class="btn btn-danger">删除</button>

            <div class="search-form">
                {{--<form class="bs-example bs-example-form" method="get" data-example-id="input-group-with-button" action="/admin/type/{{$type_id}}/attribute/search">--}}
                <form class="bs-example bs-example-form" method="get" data-example-id="input-group-with-button"
                      action="/admin/good/search">
                    <div class="input-group">
                        <input type="text" class="form-control search" placeholder="Search for..." name="keyword">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                </span>
                    </div>
                </form>
            </div>

            <div class="clear"></div>
        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <form class="form1">
                {!! csrf_field() !!}
                <table class=" table-hover Brand_table table table-bordered">
                    <thead style="background:#F3F3F3;">
                    <tr>
                        <th>编号</th>
                        <th>商品名称</th>
                        <th>商品缩略图</th>
                        <th>价格</th>
                        <th>上架</th>
                        <th>精品</th>
                        <th>新品</th>
                        <th>热销</th>
                        <th>推荐排序</th>
                        <th>库存</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)

                        <tr>
                            <td class="ID">{{ $good->id }}</td>
                            <td>{{ $good->name}}</td>
                            <td><img src="{{$good->thumb}}" style="width: 100px;height: 80px;"></td>
                            <td>{{ $good->price}}</td>
                            <td>@if($good->onsale)
                                   上架
                                @else
                                   下架
                                @endif</td>
                            <td>
                                @if($good->best)
                                    精品
                                @else
                                   普通
                                @endif
                            </td>
                            <td>
                                @if($good->new)
                                    新品
                                @else
                                    老品
                                @endif
                            </td>
                            <td>
                                @if($good->hot)
                                    HOT
                                @else
                                    NO
                                @endif
                            </td>
                            <td class="sort" contenteditable="true">{{ $good->sort_order }}</td>
                            <td>{{ $good->number }}</td>
                            <td style="width: 200px; margin: 0px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{route('admin.good.edit', $good->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">编辑</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{route('admin.good.destroy', $good->id)}}" data-method="delete" data-token="{{csrf_token()}}"
                                           data-confirm="确认删除吗？">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            <span class="glyphicon-class">删除</span>
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
            {{--{!! $goods->render() !!}--}}
        </div>
    </div>
    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>

@stop
@section('js')
    <script>
        $(".sort").blur(function () {

            var sort_order = $(this).text();
            var id = $(this).siblings(".ID").text();
            var data = {
                sort_order: $(this).text(),
                id: $(this).siblings(".ID").text()
            }
            $.ajax({
                type: "PATCH",
                url: "/admin/good/sort",
                data: data,
                dataType: "html",
            });
        })

    </script>

@stop