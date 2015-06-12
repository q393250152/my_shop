@extends('layouts.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('webupload/dist/webuploader.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('webupload/style.css') }}"/>
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
    <link rel="stylesheet" href="{{asset('css/category.css')}}">
    <link rel="stylesheet" href="{{asset('css/good.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">商品管理：</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">修改商品</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab"
                                                              aria-controls="home" aria-expanded="true">通用信息</a></li>
                    <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab"
                                                        aria-controls="profile" aria-expanded="false">商品属性</a></li>
                    <li role="presentation" class=""><a href="#profile2" role="tab" id="profile-tab" data-toggle="tab"
                                                        aria-controls="profile" aria-expanded="false">商品像册</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form2" action="{{route('admin.good.update', $good->id)}}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('put') !!}
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品名称：</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" name="name"
                                           value="{{ $good->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品分类：</label>

                                <div class="col-sm-10">

                                    <select class="form-control" name="category_id">
                                        {{--@foreach ($types as $type)--}}
                                        <option value="0">请选择...</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($good->category_id == $category->id) selected @endif>
                                                {!! category_indent($category->count) !!}{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品品牌：</label>

                                <div class="col-sm-10">

                                    <select class="form-control" name="brand_id">
                                        {{--@foreach ($types as $type)--}}
                                        <option value="0">请选择...</option>

                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}"
                                                    @if($good->brand_id == $brand->id) selected @endif>
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品价格：</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputEmail3" name="price"
                                           value="{{ $good->price }}"
                                           style="width: 80px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品数量：</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputEmail3" name="number"
                                           value="{{ $good->number }}"
                                           style="width: 80px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">加入推荐：</label>

                                <div class="col-sm-10">
                                    <input type="checkbox" name="best" value="1" @if($good->best == 1) checked @endif>
                                    精品
                                    <input type="checkbox" name="new" value="1" @if($good->new == 1) checked @endif> 新品
                                    <input type="checkbox" name="hot" value="1" @if($good->hot == 1) checked @endif> 热销
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">上架：</label>

                                <div class="col-sm-10">
                                    <input type="checkbox" name="onsale" value="1"
                                           @if($good->onsale == 1) checked @endif> 允许商品销售，否则不许销售
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品图片：</label>

                                <div class="col-sm-10">
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <div class="am-form-group">
                                            <input id="doc-form-file" type="file" multipleaa>
                                            <input type="hidden" name="thumb" value="{{ $good->thumb }}" id="logo">
                                        </div>
                                        <div id="file-list"></div>
                                        <img src="{{ $good->thumb }}" alt="" class="img1" id="brand_logo_img"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">分类描述：</label>

                                <div class="col-sm-10">
                                    <textarea rows="16" placeholder="请使用富文本编辑插件" id="editor_id"
                                              name="desc">{{ $good->desc }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品类型：</label>

                                <div class="col-sm-10">

                                    <select class="form-control" id="select_type" name="type_id">
                                        {{--@foreach ($types as $type)--}}
                                        <option value="0" data-type_key="">请选择...</option>
                                        @foreach ($types as $key=>$type)
                                            <option value="{{ $type->id }}" data-type_key="{{$key}}"
                                                    @if($good->type_id == $type->id) selected @endif>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div id="attributes"></div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile2">
                            <div class="form-group">
                                <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-margin gallery-list">
                                    @foreach($good->good_galleries as $gallery)
                                        <li>
                                            <a href="#">
                                                <img class="am-img-thumbnail am-img-bdrs" src="{{$gallery->img}}"
                                                     alt=""/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div id="uploader">
                                    <div class="queueList">
                                        <div id="dndArea" class="placeholder">
                                            <div id="filePicker"></div>
                                            <p>或将照片拖到这里，单次最多可选300张</p>
                                        </div>
                                    </div>
                                    <div class="statusBar" style="display:none;">
                                        <div class="progress">
                                            <span class="text">0%</span>
                                            <span class="percentage"></span>
                                        </div>
                                        <div class="info"></div>
                                        <div class="btns">
                                            <div id="filePicker2"></div>
                                            <div class="uploadBtn">开始上传</div>
                                        </div>
                                    </div>

                                    <div id="imgs"></div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <button type="submit" id="save" class="btn btn-primary sub">保存</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        {{--右边显示区结束--}}
        <div class="clear"></div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="{{asset('webupload/dist/webuploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('webupload/upload.js')}}"></script>
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/edit_good.js') }}"></script>
    <script src="{{ asset('kindeditor/kindeditor-min.js') }}"></script>
    <script src="{{ asset('kindeditor/lang/zh_CN.js') }}"></script>
    <script>
        $(function () {
            $(".good_ul li").click(function () {
                var index = $(this).index();
                var info = '.tab' + $(this).index();
                console.log(info);
                $(this).addClass("active").siblings().removeClass("active");
                $(info).fadeIn().siblings().fadeOut();

            })
            $(".sub").click(function () {
                $(".form2").submit();
            })

        })

        KindEditor.ready(function (K) {
            window.editor = K.create('#editor_id');
        });

        var good_attrs = {!! $good->good_attrs !!};
        var types = {!! $types !!};
        var good_type_id = {!! $good->type_id !!};
        console.log(types);

        $(function () {

            $(".good_ul li").click(function () {
                var index = $(this).index();
                $(this).addClass("active").siblings().removeClass("active");
                $(".tab li").eq(index).show().siblings().hide();
            })
            $(".webuploader-pick").click(function () {
                $(".webuploader-element-invisible").trigger("click");

            })


        })


    </script>
@stop