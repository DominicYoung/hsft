/**
 * Created by zhouf on 2016/5/26.
 */
var $=require('jquery');
$('.del').click(function(){
    var del=window.confirm('确认删除吗？改操作不可恢复！')
    if(del){
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/category/del/'+$(this).attr('data-id'),
            dataType: 'json',
            success: function(data){
                alert('删除成功');
                window.location.reload();
            },
            error: function(xhr, errorType, error){
                alert(JSON.parse(xhr.responseText));

                console.log(xhr, errorType, error);
            }
        })
    }
});
