@extends('layouts.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('webupload/dist/webuploader.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('webupload/examples/image-upload/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
    <link rel="stylesheet" href="{{asset('css/category.css')}}">
    <link rel="stylesheet" href="{{asset('css/good.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">微信管理：</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">接口配置</span>
        </div>
        @include('layouts._message')
        <div class="bs-example col-sm-1">
            <button type="button" class="btn btn-success">接口配制</button>
        </div>

        <div class="bs-example col-sm-10" data-example-id="textarea-form-control">
            <form action="/admin/wechat/set_config" method="post">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                <textarea class="form-control" name="config" rows="8">{{$config}}</textarea>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;margin-left: 0px;">提交保存</button>
            </form>

        </div>
        <div class="clear"></div>


        {{--右边显示区结束--}}
        <div class="clear"></div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(".tab li:first").show();
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