@extends('/widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')
    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($category->pic)?'http://o9gwxz92f.bkt.clouddn.com/1-150G023023LY.jpg':$category->pic}}" alt="">

    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">

            <li><a href="{{action('Home\IndexController@news',['id'=>$first])}}">{{$pidname}}</a></li>

            <li ><a href="{{action('Home\IndexController@news',['id'=>$info->category])}}">{{$category->title}}</a></li>
            <li class="active">{{$info->title}}</li>
        </ol>
        <div style="width: 75%;margin: 0 auto">
            <h3>{{$info->title}}</h3>
            <img src="{{$info->titlepic}}" width="223" alt="">
            <hr>

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs detail-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">概述</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">特性</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">参数</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">订货</a></li>
                    <li role="presentation"><a href="#kinds" aria-controls="kinds" role="tab" data-toggle="tab">型号</a></li>
                    <li role="presentation"><a href="#pic" aria-controls="pic" role="tab" data-toggle="tab">尺寸图</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content detail-tabs-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        {!! $info->gaishu !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        {!! $info->texing !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        {!! $info->canshu !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">
                        {!! $info->dinghuo !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="kinds">
                        {!! $info->xinghao !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="pic">
                        {!! $info->chicuntu !!}
                    </div>
                </div>

            </div>
        </div>


    </div>


    @script()

    @endscript
@endsection


