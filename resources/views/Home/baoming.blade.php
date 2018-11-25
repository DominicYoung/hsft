@extends('widget/layout/body.blade.php')
@section('title',$info->title)
@section('body')
    <div class="share">
        <p>点击右上角，分享到朋友圈 <br>让喜欢乒乓球的朋友们来参赛吧~</p>
        <div class="top-arr"></div>
    </div>
    <div class="clearfix"></div>
    <ul class="ui-list ui-list-one  ui-border-tb baoming-list">
        <li class="ui-border-t">
            <div class="ui-list-icon">
                <span><i class="customiconfont">&#xe602;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">名称</h4>
                <div class="ui-txt-info">{{$info->title}}</div>
            </div>
        </li>
        <li class="ui-border-t">
            <div class="ui-list-icon">
                <span><i class="customiconfont">&#xe600;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">时间</h4>
                <div class="ui-txt-info">{{$info->starttime}}&nbsp;&nbsp;开始<br> {{substr($info->endtime,0,-9)}}&nbsp;&nbsp;结束</div>
            </div>
        </li>
        <li class="ui-border-t">
            <div class="ui-list-icon">
                <span><i class="customiconfont">&#xe603;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 style="display: inline-block;width: 50px">地点</h4>
                <div class="ui-txt-info" style="-webkit-box-flex: 1; ">{{$info->address}}{{$info->house}}</div>
            </div>
        </li>
        <li class="ui-border-t ui-form-item-link" id="route">
            <div class="ui-list-icon">
                <span><i style="display:block;margin-top: 3px" class="customiconfont">&#xe605;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">导航</h4>
                <div class="ui-txt-info">点击查看路线导航&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>
        </li>

        <li class="ui-border-t">
            <div class="ui-list-icon">
                <span><i class="customiconfont">&#xe604;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">人数上限</h4>
                <div class="ui-txt-info">{{$info->people}}人</div>
            </div>
        </li>
        <li class="ui-border-t">
            <div class="ui-list-icon">
                <span><i class="customiconfont">&#xe601;</i></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">报名时间</h4>
                <div class="ui-txt-info">截止到{{substr($info->deadline,0,-9)}}</div>
            </div>
        </li>
    </ul>
    <h2 class="padding10" style="padding-bottom: 0">赛事介绍及赛程详解:</h2>
    <div class="ui-scroller ui-border-tb">
        <div>
            {!! nl2br($info->note)  !!}
        </div>
    </div>
    <p class="padding10">发起者：{{$info->truename}}&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:{{$info->phone}}">{{$info->phone}}</a></p>
    <table class="ui-table ui-border-tb check-table">
        <tbody>
        <tr><td width="100">比赛分组</td><td style="text-align: left">
                @foreach ($info->groups as $vo)
                    {{$vo}}<br>
                @endforeach
            </td></tr>
        @if(!empty($info->customs))<tr><td colspan="2">您还需要填写：{{str_replace(',','，',$info->customs)}}</td></tr>@endif
        <tr><td>报名费</td><td  style="text-align: left"><a>{{$info->fee}}</a>&nbsp;元</td></tr>
        </tbody>
    </table>
    <p class="padding10">已有{{$count}}人报名，朋友们在等你一起开赛!</p>
    @if(count($users)>0)
    <a class="ui-arrowlink baoming-headimg-list" href="/Home/game/sports/{{$info->id}}">
        @foreach($users as $vo)
            <div>
                <div class="ui-avatar-s">
                    <span style="background-image:url({{$vo->headimg}})"></span>
                </div>
                <p style="width: 100%;overflow: hidden; height: 20px;">{{$vo->truename}}</p>
            </div>
        @endforeach
    </a>
    @endif
    <br>
    <div class="ui-btn-group bottom-tool">
        <button class="ui-btn-lg qrcode">
            比赛二维码
        </button>

        @if(isset($pay_status))


            @if($pay_status->pay_status==0)

                @if(time()<strtotime($info->starttime))
                    <a class="ui-btn-lg ui-btn-green" href="/Pay/toPay/{{$pay_status->id}}">
                        补交报名费
                    </a>
                    @else
                    <button class="ui-btn-lg ui-btn-green disabled" disabled>
                        补交报名费
                    </button>
                @endif

                <button class="ui-btn-lg ui-btn-green cancel" @if(time()>=strtotime($info->deadline))  disabled @endif >
                    取消报名
                </button>
            @elseif($pay_status->pay_status==1)
                <button class="ui-btn-lg ui-btn-green cancel "  @if(time()>=strtotime($info->deadline)) disabled @endif >
                    取消报名
                </button>
            @elseif($pay_status->pay_status==2)
                <button class="ui-btn-lg ui-btn-green disabled" disabled>
                    退款中
                </button>
            @endif



        @else

            @if(time()<strtotime($info->deadline))
                <a class="ui-btn-lg ui-btn-green baoming" href="/Home/join/index/{{$info->id}}">
                    我要报名
                </a>
            @else
                <button class="ui-btn-lg ui-btn-green disabled" disabled>
                    我要报名
                </button>
            @endif
        @endif

    </div>
    @script()

    var baoming=require('page/Home/baoming');
    baoming.cancel('.cancel','{{$pay_status->id or ""}}');
    baoming.router("{{$info->address}}","{{action('Home\GameController@baoming',['id'=>$info->id])}}");
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

@section("fis_resource")@parent @require('page/Home/baoming.blade.php')@stop