@section("fis_resource")@require('widget/layout/Admin/body.blade.php')@show<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @framework('static/js/mod.js')
    @require('static/lib/bootstrap/css/bootstrap.css')
    @require('static/lib/fontawesome/css/font-awesome.css')

    @require('static/lib/bootstrap/dist/css/AdminLTE.css')
    @require('static/lib/bootstrap/dist/css/skins/skin-purple.css')
    @require('static/css/admin.scss')


    @placeholder('styles')
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="layout-top-nav skin-purple">
<div class="wrapper">
    @widget('/widget/layout/Admin/header')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('header')
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @yield('body')
                </div>
            </div>


        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
        @widget('/widget/layout/Admin/foot')
    </div>

</div>


@placeholder('framework')
@placeholder('scripts')

</body>
</html>