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
            <span class="p3">修改属性</span>
            {{--<span class="p5">--}}
            {{--<button aria-hidden="true" data-toggle="modal" data-target="#myModal"><span--}}
            {{--class="glyphicon glyphicon-edit p6"></span>修改品牌--}}
            {{--</button>--}}
            {{--</span>--}}
        </div>
        <div class="table-responsive" data-example-id="hoverable-table">
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('admin.type.{type_id}.attribute.update', [$type_id, $attribute->id])}}"
                      method="post">
                    {!! csrf_field() !!}
                    {!! method_field('put') !!}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">属性名称：</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="name" value="{{$attribute->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">所属商品类型：</label>

                        <div class="col-sm-10">

                            <select class="form-control" name="type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                            @if($type->id == $type_id) selected @endif>{{$type->name}}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">属性是否可选：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="attr_type" value="0" @if ($attribute->attr_type=='0') checked @endif>唯一属性
                            <input type="radio" name="attr_type" value="1" @if ($attribute->attr_type=='1') checked @endif>单选属性
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">录入方式：</label>

                        <div class="col-sm-10">
                            <input type="radio" name="input_type" value="0" @if ($attribute->input_type==0) checked @endif>手工录入
                            <input type="radio" name="input_type" value="1" @if ($attribute->input_type==1) checked @endif>从下面的列表中选择（一行代表一个可选值）
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">可选值列表：</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputEmail3" name="value">{{$attribute->value}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
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
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop