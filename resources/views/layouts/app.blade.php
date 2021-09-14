<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/assets/images/icon-hapo.png') }}">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('auth.login-register')

    @include('partials.chatbox')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>