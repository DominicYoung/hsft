<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\Banner;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index(){
        return view('Admin.banner.index');
    }
    /**
     * 获取数据
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request,$id=null){
        $Admin=DB::table('banners');

        if(!empty($request->search['value'])){
            $Admin->Where(function ($query) use ($request){
                $query->where('url', 'like', '%'.$request->search['value'].'%')
                    ->orWhere('id', 'like', '%'.$request->search['value'].'%');
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
        $info=new Banner;
        return view('Admin.banner.edit',compact('info'));
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
            'url' => 'required|max:255',
            'img' => 'required|max:255',

        ],[
            'url.required' => '请填写跳转链接',
            'img.required' => '请上传图片',
        ]);

        $result=Banner::create([
            'url'=>$request->url,
            'img'=>$request->img
        ]);
        if($request!==false){
            return redirect()->action('Admin\BannerController@index');
        }else{
            return response($result);
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
        $info=Banner::find($id);
        return view('Admin.banner.edit',compact('info'));
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
            'url' => 'required|max:255',
            'img' => 'required|max:255',

        ],[
            'url.required' => '请填写跳转链接',
            'img.required' => '请上传图片',
        ]);


        $result=Banner::where('id',$id)->update([
            'url'=>$request->url,
            'img'=>$request->img
        ]);
        if($result!==false){
            return redirect()->action('Admin\BannerController@index');
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
        $result=Banner::destroy($id);
        if($result!==false){
            return response()->json('删除成功');
        }else{
            return response()->json('删除失败，请刷新重试',403);
        }
    }
}
