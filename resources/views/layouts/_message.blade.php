{{--后台提示块--}}
@if (session('info'))
    <div class="alert alert-danger" role="alert">
        {{ session('info') }}
    </div>
@endif


{{--登录注册提示块--}}
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
<script>
    setTimeout(function () {
        $('.alert').hide();
    }, 3000);
</script>
