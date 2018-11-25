define('page/Admin/refund/index', function(require, exports, module) {

  /**
   * Created by zhoufan on 2015/12/28.
   */
  var $ = require('static/lib/datatables/js/dataTables.bootstrap');
  
  $('.nav-tabs').click(function(e){
      if ( e && e.stopPropagation )
          e.stopPropagation();
      else
          window.event.cancelBubble = true;
  });
  
  var bs=require('components/bootstrap/bootstrap');
  $(document).ready(function() {
      var _url='/admin/refund/getList';
      if(_id!=undefined&&_id!=''){
          _url= "/admin/refund/getList/"+_id;
      }
      var table=$('#example').DataTable({
          "processing": true,
          "bLengthChange": false,
          "iDisplayLength": 25,
          "serverSide": true,
          "ajax": _url,
          "order": [[ 0, 'desc' ]],
          "columns": [
              { "data": "id" },
              { "data": "pay_time" },
              { "data": "title" },
              { "data": "tags",
                  "searchable": true,
              },
              { "data": "money" },
              { "data": "pay_status",
                  "render":function(data){
                      var _status='';
                      switch (data){
                          case '1':_status='<span class="label bg-blue">支付成功</span>';break;
                          case '2':_status='<span class="label bg-green">申请退款</span>';break;
                          case '3':_status='<span class="label bg-red">退款成功</span>';break;
                          case '4':_status='<span class="label bg-orange">退款处理中</span>';break;
                      }
                      return _status;
                  }
              },
              { "data": "truename",
                  "render":function(data){
                      return '<a style="cursor: pointer" data-type="getInfo">'+data+'</a>';
                  }
              },
              { "data": "phone"},
              {
                  "orderable": false,
                  "data" :"pay_status",
                  "render":function(data){
                      if(data!=1&&data!=2){
                          return  '<button type="button" class="btn bg-purple btn-flat" data-type="detail"><i class="fa fa-bars"></i> 查看详情</button>';
                      }else{
                          return  '<button type="button" data-to="ss" class="btn bg-orange btn-flat " data-type="finance"><i class="fa fa-exchange"></i> 退款</button>';
                      }
                  }
              }
          ],
          language: {
              searchPlaceholder: "姓名、电话、编号",
              emptyTable: "暂无比赛",
              "search": "搜索:"
          }
      });
  
      $('#example_filter').append( '<label>搜索:<input type="search" class="form-control input-sm" placeholder="标签" id="tags-input" aria-controls="example"></label>' );
  
      $('#tags-input').on( 'keyup click', function () {
          if(timer!==undefined){
              clearTimeout(timer);
          }
          var timer=setTimeout(function(){
              table.column( 3 ).search(
                  $('#tags-input').val()
              ).draw();
          },300);
  
      } );
  
  
      $('#example tbody').on( 'click', 'button,a', function () {
          var data = table.row( $(this).parents('tr') ).data();
          var _type=$(this).attr('data-type');
          switch (_type){
              case 'getInfo'   :;
              case 'detail'   : detail(data.id);break;
              case 'finance'  : finance(data.id);break;
          }
      } );
  
      function detail(id){
          bs('#myModal').modal();
          $( "#myModal .modal-content" ).load('/admin/refund/detail/'+id);
      }
      function finance(id){
          bs('#myModal').modal();
          $( "#myModal .modal-content" ).load('/admin/refund/refund/'+id);
      }
  
      $('#myModal').on('click','.subrefund',function(){
          var _that=$(this);
          _that.attr('disabled',true);
          _that.text('提交中...');
          $.ajax({
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '/admin/refund/doRefund',
              // data to be added to query string:
              data: $("#refundform").serialize(),
              // type of data we are expecting in return:
              dataType: 'json',
              success: function(data){
                  console.log(data);
                  alert(data);
                  window.location.reload();
              },
              error: function(xhr, errorType, error){
                  _that.attr('disabled',false);
                  _that.text('提交');
                  alert(JSON.parse(xhr.responseText));
  
                  console.log(xhr, errorType, error);
              }
          })
      });
  });

});
