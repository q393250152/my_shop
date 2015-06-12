@extends('layouts.index')
@section('css')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
@stop
@section('content')
    {{--右边显示区--}}
    <div class="right">
        <div class="top">
            <span class="p1">管理中心</span>
            <span class="glyphicon glyphicon-play p2" aria-hidden="true"></span>
            <span class="p3">修改品牌</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('admin.brand.update',$brand_edit->id) }}" method="post">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌名称：</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="name"
                               value="{{$brand_edit->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label text-nowrap">品牌网址：</label>

                    <div class="col-sm-10">
                        <input type="url" class="form-control" id="inputPassword3" name="url"
                               value="{{$brand_edit->url}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌LOGO：</label>

                    <div class="col-sm-10">
                        <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                            <div class="am-form-group am-form-file">
                                <input id="doc-form-file" type="file" multipleaa>
                                <input type="hidden" name="logo" value="{{$brand_edit->logo}}" id="logo"  >
                            </div>
                            <div id="file-list"></div>
                            <img src="{{$brand_edit->logo}}" alt="" id="brand_logo_img"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">品牌描述：</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="inputEmail3" name="desc">{{$brand_edit->desc}}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否显示：</label>

                    <div class="col-sm-10">
                        <div class="bs-example" data-example-id="block-checkboxes-radios">

                            <div class="radio">
                                <label>
                                    <input type="radio" name="is_show" id="optionsRadios1" value="1"
                                           @if($brand_edit->is_show==1) checked @endif>
                                    显示
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="is_show" id="optionsRadios2" value="0"
                                           @if($brand_edit->is_show==0) checked @endif>
                                    隐藏
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" value="{{$brand_edit->sort_order}}">
                    </div>
                </div>
                <div class="sub">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">确定</button>

                </div>


            </form>
        </div>

        {{--右边显示区结束--}}
        <div class="clear"></div>

    </div>
@stop
@section('js')
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop