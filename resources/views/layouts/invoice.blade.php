<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE/dist/css/AdminLTE.min.css">

    <!-- Application -->
    <link rel="stylesheet" href="adminLTE/dist/css/App.css">

    @yield('style')
</head>

<body class="" onload="window.print()">
    @yield('content')
</body>

</html>