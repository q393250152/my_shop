<!DOCTYPE html>
<html>
<head lang="en">
    //<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <title>重置密码</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="nav">
        <form method="post" action="/password/reset" class="form1">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group">
                <span class="input-group-addon name1"><span class="glyphicon glyphicon-user name2"
                                                            aria-hidden="true"></span></span>
                <input type="email" class="form-control" id="inputGroupSuccess3" value="{{ old('email') }}"
                       aria-describedby="inputGroupSuccess3Status" name="email">
            </div>
            <div class="input-group pass">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess3Status" name="password">
            </div>
            <div class="input-group pass" style="margin-top: -20px;">
                <span class="input-group-addon"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id="inputGroupSuccess2"
                       aria-describedby="inputGroupSuccess3Status" name="password_confirmation">
            </div>

            <div class="checkbox">
                <!--<label>-->
                <!--<input type="checkbox"> ��ס����-->
                <!--</label>-->
                <button type="submit" class="btn btn-default" style="margin-left: 295px;">注册</button>
            </div>
        </form>


    </div>
</div>

<script rel="stylesheet" src="{{asset('jquery/assets/js/jquery-2.1.4.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('js/login.js')}}"></script>
</body>
</html>