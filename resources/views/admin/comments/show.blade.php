@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <style>
        .thumb {
            width: 50px;
            height: 50px;
            -webkit-border-radius: 100px;
            float: left;
            margin-left: 20px;
        }

        .panel {
            float: left;
            margin-left: 20px;
        }

        .panel-danger {
            width: 90%;
        }

        .Reply {
            width: 90%;
            float: left;
            margin-left: 8%;
            margin-right: 2%;
        }

        .sub {
            float: right;
        }
    </style>
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">管理中心</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">评论管理</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">会员评论</span>
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
            <div>
                <img src="{{$comments->user->headimgurl}}" class="thumb">
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <b>{{$comments->user->nickname}}</b>&nbsp;&nbsp;于{{$comments->created_at}}对{{$comments->good->name}}
                    发表评论
                </div>
                <div class="panel-body">
                    {{$comments->content}}
                </div>
            </div>
            <div class="clear">

            </div>
            <div class="page">
                {{--{!! $comments->render() !!}--}}
            </div>
        </div>

        @if($comments->reply)
            <div class="table-responsive" data-example-id="hoverable-table">


                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <b>管理员</b>&nbsp;<b>{{$admin->name}}</b>&nbsp;&nbsp;于{{$comments->created_at}}
                        对{{$comments->user->nickname}}的评论回复
                    </div>
                    <div class="panel-body">
                        {{$comments->reply}}
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/x3.jpg')}}" class="thumb">
                </div>
                <div class="clear">

                </div>

            </div>
        @endif
        {{--右边显示区结束--}}
        <div class="clear"></div>
        <div class="bs-example Reply" data-example-id="disabled-fieldset">
            <form method="post" action="{{route('admin.comments.reply',$comments->id)}}">
                {!! csrf_field() !!}
                {!! method_field('patch') !!}
                <div class="form-group">
                    <textarea name="reply" class="form-control" id="inputPassword" placeholder="回复内容" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary sub">回复评论</button>
            </form>
        </div>


    </div>

@stop
@section('js')
    <script type="text/javascript">

    </script>

@stop