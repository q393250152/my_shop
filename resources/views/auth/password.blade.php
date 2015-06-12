<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>找回密码</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>

<div class="container">
    <div class="nav">
        <div class="heard">
            <h2>找回密码</h2>
        </div>
        <form method="post" class="form1" action="/password/email">
            {!! csrf_field() !!}
            <div class="input-group">
                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" name="email" value="{{ old('email') }}" >
                </div>
                <button type="submit" class="btn btn-default">提交</button>
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