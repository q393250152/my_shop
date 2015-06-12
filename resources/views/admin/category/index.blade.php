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
            <span class="p3">商品分类</span>
        </div>
        @include('layouts._message')
        <div class="center att3">

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <a href="{{route('admin.category.create')}}">
                <button type="button" class="btn btn-primary"> 新增</button>
            </a>

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
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>商品数量</th>
                        <th>导航栏</th>
                        <th>是否显示</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        @foreach($categories as $cat)
                            <td>{{$cat->id}}</td>
                            <td>
                                {!! category_indent($cat->count) !!}
                                {{$cat->name}}
                            </td>
                            <td>1</td>
                            <td>
                                @if($cat->show_in_nav == true)
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                @else
                                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                @endif

                            </td>
                            <td>
                                @if($cat->is_show == true)
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                @else
                                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                @endif

                            </td>
                            <td>{{$cat->sort_order}}</td>
                            <td style="width: 200px; margin: 0px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{route('admin.category.edit',$cat->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">编辑</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{route('admin.category.destroy',$cat->id)}}" data-method="delete" data-token="{{csrf_token()}}"
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
            {{--{!! $attributes->render() !!}--}}
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
                    <h4 class="modal-title" id="myModalLabel">添加属性</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action=""
                          method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">属性名称：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">所属商品类型：</label>

                            <div class="col-sm-10">

                                <select class="form-control" name="type_id">

                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">属性是否可选：</label>

                            <div class="col-sm-10">
                                <input type="radio" name="attr_type" value="0" checked>唯一属性
                                <input type="radio" name="attr_type" value="1">单选属性
                                <input type="radio" name="attr_type" value="2">复选属性
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">录入方式：</label>

                            <div class="col-sm-10">
                                <input type="radio" name="input_type" value="0" checked>手工录入
                                <input type="radio" name="input_type" value="1">从下面的列表中选择（一行代表一个可选值）
                                <input type="radio" name="input_type" value="2">多行文本框
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">可选值列表：</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputEmail3" name="value"></textarea>
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
    <script type="text/javascript">
        {{--$(function () {--}}
        {{--//下拉列表选择别的商品类型--}}
        {{--$("#change_type").change(function () {--}}
        {{--var type_id = $(this).val();--}}
        {{--var url = '/admin/type/' + type_id + '/attribute';--}}
        {{--console.log(url);--}}
        {{--location.href = url;--}}
        {{--})--}}

        {{--//全选--}}
        {{--$("#check_all").click(function () {--}}
        {{--$(':checkbox').prop("checked", this.checked);--}}
        {{--})--}}

        {{--//多选删除--}}
        {{--$(".btn-danger").click(function () {--}}
        {{--var del_all = $(".form1").serialize();--}}
        {{--console.log(del_all);--}}
        {{--$.ajax({--}}
        {{--type: "DELETE",--}}
        {{--url: "/admin/type/{{$type_id}}/del_all ",--}}
        {{--data: del_all,--}}
        {{--dataType: "json",--}}
        {{--success: function (data) {--}}
        {{--// console.log(data);--}}
        {{--location.href = location.href;--}}
        {{--}--}}
        {{--});--}}
        {{--return false;--}}
        {{--})--}}

        {{--})--}}
    </script>

@stop