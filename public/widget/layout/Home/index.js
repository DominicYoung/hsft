/**
 * Created by zhouf on 2016/5/23.
 */
$(document).ready(function() {
    $(".navbar-wrapper ul.nav li").hover(function(){
            $(this).addClass("on");

        },
        function(){
            $(this).removeClass("on");

        })
});

$(document).ready(function() {
    $(".navbar-wrapper ul.nav li").hover(function(){
            $(this).parent("ul").siblings("h3").addClass("choice");

        },
        function(){
            $(this).parent("ul").siblings("h3").removeClass("choice");
        })
});

$(document).ready(function() {
    if ($(".navbar-wrapper ul.nav li").find("ul") .html()!="") {
        $(".navbar-wrapper ul.nav li").parent("ul").siblings("h3").append("<span class='sub'></span>");
    }
});

$('#top-search').click(function () {
    $('#top-search input').animate({ width: "600px",opacity:1 }, "slow");
    $('#top-search input').focus();
    return false;
});

$('body').click(function () {
    $('#top-search input').animate({ width: "0",opacity:0 }, "slow");
});

$('#top-search input').keyup(function(e){
    e=e||window.event;
    if(e.keyCode == 13){
        if($(this).val()==''){
           alert('请输入搜索内容');
            return false;
        }
        window.location.href='/search/'+$(this).val();
    }
});

$('#massage a.mess_ico').mouseenter(function(){
    $(this).animate({right:'-1px'},"fast");
}).mouseleave(function(){
    $(this).animate({right:'-260px'},"fast");
});
$('#massage a.qq_ico').mouseenter(function(){
    $(this).animate({right:'-150px'},"fast");
}).mouseleave(function(){
    $(this).animate({right:'-260px'},"fast");
});
$('#massage a.tel_phone').mouseenter(function(){
    $(this).animate({right:'-100px'},"fast");
}).mouseleave(function(){
    $(this).animate({right:'-260px'},"fast");
});