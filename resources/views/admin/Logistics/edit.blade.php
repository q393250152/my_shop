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
            <span class="p3">修改物流设置</span>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{route('admin.express.update', $exp->id)}}" method="post">
                {!! csrf_field() !!}
                {!! method_field('put') !!}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">物流名称：</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="key">
                                @foreach($expresses as $k=>$v)
                                    <option value="{{$k}}" @if($k == $exp->key) selected @endif>{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="inputEmail3" class="col-sm-2 control-label text-nowrap">key值：</label>--}}

                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" id="inputEmail3" name="key" value="{{$exp->key}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label text-nowrap">物流运费：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" name="shipping_money" value="{{$exp->shipping_money}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">满额免物流费：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="shipping_free" value="{{$exp->shipping_free}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">物流描述：</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputEmail3" name="desc">{{$exp->desc}}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">是否可用：</label>

                        <div class="col-sm-10">
                            <div class="bs-example" data-example-id="block-checkboxes-radios">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" id="optionsRadios1" value="1" @if($exp->enabled==1)checked @endif>
                                        可用
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" id="optionsRadios2" value="0"  @if($exp->enabled==0)checked @endif>
                                        不可用
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">排序：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="sort_order" value="{{$exp->sort_order}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default">取消</button>
                        <button type="submit" class="btn btn-primary sub">确定</button>

                    </div>
            </form>
        </div>
    </div>

    {{--右边显示区结束--}}
    <div class="clear"></div>

    </div>
@stop
@section('js')
@stop