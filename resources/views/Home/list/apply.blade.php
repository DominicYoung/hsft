@extends('widget/layout/body.blade.php')
@section('title', $info->title)
@section('body')
    <div class="padding10">
        <h3>您已成功报名！共有{{count($apply)}}位参赛者</h3>
    </div>
    <section class="ui-panel headimg-list ui-border-t">
        <ul class="ui-grid-trisect ui-border-b">
            @foreach($apply as $vo)
                <li>
                    <div class="ui-avatar-lg">
                        <span style="background-image:url({{$vo->headimg}})"></span>
                    </div>
                    <h4 class="ui-nowrap ui-whitespace">{{$vo->truename}}</h4>
                </li>
            @endforeach
        </ul>
    </section>

    <table class="ui-table ui-border-tb check-table">
        <tbody>
        <tr><td width="80">开始时间</td><td style="text-align: left">{{$info->starttime}}</td></tr>
        <tr><td >结束时间</td><td style="text-align: left">{{$info->endtime}}</td></tr>
        <tr><td >比赛地点</td><td style="text-align: left"><a  id="route">{{$info->address}}{{$info->house}}</a></td></tr>
        @if(!empty($is_pay->zubie))<tr><td >参加组别</td><td style="text-align: left">{{$is_pay->zubie}}</td></tr>@endif
        <tr><td >联系人</td><td style="text-align: left">{{$info->truename}}：<a href="tel:{{$info->phone}}">{{$info->phone}}</a></td></tr>

        </tbody>
    </table>


    <div class="ui-footer ui-footer-stable ui-btn-group ui-border-t bottom-tool">
        <a class="ui-btn-lg" href="/Home/list/join">
            返回
        </a>
        @if(isset($is_pay))


            @if($is_pay->pay_status==0)

                @if(time()<strtotime($info->starttime))
                    <a class="ui-btn-lg ui-btn-green" href="/Pay/toPay/{{$is_pay->id}}">
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
            @elseif($is_pay->pay_status==1)
                <button class="ui-btn-lg ui-btn-green cancel "  @if(time()>=strtotime($info->deadline)) disabled @endif >
                    取消报名
                </button>
            @elseif($is_pay->pay_status==2)
                <button class="ui-btn-lg ui-btn-green disabled" disabled>
                    退款中
                </button>
            @endif

        @endif
    </div>
    @script()
        var main = require('page/Home/list/apply');
        main.cancel('.cancel','{{$is_pay->id or ""}}');
        main.router("{{$info->address}}","{{action('Home\ListController@apply',['id'=>$info->id])}}");
    @endscript
@endsection
@section("fis_resource")@parent @require('page/Home/list/apply.blade.php')@stop