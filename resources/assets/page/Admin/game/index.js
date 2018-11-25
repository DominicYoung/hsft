/**
 * Created by zhoufan on 2015/12/24.
 */
var $ = require('/static/lib/datatables/js/dataTables.bootstrap.js');

$(document).ready(function() {
    var table=$('#example').DataTable({
        "processing": true,
        "bLengthChange": false,
        "iDisplayLength": 25,
        "serverSide": true,
        "ajax": "/admin/games/index",
        "order": [[ 0, 'desc' ]],
        "columns": [
            { "data": "id",
                "width":'36px'
            },
            { "data": "title" },
            { "data": "tags",
                "width":'55px'
            },
            { "data": "nickname",
                "width":'55px'
            },
            { "data": "truename",
                "width":'55px'
            },
            { "data": "phone",
                "width":'80px'
            },
            { "data": "deadline" ,
                "width":'95px',
                "render":function(data){
                   return data.substr(0,10);
                }
            },
            { "data": "count",
                "width":'65px'
            },
            { "data": "newsubscribe",
                "width":'65px'
            },
            { "data": "pause",
                "width":'80px',
                "orderSequence": ["desc", "asc" ],
                "render":function(data){
                    if(data==1){
                        return '是';
                    }else{
                        return '否';
                    }
                }
            },
            { "data": "adminpause",
                "width":'80px',
                "orderSequence": ["desc", "asc" ],
                "render":function(data){
                    if(data==1){
                        return '是';
                    }else{
                        return '否';
                    }
                }
            },
            {
                "orderable": false,
                "data" :null,
                "width":'270px',
                "render": function (data) {
                    if(data.adminpause==1){
                       return '<a role="button" target="_blank" href="/admin/games/edit/'+data.id+'" class="btn bg-purple btn-flat"> <span class="glyphicon glyphicon-edit"></span> 编辑</a>&nbsp;&nbsp;<button type="button" class="btn bg-navy btn-flat " data-type="pause"><span class="glyphicon glyphicon-play"></span> 恢复比赛</button>&nbsp;&nbsp;<button type="button" class="btn bg-maroon btn-flat " data-type="del"><span class="glyphicon glyphicon-remove"></span> 删除</button>';
                    }else{
                        return '<a role="button" target="_blank" href="/admin/games/edit/'+data.id+'" class="btn bg-purple btn-flat"> <span class="glyphicon glyphicon-edit"></span> 编辑</a>&nbsp;&nbsp;<button type="button" class="btn bg-orange btn-flat " data-type="pause"><span class="glyphicon glyphicon-pause"></span> 暂停比赛</button>&nbsp;&nbsp;<button type="button" class="btn bg-maroon btn-flat " data-type="del"><span class="glyphicon glyphicon-remove"></span> 删除</button>';
                    }

                }

            }
        ],
        language: {
            searchPlaceholder: "比赛名称、姓名、电话",
            "search": "搜索:"
        }
    });

    $('#example_filter').append( '<label>搜索:<input type="search" class="form-control input-sm" placeholder="标签" id="tags-input" aria-controls="example"></label>' );

    $('#tags-input').on( 'keyup click', function () {
        if(timer!==undefined){
            clearTimeout(timer);
        }
        var timer=setTimeout(function(){
            table.column( 2 ).search(
                $('#tags-input').val()
            ).draw();
        },300);

    } );


    $('#example tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var _type=$(this).attr('data-type');
        switch (_type){

            case 'pause':pause(data.id);break;
            case 'del'  :del(data.id);break;
        }
    } );
    function pause(id){
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/games/pause/'+id,
            dataType: 'json',
            success: function(data){
                alert(data);
                window.location.reload();
            },
            error: function(xhr, errorType, error){
                alert(JSON.parse(xhr.responseText));

                console.log(xhr, errorType, error);
            }
        })
    }
    function del(id){
        var del=window.confirm('确认删除编号为：'+id+' 的比赛吗？改操作不可恢复！')
        if(del){
            $.ajax({
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/games/del/'+id,
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