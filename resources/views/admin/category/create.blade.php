@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
    <link rel="stylesheet" href="{{asset('css/category.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">商品管理：</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">添加分类</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('admin.category.store') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类名称：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">上级分类：</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="parent_id">
                                {{--@foreach ($types as $type)--}}
                                <option value="0">顶级分类</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {!! category_indent($category->count) !!}{{ $category->name }}
                                    </option>
                                @endforeach
                                {{--@if($type->id == $type_id) selected @endif>{{$type->name}}--}}
                                {{--</option>--}}
                                {{--@endforeach--}}
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类代表图片：</label>

                        <div class="col-sm-10">
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <div class="am-form-group am-form-file">
                                    <input id="doc-form-file" type="file" multipleaa>
                                    <input type="hidden" name="thumb" value="" id="logo">
                                </div>
                                <div id="file-list"></div>
                                <img src="" alt="" class="img1" id="brand_logo_img"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">筛选属性：</label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-success btn-add">新增</button>
                        </div>
                    </div>
                    <div class="form-group add" id="add">

                        <div class="col-sm-3">
                            <select class="form-control select0 type">
                                <option value="-1">请选择商品类型</option>
                                @foreach ($types as $k=>$v)
                                    <option value="{{ $k }}">
                                        {{ $v->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control attributes" name="filter_attr[]">

                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger del">删除</button>
                        </div>
                    </div>

                    <div class="form-group sort">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sort_order" id="inputEmail3" value="99">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否显示：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="is_show" value="1">是

                            <input type="radio" name="is_show" value="0" checked>否
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">显示在导航栏：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="show_in_nav" value="1">是
                            <input type="radio" name="show_in_nav" value="0" checked>否
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类描述：</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputEmail3"
                                      name="desc"></textarea>
                        </div>
                    </div>
                    <div class="sub">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">确定</button>

                    </div>
                </form>
            </div>
        </div>

        {{--右边显示区结束--}}
        <div class="clear"></div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function () {
            $(".btn-add").click(function () {
                var info = '<div class="form-group add" id="add">' +

                        '<div class="col-sm-3">' +
                        '<select class="form-control type">' +
                        '<option value="-1">请选择商品类型</option>' +
                        '@foreach ($types as $k=>$v)' +
                        '<option value="' + '{{ $k }}' + '">' +
                        '{{ $v->name }}' +
                        '</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                        '<select class="form-control attributes" name="filter_attr[]">' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-sm-2">' +
                        '<button type="button" class="btn btn-danger del1">删除</button>' +
                        '</div>' +
                        '</div>';
                $(".sort").before(info);

            })
            $(".del").click(function(){
                var $attributes = $(this).parents('.add').find('.attributes');
                $attributes.empty();
                $(".select0 option:first").attr('selected', true);
            });
            $(document).on("click", ".del1",function() {
                $(this).parents(".add").remove();
            });

            var types ={!! $types !!};
            $(document).on("change", ".type",function(){
                var html = '';
                var type_key = $(this).val();
                var $attributes = $(this).parents('.add').find('.attributes');

                if (type_key == '-1') {
                    $attributes.empty();
                } else {
                    var attributes = types[type_key].attributes;
                    $.each(attributes, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.name + '</option>';
                    })
                    $attributes.html(html);
                }
            })

        })

    </script>
@stop