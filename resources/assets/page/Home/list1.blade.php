@extends('/widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($info->pic)?'http://o9gwxz92f.bkt.clouddn.com/1-150G023023LY.jpg':$info->pic}}" alt="">
    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="/">主页</a></li>
            <li><a href="{{action('Home\IndexController@news',['id'=>$first])}}">{{$pidname}}</a></li>

            <li class="active">{{$info->title}}</li>
        </ol>
        <div class="row">
            <div class="col-sm-3">
                <div class="filter">
                    <header>
                        <h3>过滤条件</h3>
                        <a href="{{action('Home\IndexController@news',['id'=>$info->ename])}}">清除全部选项</a>
                    </header>
                    <section>
                        <ul>
                            @foreach($filter as $key=>$vo)
                                <li>
                                    <h4 class="open"> <strong >{{$vo['name']}}</strong></h4>
                                    <div class="box {{$vo['class']}}">
                                        <ul>
                                            @foreach($vo['list'] as $my)
                                                <li
                                                        @if(!empty($input[$key])&&in_array($my,explode(',',$input[$key])))
                                                        class="on"
                                                        @endif
                                                        data-type="{{$key}}">{{$my}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if($vo['class']=='listbox')
                                        <a href="#" class="limit-button"></a>
                                    @endif

                                </li>
                            @endforeach
                            {{--<li>--}}
                                {{--<h4 class="open"> <strong >传感器</strong></h4>--}}
                                {{--<div class="box listbox " style="height: 100px">--}}
                                    {{--<ul>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li class="on">美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                {{--<a href="#" class="limit-button"></a>--}}
                            {{--</li>--}}
                        </ul>

                    </section>

                    {{--<section>--}}
                        {{--<ul>--}}
     {{----}}
                            {{--<li>--}}
                                {{--<h4 class="open"> <strong >传感器</strong></h4>--}}
                                {{--<div class="box listbox " style="height: 100px">--}}
                                    {{--<ul>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li class="on">美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                        {{--<li>美国</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                {{--<a href="#" class="limit-button"></a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}

                    {{--</section>--}}

                </div>


                <br><br>

            </div>
            <div class="col-sm-9">
                {!! $news->appends($input)->render() !!}

                <ul class="list-style1">
                    @if($news)
                    @foreach($news as $vo)
                        <li>
                            <a href="{{action('Home\IndexController@detail',['band'=>$vo->band,'title'=>$vo->ename])}}">
                                <img  src="{{$vo->titlepic}}" alt="...">
                                <div style="width: 54%">
                                    <h3>{{$vo->title}}</h3>
                                    {!! $vo->shuxing !!}
                                </div>
                                <div>
                                    <dl>
                                        <dd class="day1">品牌：{{$vo->band}}</dd>
                                        <dd class="day2">产地：{{$vo->country}}</dd>

                                    </dl>
                                </div>
                            </a>
                        </li>
                    @endforeach
                        @endif
                </ul>

                {!! $news->appends($input)->render() !!}
            </div>
        </div>


    </div>

    <script>
        var _url='{{action('Home\IndexController@news',['id'=>$info->ename])}}';
    </script>
    @require('./index.js')
@endsection


