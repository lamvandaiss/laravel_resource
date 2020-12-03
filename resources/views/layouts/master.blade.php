<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title')</title>
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    </head>
    <body>
        @include("layouts.elements.sidebar")
        <div class="main">
            <div class="dv-new"><button Class="btn btn-secondary"><a href="/resource" class="new-res">Thêm mới Resource</a></button></div>
            @yield('content')
        </div>
    </body>
</html>
