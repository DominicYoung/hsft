@extends('widget/layout/body.blade.php')
@section('title', $title)
@section('body')
    @if(count($info)>0)
    <div id="mygame">
        <ul class="ui-border-tb">
            <li class="ui-border-t red">
                <p class="active">报名中</p>
                @if(isset($info['ing']))
                <ul class="ui-list ui-list-pure ui-border-tb" style="display: block;">

                        @foreach($info['ing'] as $vo)
                            <li class="ui-border-t {{$vo['game_class']}}">

                                <a href="{{$vo['url']}}">
                                    <h4 class="ui-nowrap-multi ui-whitespace">{{$vo['title']}}</h4>
                                    <p class="ui-txt-tips"><span>开始时间：</span><span class="date"> {{substr($vo['starttime'],0,16)}}</span>&nbsp;&nbsp;<span class="ui-txt-warning ui-txt-tips">@if($vo->pause==1||$vo->adminpause==1)报名暂停中 @endif</span></p>
                                </a>
                            </li>
                        @endforeach

                </ul>
                @endif
            </li>
            <li class="ui-border-t">
                <p class="active">报名截止</p>
                @if(isset($info['done']))
                <ul class="ui-list ui-list-pure ui-border-tb" style="display: block;">

                    @foreach($info['done'] as $vo)
                        <li class="ui-border-t {{$vo['game_class']}}">

                            <a href="{{$vo['url']}}">
                                <h4 class="ui-nowrap-multi ui-whitespace">{{$vo['title']}}</h4>
                                <p class="ui-txt-tips"><span>开始时间：</span><span class="date"> {{substr($vo['starttime'],0,16)}}</span>&nbsp;&nbsp;<span class="ui-txt-warning ui-txt-tips">@if($vo->pause==1||$vo->adminpause==1)报名暂停中 @endif</span></p>
                            </a>
                        </li>
                    @endforeach

                </ul>

                @endif
            </li>
        </ul>

    </div>
    @else
    <section class="ui-placehold-wrap">
        <div class="ui-placehold"><br><br><br>您还没有报名参赛哦！<br>
            想知道都有哪些比赛吗？<br>
            可以问问组织者 <br>也可用国球汇平台发起比赛
        </div>
    </section>
    @endif

    @script()
    require('page/Home/list/list');
    @endscript

@endsection
@section("fis_resource")@parent @require('page/Home/list/list.blade.php')@stop