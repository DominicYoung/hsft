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
        <div style="width:80%;margin: 0 auto">


            {!! $news->render() !!}

        <ul class="list-style1">
            @foreach($news as $vo)
            <li>
                <a href="{{action('Home\IndexController@detail',['band'=>$vo->band,'title'=>$vo->ename])}}">
                    <img  src="{{$vo->titlepic}}" alt="...">
                    <div style="width: 50%">
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
        </ul>

            {!! $news->render() !!}
        </div>
    </div>


    @script()
    $('.carousel').carousel()

    @endscript
@endsection


