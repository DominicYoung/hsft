@extends('widget/layout/Home/body.blade.php')


@section('title', '搜索页-深圳市汉斯福特科技有限公司 ')
@section('body')

    <div style="max-height: 330px;overflow: hidden">

        <img width="100%"  src="{{empty($info->pic)?'/plupload/company&contact.jpg':$info->pic}}" alt="">

    </div>
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="/">主页</a></li>
            <li class="active">搜索结果</li>
        </ol>
        <div style="width:80%;margin: 0 auto">


            {!! $news->render() !!}

        <ul class="list-style1">
            @foreach($news as $vo)
            <li>
                <a href="{{action('Home\IndexController@detail',['band'=>$vo->band,'title'=>$vo->ename])}}">
                    <img  src="{{$vo->titlepic}}" alt="...">
                    <div style="width: 50%">
                        <h3>{{$vo->title}}</h3>
                       {!! $vo->shuxing !!}
                    </div>
                    <div>
                        <dl>
                            <dd class="day1">品牌：{{$vo->band}}</dd>
                            <dd class="day2">产地：{{$vo->country}}</dd>

                        </dl>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>

            {!! $news->render() !!}
        </div>
    </div>


    @script()

    (function($){
    $.fn.textSearch = function(str,options){
    var defaults = {
    divFlag: true,
    divStr: " ",
    markClass: "",
    markColor: "red",
    nullReport: true,
    callback: function(){
    return false;
    }
    };
    var sets = $.extend({}, defaults, options || {}), clStr;
    if(sets.markClass){
    clStr = "class='"+sets.markClass+"'";
    }else{
    clStr = "style='color:"+sets.markColor+";'";
    }

    //对前一次高亮处理的文字还原
    $("span[rel='mark']").each(function() {
    var text = document.createTextNode($(this).text());
    $(this).replaceWith($(text));
    });


    //字符串正则表达式关键字转化
    $.regTrim = function(s){
    var imp = /[\^\.\\\|\(\)\*\+\-\$\[\]\?]/g;
    var imp_c = {};
    imp_c["^"] = "\\^";
    imp_c["."] = "\\.";
    imp_c["\\"] = "\\\\";
    imp_c["|"] = "\\|";
    imp_c["("] = "\\(";
    imp_c[")"] = "\\)";
    imp_c["*"] = "\\*";
    imp_c["+"] = "\\+";
    imp_c["-"] = "\\-";
    imp_c["$"] = "\$";
    imp_c["["] = "\\[";
    imp_c["]"] = "\\]";
    imp_c["?"] = "\\?";
    s = s.replace(imp,function(o){
    return imp_c[o];
    });
    return s;
    };
    $(this).each(function(){
    var t = $(this);
    str = $.trim(str);
    if(str === ""){
    alert("关键字为空");
    return false;
    }else{
    //将关键字push到数组之中
    var arr = [];
    if(sets.divFlag){
    arr = str.split(sets.divStr);
    }else{
    arr.push(str);
    }
    }
    var v_html = t.html();
    //删除注释
    v_html = v_html.replace(/<!--(?:.*)\-->/g,"");

    //将HTML代码支离为HTML片段和文字片段，其中文字片段用于正则替换处理，而HTML片段置之不理
    var tags = /[^<>]+|<(\/?)([A-Za-z]+)([^<>]*)>/g;
    var a = v_html.match(tags), test = 0;
    $.each(a, function(i, c){
    if(!/<(?:.|\s)*?>/.test(c)){//非标签
    //开始执行替换
    $.each(arr,function(index, con){
    if(con === ""){return;}
    var reg = new RegExp($.regTrim(con), "g");
    if(reg.test(c)){
    //正则替换
    c = c.replace(reg,"♂"+con+"♀");
    test = 1;
    }
    });
    c = c.replace(/♂/g,"<span rel='mark' "+clStr+">").replace(/♀/g,"</span>");
    a[i] = c;
    }
    });
    //将支离数组重新组成字符串
    var new_html = a.join("");

    $(this).html(new_html);

    if(test === 0 && sets.nullReport){
    alert("没有搜索结果");
    return false;
    }

    //执行回调函数
    sets.callback();
    });
    };
    })(jQuery);


    $(".list-style1").textSearch("{{$searchkey}}");
    @endscript
@endsection


@section("fis_resource")@parent @require('page/Home/search.blade.php')@stop