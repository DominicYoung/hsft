@extends('widget/layout/body.blade.php')

@section('title', '国球汇')
@section('body')

<div class="ui-footer ui-footer-stable ui-btn-group ui-border-t">
    <button class="ui-btn-lg ui-btn-green btn-sub">
        提交
    </button>
</div>
<section class="ui-container ui-center" style="margin-top: 100px;">

    <p class="ui-txt-highlight">功能测试期须凭邀请码发起比赛</p>
    <div class="ui-form ui-border" style="position: relative;top:30px;width:72%;">
        <form action="#">
            <div class="ui-form-item ui-form-item-pure ui-border-b">
                <input type="text" id="code" placeholder="请输入6位邀请码">
            </div>
        </form>
    </div>
</section>

@script()
    var $ = require('static/lib/frozenui/js/frozen');
    var loading=require('widget/loading/loading');
    loading('提交中...');
    $('.btn-sub').tap(function () {
        var _code=$('#code').val();
        if(_code==''||_code==undefined){
            alert('请填写邀请码');
            return;
        }
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/Home/invitation/bind',
            // data to be added to query string:
            data: {
                code:_code
            },
            // type of data we are expecting in return:
            dataType: 'json',
            success: function(data){
                alert(data);
                window.location.href="/Home/game/index";
            },
            error: function(xhr, errorType, error){

                alert(JSON.parse(xhr.responseText));

                console.log(xhr, errorType, error);
            }
        })
    });
    $('#code').on('focus',function () {
        $('.ui-container').css('position', 'fixed');
        $('.ui-container').css({'top':'-100px'});
    });
    $('#code').on('blur',function () {
        $('.ui-container').css('position', 'static');
    });
@endscript

@endsection


@section("fis_resource")@parent @require('page/Home/invitation/index.blade.php')@stop