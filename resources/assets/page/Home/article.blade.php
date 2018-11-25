@extends('/widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="http://o9gwxz92f.bkt.clouddn.com/1-150G023023LY.jpg" alt="">
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


