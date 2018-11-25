@extends('/widget/layout/Home/body.blade.php')


@section('title', $news->title)
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($info->pic)?'http://o9gwxz92f.bkt.clouddn.com/1-150G023023LY.jpg':$info->pic}}" alt="">
    </div>
    <div class="container">
        <br>


        <div class="row">
            <div class="col-sm-3">
                <div class="wokao">
                    <section>
                        <ul>
                            <li>
                                <h4 class="open"> <strong >栏目导航</strong></h4>
                                <div class="normal-list">
                                    <ul>
                                        @foreach($bro as $vo)
                                        <li><a href="{{action('Home\IndexController@news',['id'=>$vo->id])}}">{{$vo->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </section>

                </div>



                <br>
            </div>
            <div class="col-sm-9">
                <h3 style="color: #00938F;">{{$news->title}}</h3>
                <hr>
                <div>
                    {!! $news->content !!}


                </div>
                <br><br>
            </div>
        </div>


    </div>


    @script()
    require('./index.js');

    @endscript
@endsection


