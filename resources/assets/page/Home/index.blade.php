@extends('/widget/layout/Home/body.blade.php')


@section('title', '深圳市汉斯福特科技有限公司')
@section('body')

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($banner as $key=>$vo)
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class=" @if($key=='0') active @endif"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($banner as $key=>$vo)
            <div class="item @if($key=='0') active @endif">
                <a href="{{$vo->url}}" style="background: url({{$vo->img}}) no-repeat center center;display: block;width: 100%;height: 100%;"></a>
            </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->

    <div class="gray-bg">

        <div class="container hsft">

            <img src="../../static/img/1-150F2000I70-L.png" alt="">
            <h3 style="color: #00938F;font-size:1.9rem;font-weight: normal">汉斯福特</h3>
            <div class="row">
                <div class="col-md-8">
                    <p  style="color: #9C9B9B;font-family: 'Myriad W01 Lt', sans-serif;font-size: 12px;line-height: 30px">深圳市汉斯福特科技有限公司总部位于深圳，并在香港设有分公司。公司自成立以来始终专注于结构力学特性智能化测试技术，为数千家用户提供优质的测试系统解决方案，是国内领先的结构力学性能测试系统供应商。</p>
                </div>
                <div class="col-md-4"> <a href="{{action('Home\IndexController@article',['id'=>3])}}">MORE</a></div>
            </div>

        </div>
        <br><br><br>
    </div>
    <div class="container chanpin">
        <br><br><br>
        <h3 style="color: #00938F;font-size:1.9rem;font-weight: normal">产品线</h3>
        <ul>
            @foreach($line as $vo)
            <li>
                <a href="{{action('Home\IndexController@detail',['band'=>$vo->band,'title'=>$vo->ename])}}">
                    <img src="{{$vo->titlepic}}" alt="{{$vo->title}}">
                    <p >{{$vo->title}}</p>
                </a>
            </li>
                @endforeach
        </ul>

        <br><br><br>
    </div>
    <div class="gray-bg">
        <br><br>
        <div class="container hsft">
            <h3 style="color: #00938F;font-size:1.9rem;font-weight: normal">The International Business</h3>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <img src="../../static/img/sss.jpg" width="100%" alt="">
                </div>
                <div class="col-md-9">
                    <p  style="color: #9C9B9B;font-family: 'Myriad W01 Lt', sans-serif;font-size: 12px;line-height: 30px">Huntsort Technology offers a complete selection of force and measurement solutions including load cells, pressure sensors, vibration sensor, torque sensors, accelerometer and relative instruments such as indicators, controllers, junction box, transmitter and amplifier. We have deeply cooperation with factories of brands like HBM, Mettler Toledo, Vishay, Tedea, Celtron, Revere, Sartorius, Zemic, Keli and Precia molen. Most of those product lines are in stock.</p>
                    <a href="">International Website</a>
                </div>
            </div>

        </div>
        <br><br><br><br>
    </div>
    <div class="container chanpin">
        <br><br><br>
        <h3 style="color: #00938F;font-size:1.9rem;font-weight: normal">产品推荐</h3>
        <ul>
            @foreach($chan as $vo)
                <li>
                    <a href="{{action('Home\IndexController@detail',['band'=>$vo->band,'title'=>$vo->ename])}}">
                        <img src="{{$vo->titlepic}}" alt="{{$vo->title}}">
                        <p >{{$vo->title}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
        <br><br><br>
    </div>
    <div class="gray-bg">
        <div class="container hsft-last">
            <ul>
                <li>
                    <h4><i>售后合同</i></h4>
                    <a href="/list/34">
                        <img src="/static/img/1-150RG33112412.jpg" alt="">
                    </a>
                </li>
                <li>
                    <h4><i>订单详情</i></h4>
                    <a href="/list/35">
                        <img src="/static/img/1-150RG33343136.png" alt="">
                    </a>
                </li>
                <li>
                    <h4><i>下载中心</i></h4>
                    <a href="/list/38">
                        <img src="/static/img/1-150RG33535Y2.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <br><br><br><br>
    </div>

    @script()
    $('.carousel').carousel()

    @endscript
@endsection


