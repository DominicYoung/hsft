@section("fis_resource")@require('widget/layout/Home/body.blade.php')@show<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="baidu-tc-verification" content="5c9000c1cbb308504699f6d1aca7d861" />
        <meta name="baidu-site-verification" content="m7tzHjIBga" />
        <meta name="description" content="{{$description or ''}}" />
        <meta name="keywords" content="{{$keywords or ''}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- <title>@yield('title')</title> -->
		<title>深圳市汉斯福特科技有限公司，汉斯福特科技，进口无损检测设备，进口工业仪器仪表</title>
        @require('components/bootstrap/css/bootstrap.css')
        @require('static/css/style.scss')

        @placeholder('styles')
        <script>
            var _hmt = _hmt || [];
            (function() {
              var hm = document.createElement("script");
              hm.src = "//hm.baidu.com/hm.js?0a51515dd3081b920189c37382f7b39c";
              var s = document.getElementsByTagName("script")[0];
              s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </head>
    <body >
    @widget('/widget/layout/Home/header')

        @yield('body')


    @widget('/widget/layout/Home/footer')
        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @require('widget/layout/Home/index.js')
    @placeholder('scripts')
	
	<script type="text/javascript">
		var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F0a51515dd3081b920189c37382f7b39c' type='text/javascript'%3E%3C/script%3E"));
	</script>

    </body>
</html>