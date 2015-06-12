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
            <span class="p3">评论管理</span>
        </div>
        @include('layouts._message')
        <div class="center att3">

            <!-- Indicates a dangerous or potentially negative action -->
            <button type="button" class="btn btn-danger">删除</button>

            <div class="search-form">
                {{--<form class="bs-example bs-example-form" method="get" data-example-id="input-group-with-button" action="/admin/type/{{$type_id}}/attribute/search">--}}
                <form class="bs-example bs-example-form" method="get" data-example-id="input-group-with-button"
                      action="">


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
                        <th>商品</th>
                        <th>会员昵称</th>
                        <th>评论内容</th>
                        <th>评论时间</th>
                        <th>是否回复</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td><img src="{{$v->good->thumb}}" style="width: 50px;height: 50px;">

                                <p style="text-align: center;">{{ $v->good->name}}</p></td>
                            {{--<td><img src="{{$v->good->thumb}}"></td>--}}
                            {{--<td>{{$v->good->name}}</td>--}}
                            <td>{{$v->user->nickname}}</td>
                            <td>{{str_limit($v->comment,38)}}</td>
                            <td>{{$v->created_at}}</td>
                            <td>
                                @if($v->reply)
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                @endif
                            </td>
                            <td style="width:200px; margin:0px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{route('admin.comments.show', $v->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">查看评论</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{route('admin.comments.destroy', $v->id)}}" data-method="delete"
                                           data-token="{{csrf_token()}}"
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
            {{--{!! $comments->render() !!}--}}
        </div>
    </div>
    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>

@stop
@section('js')
    <script type="text/javascript">

    </script>

@stop