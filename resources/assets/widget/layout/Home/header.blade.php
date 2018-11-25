<div class="navbar-wrapper">
    <div class="container">

        <p>
            <a href="{{action('Home\IndexController@news',['id'=>36])}}">订单</a>
            <a href="{{action('Home\IndexController@article',['id'=>3])}}">公司</a>
            <a href="{{action('Home\IndexController@news',['id'=>32])}}">新闻</a>
            <a href="">工程</a>
            <a href="{{action('Home\IndexController@article',['id'=>9])}}">联系人</a>
            <a href="{{action('Home\IndexController@news',['id'=>38])}}">下载中心</a>
            <b><img src="gj.png" alt=""></b>&nbsp;&nbsp;|&nbsp;&nbsp;<b id="top-search">
                <img src="search.png" alt="">
                    <input type="search" value="" name="search-key">
            </b></p>
    </div>
    <nav>
        <div class="container">
            <ul class="nav">
                @foreach($mylm as  $vo)
                <li><h3>{{$vo['title']}}</h3>
                    <ul>
                        @foreach($vo['child'] as $my)
                        <li><a href="{{$my['url'] or action('Home\IndexController@news',['id'=>$my['ename']])}}">{{$my['title']}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach

            </ul>
        </div>
    </nav>
</div>

<div id="massage">
    <div>

    <a href="##" title="电话咨询" class="tel_phone">0755-26552352</a><br>
    <a href="##" title="在线留言" class="mess_ico" >webmaster@huntsort.com</a><br>
    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1138493826&amp;site=qq&amp;menu=yes" target="_blank" title="QQ咨询" class="qq_ico">QQ咨询</a>

    </div>
</div>

