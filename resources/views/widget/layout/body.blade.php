@section("fis_resource")@require('widget/layout/body.blade.php')@show<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="@yield('description')" />
        <meta name="keywords" content="@yield('keywords')" />


        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        @require('components/bootstrap/css/bootstrap.css')
        @require('static/css/style.scss')

        @placeholder('styles')
    </head>
    <body >
        @yield('body')



        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @placeholder('scripts')

    </body>
</html>