@extends('/widget/layout/Home/body.blade.php')


@section('title', $band.'-'.$country)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="http://o9gwxz92f.bkt.clouddn.com/1-150G023023LY.jpg" alt="">
    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="/">主页</a></li>
            <li><a href="{{action('Home\IndexController@band',['key'=>$countryen])}}">{{$country}}</a></li>
            <li class="active">{{$band}} [{{$country}}]</li>
        </ol>
        <div style="width: 75%;margin: 0 auto">
            <div class="band-list">
                <div class="row">
                    <div class="col-sm-4" style="border-right: 1px dashed #9C9B9B">
                        <img style="width: 230px;height: 150px;" src="{{$bandinfo['titlepic'] or 'http://o9gwxz92f.bkt.clouddn.com/defaultpic.gif'}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <h4>{{$band}} [{{$country}}]</h4>
                        <p>{{$bandinfo['description']}}</p>
                    </div>
                </div>
            </div>
            <br>

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


    @endscript
@endsection


