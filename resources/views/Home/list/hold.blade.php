@extends('widget/layout/body.blade.php')
@section('title', $info->title)
@section('body')
    <div class="padding10">
        @if($days>0)
            <h3>距离报名截止还有{{$days}}天</h3>
         @else
            <h3>报名已结束</h3>
        @endif
        <h3>已有{{count($apply)}}人报名，剩余{{$info->people-count($apply)}}个名额</h3>
    </div>
    <section class="ui-panel headimg-list ui-border-t">
        <ul class="ui-grid-trisect ui-border-b">
            @foreach($apply as $vo)
            <li data-info="{{$vo->truename}},{{$vo->phone}},{{$vo->pay_status}},{{$vo->zubie}},{{$vo->danwei}},{{$vo->sex}}">
                <div class="ui-avatar-lg">
                    <span style="background-image:url({{$vo->headimg}})"></span>
                </div>
                <h4 class="ui-nowrap ui-whitespace">{{$vo->truename}}</h4>
            </li>
          @endforeach
        </ul>
    </section>

    @if($days>0)
    <div class="ui-form ui-border-t ui-panel" id="next-page">
        <form action="#">
            <div class="ui-form-item ui-form-item-switch ui-border-b havetips ">
                <p>
                    是否暂停报名
                </p>
                <h6 class="ui-txt-warning">@if($info->pause==1)已暂停报名，点击可恢复 @elseif($info->adminpause==1)管理员已暂停报名@else 正在报名中，点击可暂停 @endif</h6>

                <label class="ui-switch checkbox-tips">
                    @if($info->pause==1||$info->adminpause==1)
                        <button type="button" class="ui-btn pause-action">
                            开始
                        </button>
                        @else
                        <button type="button" class="ui-btn pause-action">
                            暂停
                        </button>
                    @endif
                </label>
            </div>

        </form>
    </div>
    @endif
    <h5 class="ui-txt-muted padding10">如想正式关停、删除比赛，或者对功能有任何疑问，可在“国球汇”微信服务号里回复“客服”，联系工作人员</h5>
    <br><br><br>
    <div class="ui-btn-wrap">
        <a class="ui-btn-lg ui-btn-green" href="/Home/list/export/{{$info->id}}">
            导出excel名单
        </a>
    </div>
    <div class=" ui-btn-group">
        <a class="ui-btn-lg" href="/Home/list/index">
            返回
        </a>
        <a class="ui-btn-lg ui-btn-primary" href="/Home/game/baoming/{{$info->id}}">
            分享比赛
        </a>
    </div>

    @script()
    var main = require('page/Home/list/hold');
    main.pause('.pause-action','{{$info->id}}');
    main.getUserInfo('.headimg-list li');
    @endscript

    <div class="ui-dialog">
        <div class="ui-dialog-cnt">
            <header class="ui-dialog-hd ui-border-b">
                <h3>报名二维码</h3>

            </header>
            <div class="ui-dialog-bd">
                <div>
                    <img width="100%" src="{{$info->qrcode}}">
                </div>
            </div>
            <div class="ui-dialog-ft ui-center">
                <p class="ui-txt-muted">长按二维码，报名参赛</p>
            </div>

        </div>
    </div>
@endsection
@section("fis_resource")@parent @require('page/Home/list/hold.blade.php')@stop