define('page/Admin/news/edit', function(require, exports, module) {

  /**
   * Created by zhoufan on 2016/1/5.
   */
  require('static/lib/plupload/plupload');
  var $=require('components/jquery/jquery');
  var _token=$('meta[name="csrf-token"]').attr('content');
  var uploader = new plupload.Uploader({
      browse_button: 'upload-pic', // this can be an id of a DOM element or the DOM element itself
      url: '/admin/upload',
      max_file_size : '5mb',
      chunk_size : '1mb',
      unique_names : true,
      dragdrop : true,
      multiple_queues : false,
      multi_selection : false,
      max_file_count : 1,
      headers: {
          'X-CSRF-TOKEN': _token
      },
      init : {
          FilesAdded: function(up, files) {
                  up.start();
  
          },
          FileUploaded:function(up, file, info){
              var response = JSON.parse(info.response);
              $('#titlepic').val(response.result);
          }
      }
  });
  
  uploader.init();
  
  var uploader1 = new plupload.Uploader({
      browse_button: 'upload-file', // this can be an id of a DOM element or the DOM element itself
      url: '/admin/upload',
      max_file_size : '100mb',
      chunk_size : '1mb',
      unique_names : true,
      dragdrop : true,
      multiple_queues : false,
      multi_selection : false,
      max_file_count : 1,
      headers: {
          'X-CSRF-TOKEN':_token
      },
      init : {
          FilesAdded: function(up, files) {
              up.start();
  
          },
          FileUploaded:function(up, file, info){
              var response = JSON.parse(info.response);
              $('#fileurl').val(response.result);
          }
      }
  });
  
  uploader1.init();
  
  
  <!-- 实例化编辑器 -->
  
  var shuxing = UE.getEditor('shuxing',{
      retainOnlyLabelPasted:true
  });
  shuxing.ready(function() {
      shuxing.setHeight(250);
      shuxing.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  
  var gaishu = UE.getEditor('gaishu',{
      retainOnlyLabelPasted:true
  });
  gaishu.ready(function() {
      gaishu.setHeight(250);
      gaishu.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var texing = UE.getEditor('texing',{
      retainOnlyLabelPasted:true
  });
  texing.ready(function() {
      texing.setHeight(250);
      texing.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var canshu = UE.getEditor('canshu',{
      retainOnlyLabelPasted:true
  });
  canshu.ready(function() {
      canshu.setHeight(250);
      canshu.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var dinghuo = UE.getEditor('dinghuo',{
      retainOnlyLabelPasted:true
  });
  dinghuo.ready(function() {
      dinghuo.setHeight(250);
      dinghuo.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var xinghao = UE.getEditor('xinghao',{
      retainOnlyLabelPasted:true
  });
  xinghao.ready(function() {
      xinghao.setHeight(250);
      xinghao.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var chicuntu = UE.getEditor('chicuntu',{
      retainOnlyLabelPasted:true
  });
  chicuntu.ready(function() {
      chicuntu.setHeight(250);
      chicuntu.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  var content = UE.getEditor('nr',{
      retainOnlyLabelPasted:true
  });
  content.ready(function() {
      content.setHeight(250);
      content.execCommand('serverparam', '_token', _token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
  });
  

});
