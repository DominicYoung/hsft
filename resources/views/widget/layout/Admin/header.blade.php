<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="../../index2.html" class="navbar-brand">汉斯福特</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">

                <ul class="nav navbar-nav">
                    <li class="{{(Request::is('admin/news/*')||Request::path()=='admin/index') ? 'active' : ''}}"><a href="/admin/news/index">文章管理</a></li>
                    <li class="{{Request::is('admin/category/*')? 'active' : ''}}"><a href="/admin/category">栏目管理</a></li>
                    <li class="{{Request::is('admin/band/*')? 'active' : ''}}"><a href="/admin/band/index">品牌管理</a></li>
                    <li class="{{Request::is('admin/banner/*')? 'active' : ''}}"><a href="/admin/banner/index">滚动图管理</a></li>
                    <li class="{{Request::is('admin/sys/*')? 'active' : ''}}"><a href="/admin/sys/index">系统参数</a></li>
                    <li class="{{Request::is('admin/admin/*')? 'active' : ''}}"><a href="/admin/admin/index">人员管理</a></li>




                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li >
                        <a href="/admin/logout"><span  class="glyphicon glyphicon-log-in"></span> 退出登录</a>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
@section("fis_resource")@parent @require('widget/layout/Admin/header.blade.php')@stop