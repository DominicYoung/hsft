<?php

namespace App\Http\Controllers\Home;

use App\System;
use Illuminate\Http\Request;

use DB;
use App\News;
use App\Band;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    public function __construct(){
        $mylm =  $this->getNav();
        $keywords=DB::table('systems')->where('ename','keyword')->value('content');
        $description=DB::table('systems')->where('ename','seo')->value('content');;
        view()->share('mylm', $mylm);
        view()->share('keywords', $keywords);
        view()->share('description', $description);
    }

    public function index(){
        $banner=DB::table('banners')->get();
        $chan=News::where('re_chan','>',0)->take(3)->orderBy('re_chan','desc')->get();
        $line=News::where('re_line','>',0)->take(3)->orderBy('re_line','desc')->get();
       return view('Home.index',compact('banner','chan','line'));
    }

    public function news(Request $request){
        $info=Category::where('ename',$request->id)->first();
        if(!$info){
            $info=Category::findOrFail($request->id);
        }

        $input = $request->all();
        unset($input['page']);
        $db=DB::table('news')->where('category',$info->id);
        foreach($input as $key=>$vo){
            $temp=explode(',',$vo);
            $db->whereIn($key,$temp);
        }
        $news=$db->paginate(6);
        switch($info->kind){
            case 1:
                $pidname=Category::where('id',$info->pid)->value('title');
                $first=Category::where('pid',$info->pid)->orderBy('orderid','desc')->orderBy('id')->take(1)->value('id');
                return view('Home.list',compact('info','news','pidname','first'));break;
            case 2:
                $pidname=Category::where('id',$info->pid)->value('title');
                $first=Category::where('pid',$info->pid)->orderBy('orderid','desc')->orderBy('id')->take(1)->value('id');
                $filter=$this->filter($info->id);
                return view('Home.list1',compact('info','news','pidname','first','filter','input'));break;
            case 3:
                if(count($news)==1){
                    $news=$news['0'];
                    $bro=Category::where('pid',$info['pid'])->where('show',1)->get();
                    return view('Home.list2',compact('info','news','bro'));
                }else{
                    return view('Home.list3',compact('info','news'));
                }
                break;
            case 4:return view('Home.download',compact('info','news'));break;
        }

    }

    public function search(Request $request){

        $searchkey=$request->searchkey;
        $db=DB::table('news')->where('title','like','%'.$request->searchkey.'%');

        $news=$db->paginate(6);

        return view('Home.search',compact('news','searchkey'));

    }


    public function filter($pid){
        switch($pid){
            case 17:$info=$this->leibie1();break; //加速度传感器
            case 16:$info=$this->leibie2();break; //称重传感器
            case 18:$info=$this->leibie3();break; //压力传感器
        }
        return $info;
    }
    public function leibie1(){
        $info['country']=['name'=>'国家','class'=>'col3','list'=>explode(',',System::where('ename','country')->value('content'))];
        $info['band']=['name'=>'品牌','class'=>'','list'=>['ASC Sensor','CTC','Dytran','Hansford','Measurement Specialties','Sherborne Sensors']];
        $info['fenlei']=['name'=>'分类','class'=>'col3','list'=>['压电式','压阻式','电容式','伺服式','电阻应变式']];
        $info['celiangzhou']=['name'=>'测量轴','class'=>'col3','list'=>['单轴','双轴','三轴']];
        $info['jinxianfangshi']=['name'=>'进线方式','class'=>'col3','list'=>['顶端','测旁']];
        $info['yongtu']=['name'=>'用途','class'=>'col3','list'=>['冲击','低频','防爆','紧凑','高温','高速']];
        $info['shuchu']=['name'=>'输出','class'=>'','list'=>['AC','4-20mA','AC和电压','AC和温度','4-20mA和温度','4-10mA和AC','mv/g','电压','g']];
        return $info;
    }

    public function leibie2(){
        $info['country']=['name'=>'国家','class'=>'col3','list'=>explode(',',System::where('ename','country')->value('content'))];
        $info['band']=['name'=>'品牌','class'=>'listbox','list'=>['AC','CAS','Celtron','Dacell','Fine','Futek','HBM','Interface','Measurement Specialties','MKcells','NTS','Precia Molen','Revere','RICE LAKE','Sensortronics','Sartorius','Senstech','Setech','Sherborne Sensors','Tedea-Huntleigh','Transducer Techniques']];
        $info['liangcheng']=['name'=>'量程','class'=>'col3','list'=>["10g","25g","30g","50g","100g","150g","250g","300g","500g","600g","1kg","2kg","3kg","5kg","6kg","7kg","10kg","20kg","30kg","50kg","100kg","150kg","200kg","250kg","500kg","1t","2t","5t","10t","20t","50t","100t","150t","200t","500t","1000t"]];
        $info['waixing']=['name'=>'外型','class'=>'','list'=>["单点式","S型","柱式","悬臂梁式","波纹管","轮辐式"]];
        $info['caizhi']=['name'=>'材质','class'=>'col3','list'=>['合金钢','铝材质','不锈钢','钛合金','塑料橡胶']];
        $info['shuchu']=['name'=>'输出','class'=>'col3','list'=>['4-20mA']];
        return $info;

    }
    public function leibie3(){
        $info['country']=['name'=>'国家','class'=>'col3','list'=>explode(',',System::where('ename','country')->value('content'))];
        $info['band']=['name'=>'品牌','class'=>'','list'=>['Dytran','Futek','Measurement','Specialties','Sensys']];
        $info['fenlei']=['name'=>'分类','class'=>'col3','list'=>['应变片压力','陶瓷压力','扩散硅压力','蓝宝石压力','压电压力']];
        $info['yali']=['name'=>'压力','class'=>'col3','list'=>['表压','绝压','差压','大气压力','密封表压','复合压力']];

        $info['shuchu']=['name'=>'输出','class'=>'','list'=>["mV/V","0-5VDC","0-10VDC","10-0VDC","4-20mA","0.5-4.5VDC","1-5VDC"]];
        return $info;
    }

    public function detail(Request $request){
        $info=News::where('ename',$request->title)->first();
        $category=Category::where('id',$info->category)->first();
        $pidname=Category::where('id',$category->pid)->value('title');
        $first=Category::where('pid',$category->pid)->orderBy('orderid','desc')->orderBy('id')->take(1)->value('id');

        $keywords=$info['keyword'];
        $description=$info['seo'];
        return view('Home.detail',compact('info','description','keywords','category','pidname','first'));
    }



    public function article(Request $request){
        $info=News::findOrFail($request->id);
        $keywords=$info['keyword'];
        $description=$info['seo'];
        return view('Home.article',compact('info','description','keywords'));
    }

    public function country(){
        $country=['meiguo'=>'美国','yingguo'=>'英国','deguo'=>'德国','faguo'=>'法国','riben'=>'日本','hanguo'=>'韩国'];
        return $country;
    }
    public function getNav($pid=0){
        $country=DB::table('systems')->where('ename','country')->value('content');
        $b=Category::select('id','pid','title')->whereIn('id',[5,23,15])->orderBy('orderid','desc')->orderBy('id')->get();
        if($b) {
            foreach ($b as $key => $lm) {
                $b[$key]['child'] = Category::select('id','ename', 'pid', 'title')->where('pid', $lm['id'])->orderBy('orderid', 'desc')->get();
            }
        }
//        foreach(explode(',',$country) as $vo){
//            $c[]=['title'=>$vo,'url'=>'/band/'.$vo];
//        }
        $country=$this->country();
        foreach($country as $key=>$vo){
            $c[]=['title'=>$vo,'url'=>'/band/'.$key];
        }
        $b['country']=['title'=>'品牌','child'=>$c];
        return $b;

    }
    public function band($key){
        $countrys=$this->country();
        $info=News::where('country',$countrys[$key])->lists('country','band');
        $country=$countrys[$key];
        return view('Home.band',compact('info','country','key'));
    }
    public function bandlist(Request $request){
        $countrys=$this->country();
        $news=News::where('country',$countrys[$request->country])->where('band',$request->band)->paginate(10);
        $country=$countrys[$request->country];
        $countryen=$request->country;
        $band=$request->band;

        $bandinfo=Band::where('title',$band)->first();
        $keywords=$bandinfo['keyword'];
        $description=$bandinfo['seo'];
        view()->share('keywords', $keywords);
        view()->share('description', $description);
        return view('Home.bandlist',compact('news','band','country','countryen','bandinfo'));
    }
}
