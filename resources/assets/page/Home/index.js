/**
 * Created by zhoufan on 2015/12/9.
 */
$( " div.filter > section > ul > li > h4" ).click(function() {
    $(this).hasClass('open')?$(this).removeClass('open'):$(this).addClass('open');
    $(this).parent().find('.box').toggle( "fast");
});
$('.limit-button').click(function(e){
    e.preventDefault();
    var _height=$(this).parent().find('.box');
    if(_height.height()<=170){
        $(this).parent().find('.box').css('height','auto');
        $(this).addClass('open');
    }else{
        $(this).parent().find('.box').css('height','100px');
        $(this).removeClass('open');
    }

});


$('.filter .box ul li').click(function(){
    $(this).hasClass('on')?$(this).removeClass('on'):$(this).addClass('on');
    listFilter();
});

function listFilter(){
    var url='';
    var filter={};
    var list=[];
    $('.filter .box ul li.on').each(function(){
        if(filter[$(this).attr('data-type')]==undefined){
            filter[$(this).attr('data-type')]=[];
        }
        filter[$(this).attr('data-type')].push($(this).text());
    });
    for(var x in filter){
        list.push(x+'='+filter[x].join(','));
    }
    var url=list.join('&');

    window.location.href=_url+'?'+url;
}
