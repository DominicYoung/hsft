define('components/sms/sms', function(require, exports, module) {

  /**
   * Created by zhoufan on 2015/12/15.
   */
  /*
   * send verify sms
   *---------------------------
   * top lan <toplan710@gmail.com>
   * https://github.com/toplan/laravel-sms
   * --------------------------
   * Date 2015/06/08
   */
  var Zepto = require('components/zepto/main');
  (function($){
  
      $.fn.sms = function(options){
          var opts = $.extend(
              $.fn.sms.default,
              options
          );
          $(document).on('click', this.selector, function(e){
              var _this = $(this);
              opts = $.extend(
                  opts,
                  {btnContent: _this.html()}
              );
              _this.html('短信发送中...');
              _this.prop('disabled', true);
              _this.addClass('disabled');
              sendSms(opts, _this)
          });
      };
  
      function sendSms(opts, elem) {
          var mobile = $(opts.mobileSelector).val();
          if($.trim(mobile)==''|| $.trim(mobile)==undefined){
              opts.alertMsg('手机号必填');
              elem.html(opts.btnContent);
              elem.prop('disabled', false);
              elem.removeClass('disabled');
              return false;
          }
          var url = opts.domain + '/sms/verify-code';
          if (opts.voice) {
              url = opts.domain + '/sms/voice-verify';
          }
          $.ajax({
              url  : url,
              type : 'post',
              data : {
                  _token:opts.token,
                  seconds:opts.seconds,
                  uuid:opts.uuid,
                  mobile:mobile,
                  mobileRule:opts.mobileRule
              },
              success : function (data) {
                  if (data.success) {
                      opts.alertMsg(data.message, data.type);
                      timer(elem, opts.seconds, opts.btnContent)
                  } else {
                      elem.html(opts.btnContent);
                      elem.prop('disabled', false);
                      elem.removeClass('disabled');
                      opts.alertMsg(data.message, data.type);
                  }
              },
              error: function(xhr, type){
                  elem.html(opts.btnContent);
                  elem.prop('disabled', false);
                  elem.removeClass('disabled');
                  opts.alertMsg('请求失败，请重试');
              }
          });
      }
  
      function timer(elem, seconds, btnContent){
          if(seconds >= 0){
              setTimeout(function(){
                  //显示倒计时
                  elem.html('再次发送 '+seconds+'s' );
                  //递归
                  seconds -= 1;
                  timer(elem, seconds, btnContent);
              }, 1000);
          }else{
              elem.html(btnContent);
              elem.prop('disabled', false);
              elem.removeClass('disabled');
          }
      }
  
      $.fn.sms.default = {
          token          : '',
          mobileRule     : '',
          mobileSelector : '',
          seconds        : 60,
          uuid           : '',
          voice          : false,
          domain         : '',
          alertMsg       : function (msg, type) {
              alert(msg);
          }
      };
  
  })(Zepto);
  module.exports = Zepto;

});
