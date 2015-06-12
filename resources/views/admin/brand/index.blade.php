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
            <span class="p3">商品品牌</span>
        </div>

        @include('layouts._message')

        <div class="center">

            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">增加商品</button>
            <!-- Indicates a dangerous or potentially negative action -->
            <button type="button" class="btn btn-danger destroy">删除</button>
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
                        <th>
                            <input type="checkbox" id="box1">
                        </th>
                        <th>编号</th>
                        <th>品牌名称</th>
                        <th>品牌LOGO</th>
                        <th>品牌网址</th>
                        <th>品牌描述</th>
                        <th>排序</th>
                        <th>是否显示</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <th>
                                <input type="checkbox" name="box2[]" class="items" id="inlineCheckbox2"
                                       value="{{$brand->id}}">
                            </th>
                            <td class="ID">{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td><img src="{{$brand->logo}}" class="logo_img"></td>
                            <td>{{$brand->url}}</td>
                            <td>{{$brand->desc}}</td>
                            <td class="sort" contenteditable="true">{{$brand->sort_order}}</td>

                            <td>
                                @if($brand->is_show == 1)
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                @else
                                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                @endif

                            </td>
                            <td style="width: 150px;">
                                <div class="td">

                                    <div class="fist">
                                        <a href="{{ route('admin.brand.edit', $brand->id) }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                                  data-toggle="modal" data-target="#myModal1"></span>
                                            <span class="glyphicon-class">编辑</span>
                                        </a>
                                    </div>
                                    <div class="sec">
                                        <a href="{{ route('admin.brand.destroy', $brand->id) }}" data-method="delete"
                                           data-token="{{csrf_token()}}" data-confirm="确认删除吗？">
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
            {!! $brands->render() !!}
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
                    <h4 class="modal-title" id="myModalLabel">添加品牌</h4>
                </div>
                <div class="modal-body">
                    @include('errors._list')
                    <form class="form-horizontal" action="{{ route('admin.brand.store') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌名称：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label text-nowrap">品牌网址：</label>

                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="inputPassword3" name="url">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌LOGO：</label>

                            <div class="col-sm-10">
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <div class="am-form-group am-form-file">
                                        <input id="doc-form-file" type="file" multipleaa>
                                        <input type="hidden" name="logo" value="" id="logo">
                                    </div>
                                    <div id="file-list"></div>
                                    <img src="" alt="" class="img1" id="brand_logo_img"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌描述：</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputEmail3" name="desc"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否显示：</label>

                            <div class="col-sm-10">
                                <div class="bs-example" data-example-id="block-checkboxes-radios">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="is_show" id="optionsRadios1" value="1" checked="">
                                            显示
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="is_show" id="optionsRadios2" value="0">
                                            隐藏
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
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
            <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script>
                $("#box1").click(function () {
                    $(':checkbox').prop("checked", this.checked);
                })
                $(".destroy").click(function () {
                    {{--console.log({!! $brands !!})--}}
                    if ($(':checkbox:checked').length == 0) {
                        alert("你还未选中内容！");
                        return false;
                    }
                    var del_all = $(".form1").serialize();
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/brand/del_all",
                        data : del_all,
                        dataType: "json",
                        success : function(data){
//                             console.log(data)
                            location.href=location.href;
                        }
                    });
                    return false;
                })
                $(".sort").blur(function () {

                    var sort_order = $(this).text();
                    var id = $(this).siblings(".ID").text();
                    var data = {
                        sort_order: $(this).text(),
                        id: $(this).siblings(".ID").text()
                    }
                    console.log(data);

                    $.ajax({
                        type: "PATCH",
                        url: "/admin/brand/sort",
                        data: data,
                        dataType: "html",
                    });
                })
            </script>
@stop