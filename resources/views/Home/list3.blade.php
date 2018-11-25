@extends('widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($info->pic)?'/plupload/company&contact.jpg':$info->pic}}" alt="">
    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="/">主页</a></li>

            <li class="active">{{$info->title}}</li>
        </ol>

        <div class="row">
            <div class="col-sm-9">

                <ul class="new-list">
                    @foreach($news as  $vo)
                    <li>
                        <div class="row">
                                <div class="col-md-3">
                                    <a href="{{action('Home\IndexController@article',['id'=>$vo->id])}}"> <img src="{{$vo->titlepic or '/img/sss.jpg'}}" width="100%" height="112" alt=""></a>
                                </div>
                                <div class="col-md-9">
                                    <h4  style="color: #00938f">{{$vo->title}}</h4>
                                    <p >{{$vo->created_at}}</p>
                                    <a href="{{action('Home\IndexController@article',['id'=>$vo->id])}}">{{$vo->description}}</a>

                                </div>
                            </div>
                    </li>
                        @endforeach
                </ul>
                {!! $news->render() !!}
            </div>
        </div>


    </div>


    @script()
    require('page/Home/index');

    @endscript
@endsection


@section("fis_resource")@parent @require('page/Home/list3.blade.php')@stop