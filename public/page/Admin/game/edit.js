define('page/Admin/game/edit', function(require, exports, module) {

  /**
   * Created by zhoufan on 2015/12/24.
   */
  var $=require('static/lib/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN');
  
  $('#starttime').datetimepicker({
      format: 'yyyy-mm-dd hh:ii',
      autoclose:true,
      minuteStep:10,
      language:'zh-CN'
  });
  $('#endtime').datetimepicker({
      format: 'yyyy-mm-dd',
      autoclose:true,
      minView:2,
      language:'zh-CN'
  });
  $('#deadline').datetimepicker({
      format: 'yyyy-mm-dd',
      autoclose:true,
      minView:2,
      language:'zh-CN'
  });
  
  var bs=require('components/bootstrap/bootstrap');
  $('.infoad').click(function () {
      bs('#myModal').modal();
      $( "#myModal .modal-content" ).load('/admin/games/map/'+$('#map').val());
  });
  window.addEventListener('message', function(event) {
      // 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
      var loc = event.data;
      $('#map').val(loc.poiaddress);
      console.log('location', loc);
      $('#myModal').modal('hide');
  }, false);
  
  $(document).ready(function(){
      $('#myForm').on('submit', function(e){
          e.preventDefault();
          if (validate()) {
              this.submit();
          }
      });
  });
  
  
  function validate(){
      var _starttime=$('input[name="starttime"]').val();
      var _endtime=$('input[name="endtime"]').val();
      var _deadline=$('input[name="deadline"]').val();
      if(isOneday(_starttime,_deadline)){
          _deadline=_starttime;
      }else{
          _deadline=_deadline+' 23:59:59';
      }
      _endtime=_endtime+' 23:59:59';
  
      if($('input[name="people"]').val()<=0){
          alert('人数必须大于0');
          return false;
      }
  
      if( Date.parse(_starttime.replace(/\s/g,'T'))>Date.parse(_endtime.replace(/\s/g,'T'))){
          alert('比赛开始时间必须早于结束时间');
          return false;
      }
      if( Date.parse(_deadline.replace(/\s/g,'T'))<Date.parse(new Date())){
          alert('比赛截止时间必须早于当前时间');
          return false;
      }
      if( Date.parse(_deadline.replace(/\s/g,'T'))>Date.parse(_starttime.replace(/\s/g,'T'))){
          alert('报名截止时间必须早于比赛开始时间');
          return false;
      }
  
      return true;
  
  }
  
  function isOneday(str,other){
      var d = new Date(str.replace(/-/g,"/"));
      var t = new Date(other.replace(/-/g,"/"));
  
      if(d.setHours(0,0,0,0) == t.setHours(0,0,0,0)){
          return true;
      } else {
          return false;
      }
  }

});
