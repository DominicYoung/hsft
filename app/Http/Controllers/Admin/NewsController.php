<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\News;
use App\Band;
use App\System;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;

class NewsController extends Controller
{
    public function index(){
        return view('Admin.news.index');
    }
    /**
     * 获取数据
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request,$id=null){
        $Admin=DB::table('news');

        if(!empty($request->search['value'])){
            $Admin->Where(function ($query) use ($request){
                $query->where('title', 'like', '%'.$request->search['value'].'%');
            });
        }
        $count=$Admin->count();
        $orderField=$request->columns[$request->order['0']['column']]['data'];

        $info=$Admin->skip($request->start)->take($request->length)->orderBy($orderField,$request->order['0']['dir'])
            ->get();
        return response()->json(['data'=>$info,"draw"=>$request->draw,"recordsTotal"=> $count,"recordsFiltered"=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info=new News;

        $controller=new CategoryController();
        $Tree = $controller ->getTree();
        if($Tree){
            $category = $Tree->getChilds();
            //遍历输出-不使用图片
            foreach ($category as $key=>$id){
                $mylm[$id]=$Tree->showPre($id).$Tree->getValue($id);
            }
        }
        $list=$this->fetchList();
        return view('Admin.news.edit',compact('info','mylm','list'));
    }

    public function fetchList(){
        $info['country']=explode(',',System::where('ename','country')->value('content'));
        $info['band']   =explode(',',System::where('ename','band')->value('content'));
        $info['liangcheng']=explode(',',System::where('ename','liangcheng')->value('content'));
        $info['waixing']=explode(',',System::where('ename','waixing')->value('content'));
        $info['caizhi']=explode(',',System::where('ename','caizhi')->value('content'));
        $info['fenlei']=explode(',',System::where('ename','fenlei')->value('content'));
        $info['celiangzhou']=explode(',',System::where('ename','celiangzhou')->value('content'));
        $info['jinxianfangshi']=explode(',',System::where('ename','jinxianfangshi')->value('content'));
        $info['yongtu']=explode(',',System::where('ename','yongtu')->value('content'));
        $info['shuchu']=explode(',',System::where('ename','shuchu')->value('content'));
        $info['yali']=explode(',',System::where('ename','yali')->value('content'));

        $info['band']=Band::lists('title');
        return $info;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ],[
            'title.required' => '请填写名称',
        ]);

        $input=$request->all();
        unset($input['_token']);
        $input['country']=empty($input['country'])?'':implode(',',$input['country']);
        $input['band']=empty($input['band'])?'':implode(',',$input['band']);
        $input['liangcheng']=empty($input['liangcheng'])?'':implode(',',$input['liangcheng']);
        $input['waixing']=empty($input['waixing'])?'':implode(',',$input['waixing']);
        $input['caizhi']=empty($input['caizhi'])?'':implode(',',$input['caizhi']);
        $input['fenlei']=empty($input['fenlei'])?'':implode(',',$input['fenlei']);
        $input['celiangzhou']=empty($input['celiangzhou'])?'':implode(',',$input['celiangzhou']);
        $input['jinxianfangshi']=empty($input['jinxianfangshi'])?'':implode(',',$input['jinxianfangshi']);
        $input['shuchu']=empty($input['shuchu'])?'':implode(',',$input['shuchu']);
        $input['yongtu']=empty($input['yongtu'])?'':implode(',',$input['yongtu']);
        $input['yali']=empty($input['yali'])?'':implode(',',$input['yali']);

        $reslut=News::create($input);
        if($request!==false){
            return redirect()->action('Admin\NewsController@index');
        }else{
            return response($reslut);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info=News::find($id);

        $controller=new CategoryController();
        $Tree = $controller ->getTree();
        if($Tree){
            $category = $Tree->getChilds();
            //遍历输出-不使用图片
            foreach ($category as $key=>$id){
                $mylm[$id]=$Tree->showPre($id).$Tree->getValue($id);
            }
        }
        $list=$this->fetchList();
        return view('Admin.news.edit',compact('info','mylm','list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ],[
            'title.required' => '请填写名称',
        ]);

        $input=$request->all();
        unset($input['_token']);

        $input['country']=empty($input['country'])?'':implode(',',$input['country']);
        $input['band']=empty($input['band'])?'':implode(',',$input['band']);
        $input['liangcheng']=empty($input['liangcheng'])?'':implode(',',$input['liangcheng']);
        $input['waixing']=empty($input['waixing'])?'':implode(',',$input['waixing']);
        $input['caizhi']=empty($input['caizhi'])?'':implode(',',$input['caizhi']);
        $input['fenlei']=empty($input['fenlei'])?'':implode(',',$input['fenlei']);
        $input['celiangzhou']=empty($input['celiangzhou'])?'':implode(',',$input['celiangzhou']);
        $input['jinxianfangshi']=empty($input['jinxianfangshi'])?'':implode(',',$input['jinxianfangshi']);
        $input['shuchu']=empty($input['shuchu'])?'':implode(',',$input['shuchu']);
        $input['yongtu']=empty($input['yongtu'])?'':implode(',',$input['yongtu']);
        $input['yali']=empty($input['yali'])?'':implode(',',$input['yali']);

        $result=News::where('id',$id)->update($input);
        if($result!==false){
            return redirect()->action('Admin\NewsController@index');
        }else{
            return response($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=News::destroy($id);
        if($result!==false){
            return response()->json('删除成功');
        }else{
            return response()->json('删除失败，请刷新重试',403);
        }
    }
}
