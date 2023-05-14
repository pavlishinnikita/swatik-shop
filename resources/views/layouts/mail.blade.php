<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{config('app.appName')}}</title>
    <style>
    </style>
</head>
<body>
<div class="wrapper">
    <table>
        <thead>
        </thead>
        <tbody>
            @yield('body')
        </tbody>
        <tfoot>
            @yield('footer')
        </tfoot>
    </table>
</div>
</body>
</html>

