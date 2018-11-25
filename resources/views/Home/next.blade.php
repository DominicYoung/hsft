@extends('widget/layout/body.blade.php')
@section('title', '我发起的比赛')
@section('body')
    <input type="hidden" name="id" id="ids" value="{{$id}}">


    <section class="ui-panel">
        <ul class="ui-list ui-list-function ui-border-tb group-list">
        </ul>
    </section>
    <div id="next-page">
        <section class="ui-panel">
            <ul class="ui-list ui-list-function ui-border-tb">
                <li class="ui-border-t">
                    <div class="ui-list-info">
                        <h4 class="ui-nowrap">设置比赛分组</h4>
                    </div>
                    <div class="ui-btn" id="addgroup">添加</div>
                </li>
            </ul>
        </section>

        <section class="ui-panel">
            <ul class="ui-list ui-list-function ui-border-tb custom-list">
            </ul>
        </section>
        <section class="ui-panel">
            <ul class="ui-list ui-list-function ui-border-tb">
                <li class="ui-border-t">
                    <div class="ui-list-info">
                        <h4 class="ui-nowrap">增加自定义选项</h4>
                        <h6 class="ui-txt-warning">如会员卡号、学生证号、积分水平等</h6>
                    </div>
                    <div class="ui-btn" id="addcustom">添加</div>
                </li>
            </ul>
        </section>


  <div class="ui-form ui-border-t ui-panel">
      <form action="#" id="form1">
          <div class="ui-form-item ui-form-item-l ui-border-b">
              <label class="ui-border-r">
                  比赛报名费
              </label>
              <input type="number" value="" placeholder="只填写金额数字即可" name="fee" id="fee">
          </div>
          <div class="ui-form-item ui-form-item-switch ui-border-b havetips ">
              <p>
                  报名时，是否填写单位
              </p>
              <h6 class="ui-txt-warning">便于辨识来自同单位的选手</h6>

              <label class="ui-switch">
                  <input type="checkbox" name="danwei" value="1" id="danwei">
              </label>
          </div>

      </form>
  </div>
        <div class="ui-form ui-border-t">
            <h6 class="padding10 ui-border-b ui-txt-warning">您填写的手机号码，将作为收取报名费的账户凭证，也是报名者咨询赛事信息的重要途径。</h6>
            <form action="#" id="form2">
                <div class="ui-form-item ui-form-item-pure ui-border-b">
                    <input type="text" placeholder="真实姓名" value="" name="truename" id="truename">
                </div>
                <div class="ui-form-item ui-form-item-pure ui-border-b">
                    <input type="tel" id="phone" value="" placeholder="手机号码">
                </div>
                <div class="ui-form-item ui-form-item-r ui-border-b">
                    <input type="text" placeholder="请输入验证码" name="code" id="code">
                    <!-- 若按钮不可点击则添加 disabled 类 -->
                    <button type="button" id="sendVerifySmsButton" class="ui-border-l">发送验证码</button>
                </div>
                <br>
                <div class="ui-btn-wrap">
                    <button type="button" class="ui-btn-lg ui-btn-green btn-sub">
                        下一步
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="ui-dialog">
        <div class="ui-dialog-cnt">
            <div class="ui-dialog-bd">
                <div>
                    <input type="text" placeholder="组别名称" id="groupname" class="ui-border-b" style="width: 100%;height: 40px;">
                </div>
            </div>
            <div class="ui-dialog-ft ui-btn-group">
                <button type="button" data-role="button"  >关闭</button>
                <button type="button" data-role="button"  class="select" id="dialogButton">确定</button>
            </div>
        </div>
    </div>
    @script()
        var next=require('page/Home/next');
        next.group('#addgroup');
        next.group('#addcustom');
        next.sms("{{csrf_token()}}");
        next.sub('.btn-sub');
    @endscript
@endsection
@section("fis_resource")@parent @require('page/Home/next.blade.php')@stop