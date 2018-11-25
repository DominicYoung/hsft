define('page/Admin/system/index', function(require, exports, module) {

  /**
   * Created by zhoufan on 2016/1/5.
   */
  var $ = require('static/lib/datatables/js/dataTables.bootstrap');
  $(document).ready(function() {
      var _url='/admin/sys/getList';
  
      var table=$('#example').DataTable({
          "processing": true,
          "bLengthChange": false,
          "iDisplayLength": 25,
          "serverSide": true,
          "ajax": _url,
          "order": [[ 0, 'desc' ]],
          "columns": [
              { "data": "id" },
              { "data": "name" },
              { "data": "ename" },
              {
                  "orderable": false,
                  "data" :null,
                  "render":function(data){
                     return '<a href="/admin/sys/edit/'+data.id+'" class="btn bg-purple btn-flat" data-type="edit"> <span class="glyphicon glyphicon-edit"></span> 编辑</a>&nbsp;&nbsp;<button type="button" class="btn bg-maroon btn-flat " data-type="del"><span class="glyphicon glyphicon-remove"></span> 删除</button>';
                  }
              }
          ],
          language: {
              searchPlaceholder: "",
              emptyTable: "暂无",
              "search": "搜索:"
          }
      });
  
      $('#example tbody').on( 'click', 'button', function () {
          var data = table.row( $(this).parents('tr') ).data();
          var _type=$(this).attr('data-type');
          switch (_type){
              case 'del'  : del(data.id);break;
          }
      } );
      function del(id){
          var del=window.confirm('确认删除吗？改操作不可恢复！')
          if(del){
              $.ajax({
                  type: 'GET',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '/admin/sys/del/'+id,
                  dataType: 'json',
                  success: function(data){
                      alert('删除成功');
                      setTimeout(function () {
                          window.location.reload();
                      },1000)
  
                  },
                  error: function(xhr, errorType, error){
                      alert(JSON.parse(xhr.responseText));
  
                      console.log(xhr, errorType, error);
                  }
              })
          }
      }
  
  });

});
