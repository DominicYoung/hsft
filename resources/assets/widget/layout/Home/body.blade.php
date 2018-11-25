<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="{{$description or ''}}" />
        <meta name="keywords" content="{{$keywords or ''}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        @require('bootstrap/css/bootstrap.css')
        @require('/static/css/style.scss')

        @placeholder('styles')
    </head>
    <body >
    @widget('/widget/layout/Home/header')

        @yield('body')


    @widget('/widget/layout/Home/footer')
        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @require('./index.js')
    @placeholder('scripts')

    </body>
</html>