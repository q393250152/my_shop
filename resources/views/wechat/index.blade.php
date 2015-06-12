@extends('layouts.wechat')
@section('content')
    <div data-am-widget="slider" class="am-slider am-slider-c1" data-am-slider='{"directionNav":false}'>
        <ul class="am-slides">
            @foreach($best_goods as $k=>$v)
                <li>
                    <img src="{{$v->thumb}}" class="flash_img">

                    <div class="am-slider-desc">
                        {{$v->name}}/￥{{$v->price}}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div data-am-widget="intro"
         class="am-intro am-cf am-intro-default"
            >
        <div class="am-intro-hd">
            <span class="am-intro-title">新品推荐</span>
        </div>

        <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
    am-avg-md-3 am-avg-lg-4 am-gallery-bordered" data-am-gallery="{  }">
            @foreach($new_goods as $k=>$v)
            <li>
                <div class="am-gallery-item">
                    <a href="{{url('good', $v->id)}}" class="good_img">
                        <img src="{{$v->thumb}}" style="height:152px;width: 152px;">

                        <h3 class="am-gallery-title">{{$v->name}}</h3>

                        <div class="am-gallery-desc">{{$v->price}}</div>
                    </a>
                </div>
            </li>
            @endforeach

        </ul>

    </div>

    <div data-am-widget="intro"
         class="am-intro am-cf am-intro-default"
            >
        <div class="am-intro-hd">
            <span class="am-intro-title">热门商品</span>
        </div>

        <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
    am-avg-md-3 am-avg-lg-4 am-gallery-bordered" data-am-gallery="{  }">
            @foreach($hot_goods as $k=>$v)
                <li>
                    <div class="am-gallery-item">
                        <a href="{{url('good', $v->id)}}" class="good_img">
                            <img src="{{$v->thumb}}" style="height:152px;width: 152px;">

                            <h3 class="am-gallery-title">{{$v->name}}</h3>

                            <div class="am-gallery-desc">{{$v->price}}</div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>


    <!-- List -->
@stop
