<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>汉斯福特</title>
    @framework('/static/js/mod.js')
    @require('/static/lib/bootstrap/css/bootstrap.css')
    @require('/static/lib/fontawesome/css/font-awesome.css')

    @require('/static/lib/bootstrap/dist/css/AdminLTE.css')
    @require('/static/lib/bootstrap/dist/css/skins/skin-purple.css')
    @require('/static/css/admin.scss')


    @placeholder('styles')
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a >汉斯福特</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">后台管理系统</p>
        <form id="form1">
            <div class="form-group has-feedback">
                <input type="text" name="account" id="phone" class="form-control" placeholder="账号">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
            <div class="form-group ">
                <input type="password" name="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat btn-sub">登陆</button>
                </div><!-- /.col -->
            </div>
        </form>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@placeholder('framework')
@placeholder('scripts')

<script>
    var $=require('jquery');
    $('.btn-sub').click(function(){
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/login/check',
            // data to be added to query string:
            data: $('#form1').serialize(),
            // type of data we are expecting in return:
            dataType: 'json',
            success: function(data){
                window.location.href="/admin/news/index";

            },
            error: function(xhr, errorType, error){
                alert('账号或密码错误');

                console.log(xhr, errorType, error);
            }
        })
    });
</script>

</body>
</html>

