@extends('widget/layout/body.blade.php')
@section('title','参赛者列表')
@section('body')
<section class="ui-panel ui-border-t">
    <p class="padding10 sportstips">以球会友，{{$count}}位朋友等你开赛，还有{{$people-$count}}个名额</p>
    <ul class="ui-grid-trisect ui-border-b">
        <div class="clearfix"></div>
        @foreach($info as $vo)
            <li>
                <div class="ui-avatar-lg" style="margin: 0 auto">
                    <span style="background-image:url({{$vo->headimg}})"></span>
                </div>
                <h4 style="text-align: center" class="ui-nowrap ui-whitespace">{{$vo->truename}}</h4>
            </li>
        @endforeach
    </ul>
</section>
<br><br>
<div class="ui-footer ui-footer-stable ui-btn-group ui-border-t">
    <a class="ui-btn-lg ui-btn-green" href="/Home/game/baoming/{{$id}}">
        返回
    </a>
</div>

@endsection

@section("fis_resource")@parent @require('page/Home/sports.blade.php')@stop