@extends('widget/layout/Home/body.blade.php')


@section('title', $country)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="/plupload/company&contact.jpg" alt="">
    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="/">主页</a></li>
            <li class="active">{{$country}}</li>
        </ol>
        <div style="width: 75%;margin: 0 auto">


        <h3 style="color: #00938F">品牌一览表</h3>
        <hr>

            <ul class="band-name">
                @foreach($info as $keys=>$vo)
                    <li>
                        <a href="{{action('Home\IndexController@bandlist',['country'=>$key,'band'=>$keys])}}">{{$keys}} [{{$country}}]</a>
                    </li>
                @endforeach
            </ul>


   
        </div>
    </div>


    @script()


    @endscript
@endsection


@section("fis_resource")@parent @require('page/Home/band.blade.php')@stop