<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> @yield('title')</title>
        <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    </head>
    <body>
        @include("layouts.elements.sidebar")
        <div class="main">
            <div class="dv-new"><button><a href="/resource" class="new-res">Thêm mới resource</a></button></div>
            @yield('content')
        </div>
    </body>
</html>
