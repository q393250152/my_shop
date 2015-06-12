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
            <span class="p3">修改分类</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('admin.category.update',$category->id) }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('put') !!}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类名称：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="name"
                                   value="{{$category->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">上级分类：</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="parent_id">
                                {{--@foreach ($types as $type)--}}
                                <option value="0">顶级分类</option>

                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" @if($c->id == $category->parent_id) selected @endif>
                                        {!! category_indent($c->count) !!}{{ $c->name }}
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
                                <img src="{{$category->thumb}}" alt="" id="brand_logo_img"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">筛选属性：</label>

                        <div class="col-sm-10">
                            <button type="button" class="btn btn-success btn-add">新增</button>
                        </div>
                    </div>

                    @if($category->filter_attr->isEmpty())
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
                    @else

                        @foreach( $category->filter_attr as $key=>$attr)
                            <div class="form-group add" id="add">
                                <div class="col-sm-3">
                                    <select class="form-control select0 type">
                                        <option value="-1">请选择商品类型</option>
                                        @foreach ($types as $k=>$type)
                                            <option value="{{ $k }}" @if($attr->type->id == $type->id) selected @endif>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <select class="form-control attributes" name="filter_attr[]">
                                        @foreach($attr->type->attributes as $a)
                                            <option value="{{$a->id}}" @if($attr->id == $a->id) selected @endif>
                                                {{$a->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger del">删除</button>
                                </div>

                            </div>
                        @endforeach
                    @endif

                    <div class="form-group sort">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sort_order" id="inputEmail3"
                                   value="{{ $category->sort_order }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否显示：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="is_show" value="1" @if($category->is_show == 1) checked @endif>是

                            <input type="radio" name="is_show" value="0" @if($category->is_show == 0) checked @endif>否
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">显示在导航栏：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="show_in_nav" value="1"
                                   @if($category->show_in_nav == 1) checked @endif>是
                            <input type="radio" name="show_in_nav" value="0"
                                   @if($category->show_in_nav == 0) checked @endif>否
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类描述：</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputEmail3"
                                      name="desc">{{$category->desc}}</textarea>
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
//        $(".del").click(function(){
//        var $attributes = $(this).parents('.add').find('.attributes');
//        $attributes.empty();
//        $(".select0 option:first").attr('selected', true);
//        });
            $(".del").click(function () {
                $(this).parents(".add").remove();
            })
            $(document).on("click", ".del1", function () {
                $(this).parents(".add").remove();
            });

            var types ={!! $types !!};
            {{--var categories={!! $categories !!};--}}
            //            console.log(categories);
            console.log(types);
            $(document).on("change", ".type", function () {
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