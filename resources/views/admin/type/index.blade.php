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
            <span class="p3">商品类型</span>
        </div>
        @include('layouts._message')
        <div class="center">

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">新增</button>

            <!-- Indicates a successful or positive action -->
            <button type="button" class="btn btn-success">排序</button>

            <!-- Indicates a dangerous or potentially negative action -->
            <button type="button" class="btn btn-danger">删除</button>
            <div class="search-form">
                <form class="bs-example bs-example-form  " data-example-id="input-group-with-button">


                    <div class="input-group">
                        <input type="text" class="form-control search" placeholder="Search for..." name="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">搜索</button>
                                </span>
                    </div>
                    <!-- /input-group -->
                    <!-- /.col-lg-6 -->

                    <!-- /.row -->
                </form>
            </div>

        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <form class="form1">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                <table class=" table-hover Brand_table table table-bordered">
                    <thead style="background:#F3F3F3;">
                    <tr>
                        <th>编号</th>
                        <th>类型名称</th>
                        <th>属性数</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{ $type->attributes->count() }}</td>
                            <td style="width: 200px; margin: 0px;">
                                <div class="td">
                                    <div class="fist">
                                        <a href="{{ route('admin.type.{type_id}.attribute.index',$type->id) }}">
                                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                            <span class="glyphicon-class">属性列表</span>
                                        </a>
                                    </div>

                                    <div class="fist">
                                        <a href="{{route("admin.type.edit",$type->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">编辑</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{route("admin.type.destroy",$type->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确认删除吗？">
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
            {!! $types->render() !!}
        </div>
    </div>
    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>
    <!--增加模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">添加商品类型</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.type.store')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品类型名称：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary sub">确定</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')

@stop