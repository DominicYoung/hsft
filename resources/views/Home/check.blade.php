@extends('widget/layout/body.blade.php')
@section('title', '比赛信息确认')
@section('body')
    <section class="ui-container check-table">
        <table class="ui-table ui-border-b">
            <tbody>
            <tr><td width="70">标题</td><td>{{$info->title}}</td></tr>
            <tr><td>时间</td><td>{{$info->starttime}}至{{substr($info->endtime,0,-9)}}</td></tr>
            <tr><td>地点</td><td>{{$info->address}}{{$info->house}}</td></tr>
            <tr><td>人数上限</td><td>{{$info->people}}人</td></tr>
            <tr><td>报名时间</td><td>截止到{{substr($info->deadline,0,-9)}}</td></tr>
            </tbody>
        </table>
        <h2 class="padding10" style="padding-bottom: 0;">赛事介绍及赛程详解:</h2>
        <div class="ui-scroller ui-border-t">
            <div>
                {!! nl2br($info->note)  !!}
            </div>
        </div>
        <table class="ui-table ui-border-tb">
            <tbody>
            <tr><td width="120">比赛分组</td><td align="right">
                    @foreach ($info->groups as $vo)
                        {{$vo}}<br>
                    @endforeach
                </td>
            </tr>
            @foreach($info->customs as $vo)
                <tr>
                    <td>{{$vo}}</td>
                    <td align="right">需报名者填写</td>
                </tr>
            @endforeach
            <tr><td>报名费</td><td><a>{{$info->fee}}</a>元</td></tr>
            <tr><td>已开启单位选项</td><td><a>
                        @if($info->danwei==1)
                            是
                        @else
                            否
                        @endif
                    </a></td></tr>
            <tr><td>已有报名</td><td><a>0</a>人</td></tr>
            </tbody>
        </table>
        <br><br><br>
    </section>
        <div class="ui-btn-group ui-footer ui-footer-stable">
            {{--<button class="ui-btn-lg pre">--}}
                {{--上一步--}}
            {{--</button>--}}
            <button class="ui-btn-lg ui-btn-green btn-sub">
                确认发布
            </button>
        </div>

    @script()
        var check=require('page/Home/check');
        check.sub('.btn-sub','{{$info->id}}');

    @endscript

@endsection
@section("fis_resource")@parent @require('page/Home/check.blade.php')@stop