<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.appName')}}</title>
    <link href="//fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/easy-toggler@2.2.7/dist/easy-toggler.iife.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="/js/main.js"></script>
    <link rel="shortcut icon" href="/images/favicon.ico">
</head>
<body>
    @include('_partials/header')
    <main class="wrapper">
        @yield('content')
    </main>
    <footer>
    </footer>
</body>
</html>

