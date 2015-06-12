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
            <span class="p3">系统设置</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">物流运费</span>
        </div>
        @include('layouts._message')
        <div class="center att3">

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 新增</button>

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
                        <th>物流名称</th>
                        <th>是否可用</th>
                        <th>运费</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($express as $exp)

                        <tr>
                            <td>{{ $exp->id }}</td>
                            <td>{{ $exp->name}}</td>
                            <td>@if($exp->enabled)
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                @endif</td>
                            <td>{{$exp->shipping_money}}</td>
                            <td>{{ $exp->sort_order }}</td>
                            <td style="width: 200px; margin: 0px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{route('admin.express.edit', $exp->id)}}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">编辑</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{route('admin.express.destroy', $exp->id)}}" data-method="delete"
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
            {{--{!! $goods->render() !!}--}}
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
                    <h4 class="modal-title" id="myModalLabel">添加物流</h4>
                </div>
                <div class="modal-body">
                    @include('errors._list')
                    <form class="form-horizontal" action="{{ route('admin.express.store') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">物流名称：</label>

                            <div class="col-sm-10">

                                <select class="form-control" name="key">
                                    @foreach($expresses as $k=>$v)
                                        <option value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="inputEmail3" class="col-sm-2 control-label text-nowrap">key值：</label>--}}

                            {{--<div class="col-sm-10">--}}
                                {{--<input type="text" class="form-control" id="inputEmail3" name="key">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label text-nowrap">物流运费：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" name="shipping_money">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">满额免物流费：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="shipping_free">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">物流描述：</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputEmail3" name="desc"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否可用：</label>

                            <div class="col-sm-10">
                                <div class="bs-example" data-example-id="block-checkboxes-radios">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="enabled" id="optionsRadios1" value="1" checked="">
                                            可用
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="enabled" id="optionsRadios2" value="0">
                                            不可用
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="sort_order">
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

        @stop
        @section('js')
            <script type="text/javascript">

            </script>

@stop