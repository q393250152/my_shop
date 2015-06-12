<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>重置密码</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>

<div class="container">
<p>点击这里找回密码{{ url('password/reset/'.$token) }}</p>
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