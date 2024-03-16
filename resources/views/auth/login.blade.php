<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/bootstrap.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="adminLTE/plugins/iCheck/square/blue.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="adminLTE/dist/css/skins/_all-skins.min.css">

    <!-- Application -->
    <link rel="stylesheet" href="adminLTE/dist/css/App.css">
</head>

<body class="hold-transition login-page cirebon-backdrop">
    <div class="login-box" id="app">
        <div class="login-box-body">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1">{{ config('app.name', 'Laravel') }}
                </a>
                <p><strong>Sistem Inventory Barang</strong></p>
            </div>
            <p class="login-box-msg">{{ __('Masuk ke Aplikasi') }}</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div
                    class="form-group has-feedback @if($errors->has('username') || $errors->has('email')) has-error @endif">
                    <input type="text" name="username" class="form-control"
                        placeholder="{{ __('Username atau EMail') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @error('username')
                    <span class="help-block">
                        {{ $message }}
                    </span>
                    @enderror

                    @error('email')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group has-feedback  @error('password') has-error @enderror">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                    <span class="help-block">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" id="button-login" class="btn btn-primary btn-block"><i
                                class="fa fa-lock"></i> {{ __('Masuk') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ __('Lupa Password?') }}</a>
            </p>
            @endif
            @if (Route::has('register'))
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">{{ __('Daftar Akun Baru') }}</a>
            </p>
            @endif
        </div>

    </div>
    <!-- jQuery 2.2.3 -->
    <script src="adminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- AdminLTE App -->
    <script src="adminLTE/js/adminlte.min.js"></script>
</body>

</html>