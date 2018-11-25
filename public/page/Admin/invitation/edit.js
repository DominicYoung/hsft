define('page/Admin/invitation/edit', function(require, exports, module) {

  /**
   * Created by zhoufan on 2016/1/6.
   */
  
  var $=require('static/lib/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN');
  
  $('#deadline').datetimepicker({
      format: 'yyyy-mm-dd hh:ii:ss',
      autoclose:true,
      language:'zh-CN'
  });

});
