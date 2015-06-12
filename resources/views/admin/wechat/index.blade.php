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
            <span class="p1">商品管理：</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">添加商品</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        @include('layouts._message')
        <div class="panel-body">
            <form action="/admin/wechat/set_menu" method="post">
                {!! csrf_field() !!}
                {!! method_field('put') !!}

                        <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="tabs">
                    <li role="presentation" class="active">
                        <a href="#tab0" aria-controls="tab0" role="tab" data-toggle="tab">菜单一</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">菜单二</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">菜单三</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($menus as $key=>$menu)
                        <div role="tabpanel" class="tab-pane fade in @if($key==0) active @endif" id="tab{{$key}}">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>级别</th>
                                    <th>类型</th>
                                    <th>名称</th>
                                    <th>值</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>一级菜单：</td>
                                    <td>
                                        <select class="form-control" name="menus[{{$key}}][type]">
                                            <option value="">click</option>
                                            <option value="">view</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="menus[{{$key}}][name]" value="{{$menu['name']}}" class="form-control"></td>
                                    <td><input type="text" name="menus[{{$key}}][key]" value="" class="form-control"></td>
                                </tr>
                                @foreach($menu['sub_button'] as $k=>$button)
                                    <tr>
                                        <td>二级菜单：{{$k+1}}</td>
                                        <td>
                                            <select class="form-control" name="menus[{{$key}}][buttons][{{$k}}][type]">
                                                <option value="click" @if($button['type']=='click') selected @endif>click</option>
                                                <option value="view" @if($button['type']=='view') selected @endif>view</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="menus[{{$key}}][buttons][{{$k}}][name]" value="{{$button['name']}}" class="form-control"></td>
                                        <td><input type="text" name="menus[{{$key}}][buttons][{{$k}}][key]" value="{{$button['url'] or $button['key']}}" class="form-control"></td>
                                    </tr>
                                @endforeach

                                @if(4-$k > 0)
                                    @for($i=0;$i<4-$k; $i++)
                                        <tr>
                                            <td>二级菜单：{{$k+$i+2}}</td>
                                            <td>
                                                <select class="form-control" name="menus[{{$key}}][buttons][{{$k+$i+1}}][type]">
                                                    <option value="click">click</option>
                                                    <option value="view">view</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="menus[{{$key}}][buttons][{{$k+$i+1}}][name]" value="" class="form-control"></td>
                                            <td><input type="text" name="menus[{{$key}}][buttons][{{$k+$i+1}}][key]" value="" class="form-control"></td>
                                        </tr>
                                    @endfor
                                @endif

                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    <div role="tabpanel" class="tab-pane fade" id="second">2</div>
                    <div role="tabpanel" class="tab-pane fade" id="third">3</div>
                </div>

                <input type="submit" class="btn btn-info">

            </form>
        </div>


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