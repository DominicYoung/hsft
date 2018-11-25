@extends('widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="/plupload/o_1aodhre7b1n20tar16j5ipmbc17.jpg" alt="">
    </div>
    <div class="container">
        <br>

        <div class="row">

            <div class="col-sm-12">
                <h3 style="color: #00938F">{{$info->title}}</h3>
                <hr>
                <div>
                {!! $info->content !!}


                </div>

            </div>
        </div>


    </div>


@endsection


@section("fis_resource")@parent @require('page/Home/article.blade.php')@stop