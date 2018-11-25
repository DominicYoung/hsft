define('page/Admin/finance/index', function(require, exports, module) {

  /**
   * Created by zhoufan on 2015/12/25.
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
      var _url='/admin/finance/getList';
      if(_id!=undefined&&_id!=''){
          _url= "/admin/finance/getList/"+_id;
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
              { "data": "openid" },
              { "data": "nickname" },
              { "data": "title" },
              { "data": "tags"},
              { "data": "deadline",
                  "render":function(data){
                      return data.substr(0,10);
                  }
              },
              { "data": "fee"},
              { "data": "count" },
              { "data": null,
                  "render":function(data){
                      return data.fee*data.count;
                  }
              },
              { "data": "status",
                  "render":function(data){
                      var _status='';
                      switch (data*1){
                          case 1:_status='<span class="badge bg-blue">转账中</span>';break;
                          case 2:_status='<span class="badge bg-green">转账成功</span>';break;
                          //case '2':_status='<span class="badge bg-red">转账失败</span>';break;
                          default:_status='<span class="badge bg-aqua">未转账</span>';
                      }
                     return _status;
                  }
              },
              {
                  "orderable": false,
                  "data" :null,
                  "render":function(data){
                      if(data.finance>0){
                        return  '<button type="button" class="btn bg-purple btn-flat" data-type="detail"><i class="fa fa-list-ul"></i> 查看详情</button>';
                      }else{
                        return  '<button type="button" data-to="ss" class="btn bg-orange btn-flat " data-type="finance"><i class="fa fa-jpy"></i> 转账</button>';
                      }
                  }
              }
          ],
          language: {
              searchPlaceholder: "比赛名称、姓名、编号",
              emptyTable: "暂无结束的比赛",
              "search": "搜索:"
          }
      });
  
      $('#example_filter').append( '<label>搜索:<input type="search" class="form-control input-sm" placeholder="标签" id="tags-input" aria-controls="example"></label>' );
  
      $('#tags-input').on( 'keyup click', function () {
          if(timer!==undefined){
              clearTimeout(timer);
          }
          var timer=setTimeout(function(){
              table.column( 4 ).search(
                  $('#tags-input').val()
              ).draw();
          },300);
  
      } );
  
      $('#example tbody').on( 'click', 'button', function () {
          var data = table.row( $(this).parents('tr') ).data();
          var _type=$(this).attr('data-type');
          switch (_type){
              case 'detail'   : detail(data.finance);break;
              case 'finance'  : finance(data.id);break;
          }
      } );
  
      function detail(id){
          bs('#myModal').modal();
          $( "#myModal .modal-content" ).load('/admin/finance/detail/'+id);
      }
      function finance(id){
          bs('#myModal').modal();
          $( "#myModal .modal-content" ).load('/admin/finance/transfer/'+id);
      }
  
      $('#myModal').on('click','.subtransfer',function(){
          var _that=$(this);
          _that.attr('disabled',true);
          _that.text('提交中...');
          $.ajax({
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '/admin/finance/doTransfer',
              // data to be added to query string:
              data: $("#transferform").serialize(),
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
