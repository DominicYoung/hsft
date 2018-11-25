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

            <li class="active">{{$info->title}}</li>
        </ol>

        <div class="row">
            <div  style="margin:0 auto;width: 80%">
                <h3>下载中心</h3>

                <hr>


                {!! $news->render() !!}
                <ul class="download-style">
                    @foreach($news as $vo)
                        <li>
                                <img  src="{{$vo->titlepic or '/img/sss.jpg'}}" alt="...">
                                <div style="width: 50%">
                                    <a href="{{$vo->file}}">{{$vo->title}}</a>
                                    <p style="color: #00938F">{{$vo->description}}</p>
                                    <a href="{{$vo->file}}" style="text-decoration: underline">{{$vo->filename}}</a>
                                </div>
                                <div>
                                    <dl>
                                        <dd class="day1"><strong>语言</strong>：{{$vo->yuyan}}</dd>
                                        <dd class="day2"><strong>类别</strong>：{{$vo->filekind}}</dd>

                                    </dl>
                                </div>
                        </li>
                    @endforeach
                </ul>

                {!! $news->render() !!}

            </div>
        </div>


    </div>


    @script()
    require('./index.js');

    @endscript
@endsection


