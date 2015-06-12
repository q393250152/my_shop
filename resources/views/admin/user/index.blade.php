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
            <span class="p3">会员管理</span>
        </div>
        @include('layouts._message')
        <div class="center">
            <!-- Indicates a dangerous or potentially negative action -->
            <div type="button" class="btn btn-danger">会员信息</div>
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
                        <th>头像</th>
                        <th>昵称</th>
                        <th>openid</th>
                        <th>性别</th>
                        <th>关注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th class="ID" scope="row">{{$user->id}}</th>
                            <td><img src="{{$user->headimgurl}}"  class="logo_img"> </td>
                            <td>{{$user->nickname}}</td>
                            <td>{{$user->openid}}</td>
                            <td>
                                @if($user->sex=='1')
                                    男
                                @else
                                    女
                                @endif
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td style="width: 150px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{ route('admin.user.show', $user->id) }}">
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">订单</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{ route('admin.user.destroy', $user->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确认删除吗？">
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
            {!! $users->render() !!}
        </div>


    </div>
    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>
@stop