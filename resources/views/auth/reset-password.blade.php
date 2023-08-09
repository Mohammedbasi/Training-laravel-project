<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
{{--    <ul>--}}
{{--        @if($errors->any())--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li>{{$error}}</li>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    </ul>--}}
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

            <form action="{{ route('password.reset.update') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control"
                               placeholder="Email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="text-danger" />
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Confirm Password">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
