@extends('widget/layout/body.blade.php')
@section('title','参加'.$info->title)
@section('body')

    @if($status['code']==1)

    <div class="ui-form ui-border-t">
        <form action="#" id="join-form">
            <input type="hidden" name="id" id="gameid" value="{{$info->id}}">
            <div class="ui-form-item ui-border-b">
                <label>
                    姓名
                </label>
                <input type="text" placeholder="姓名" value="{{$member->truename or ''}}" name="truename">
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    手机
                </label>
                <input type="tel" placeholder="手机号码" value="{{$member->phone or ''}}" name="phone">
            </div>
            <div class="ui-form-item ui-form-item-radio ui-border-b">
                <label>
                    性别
                </label>
                <div class="ui-form-item ui-form-item-radio" style="padding-left: 95px;">
                    <label class="ui-radio" for="radio">
                        <input type="radio" value="1"
                               @if(isset($member->sex)&&$member->sex==1)
                               checked
                               @endif
                               name="sex">
                    </label>
                    <p>男</p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="ui-radio" for="radio">
                        <input type="radio" value="2"
                               @if(isset($member->sex)&&$member->sex==2)
                                 checked
                               @endif

                        name="sex">
                    </label>
                    <p>女</p>
                </div>

            </div>
            <div class="ui-form-item ui-form-item-link ui-border-b">
                <label>
                    生日
                </label>
                <input type="text" id="picktime" name="birthday" value="{{$member->birthday or ''}}" placeholder="请填写您的真实生日，便于选择参赛组别" readonly>

            </div>
            {{--<div class="ui-form-item ui-form-item-link ui-border-b" style="height: 60px; line-height: 60px">--}}
                {{--<label>--}}
                    {{--生日--}}
                {{--</label>--}}
                {{--<input type="text" id="picktime" name="birthday" value="{{$member->birthday or ''}}" placeholder="" readonly>--}}
                {{--<h6 class="ui-txt-muted" style="position: absolute;bottom: -16px">请填写您的真实生日，便于选择参赛组别。</h6>--}}

            {{--</div>--}}
            @if($info->danwei==1)
                <div class="ui-form-item ui-border-b">
                    <label>
                        单位
                    </label>
                    <div  class="searchTips">
                        <input type="text" placeholder="单位" name="danwei" id="danwei-input">
                        <ul id="tip-keys" class=" ui-border-l ui-border-b">

                        </ul>
                    </div>
                </div>
            @endif
            @foreach($info->customs as $vo)
                <div class="ui-form-item ui-border-b">
                    <label>
                        {{$vo}}
                    </label>
                    <input type="text" placeholder="{{$vo}}" data-type="{{$vo}}" name="customname[]">
                </div>
            @endforeach

            <h3 class="padding10 ui-border-tb" style="background:#F8F8F8;">选择参赛组别</h3>
            @foreach($info->groups as $vo)
                <div class="ui-form-item ui-form-item-radio ui-border-b">
                    <label class="ui-radio" >
                        <input type="radio" name="zubie" value="{{$vo}}">
                    </label>
                    <p>{{$vo}}</p>
                </div>
            @endforeach
            <input type="hidden" name="custom" id="custom">
            <div class="ui-btn-wrap">
                <button type="button" class="ui-btn-lg ui-btn-green btn-sub">
                    确认提交
                </button>
            </div>
        </form>
    </div>
    @else
        <section class="ui-notice">
            <i></i>
            <p>{{$status['msg']}}</p>
            {{--<div class="ui-notice-btn">--}}
                {{--<button class="ui-btn-primary ui-btn-lg">按钮</button>--}}
            {{--</div>--}}
        </section>
    @endif

    <style>
        #picktime::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            font-size: 10px;
        }
    </style>

@script()
    var danwei='{{$info->danwei}}';
    var date=new Date();
    var times='1950~'+(date.getFullYear()+1);
    var index=require('page/Home/Join/index');
    index.sub('.btn-sub',danwei);
    index.picktime('#picktime',{
    mode:1,
    years:times,
    defaulttime:'1980-01-01 00:00'
    });
    @endscript
@endsection

@section("fis_resource")@parent @require('page/Home/Join/index.blade.php')@stop