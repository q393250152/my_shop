<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>

<div class="container">
    <div class="nav">
        <div class="heard">
            <h2>登录页面</h2>
        </div>
        <div class="button">
            <h3>如无帐号，请先</h3><a href="/auth/register"> <span>注册</span></a>
        </div>
        <div class="button">
            <a href="/password/email"> <span>找回密码</span></a>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" class="form1" action="/auth/login">
            {!! csrf_field() !!}
            <div class="input-group">
                <span class="input-group-addon name1"><span class="glyphicon glyphicon-user name2"
                                                            aria-hidden="true"></span></span>
                <input type="email" name="email" class="form-control" id="inputGroupSuccess3"
                       aria-describedby="inputGroupSuccess3Status" value="{{ old('email') }}">
            </div>
            <div class="input-group pass">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess3Status" name="password">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> 记住密码
                </label>
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </form>

    </div>
</div>

<script rel="stylesheet" src="{{asset('jquery/assets/js/jquery-2.1.4.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
{{--<script>--}}
    {{--$(function(){--}}
        {{--$(".verify").click(function(){--}}
            {{--var src="/Admin/user/verify/"+Math.random();--}}
            {{--$(this).attr("src",src);--}}
        {{--})--}}
    {{--})--}}
{{--</script>--}}
</body>
</html>