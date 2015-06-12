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
        <span class="p3">修改品牌类型</span>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="{{ route('admin.type.update',$type_edit->id) }}" method="post">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label text-nowrap">商品类型名称：</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="name" value="{{$type_edit->name}}">
                </div>
            </div>
            <div class="sub">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">确定</button>
            </div>


        </form>
    </div>

    {{--右边显示区结束--}}
    <div class="clear"></div>

</div>
@stop
@section('js')
@stop