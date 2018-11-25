@extends('widget/layout/Home/body.blade.php')


@section('title', $info->title)
@section('body')
    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($category->pic)?'/plupload/company&contact.jpg':$category->pic}}" alt="">

    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">

            <li><a href="{{action('Home\IndexController@news',['id'=>$first])}}">{{$pidname}}</a></li>

            <li ><a href="{{action('Home\IndexController@news',['id'=>$info->category])}}">{{$category->title}}</a></li>
            <li class="active">{{$info->title}}</li>
        </ol>
        <div style="width: 75%;margin: 0 auto">
            <h3  style="color: #00938f;">{{$info->title}}</h3>
            <img src="{{$info->titlepic}}" style="margin-top:30px" width="223" alt="">
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
                <div class="tab-content detail-tabs-content"  onmousemove=\HideMenu()\ oncontextmenu="return false" ondragstart="return false" onselectstart ="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onbeforecopy="return false" onmouseup="document.selection.empty()">
                    <div role="tabpanel" class="tab-pane active" id="home" style="color: #595959;">
                        {!! $info->gaishu !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile" style="color: #595959;">
                        {!! $info->texing !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages" style="color: #595959;">
                        {!! $info->canshu !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings" style="color: #595959;">
                        {!! $info->dinghuo !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="kinds" style="color: #595959;">
                        {!! $info->xinghao !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="pic" style="color: #595959;">
                        {!! $info->chicuntu !!}
                    </div>
                </div>

            </div>
        </div>


    </div>


    @script()

    @endscript
@endsection


@section("fis_resource")@parent @require('page/Home/detail.blade.php')@stop