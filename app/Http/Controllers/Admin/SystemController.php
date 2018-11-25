<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\System;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index(){
        return view('Admin.system.index');
    }
    /**
     * 获取数据
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request,$id=null){
        $Admin=DB::table('systems');

        if(!empty($request->search['value'])){
            $Admin->Where(function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->search['value'].'%')
                    ->orWhere('ename', 'like', '%'.$request->search['value'].'%')
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
        $info=new System;
        return view('Admin.system.edit',compact('info'));
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
            'name' => 'required|max:255',
            'ename' => 'required|max:255',
            'contents' => 'required',

        ],[
            'name.required' => '请填写名称',
            'ename.required' => '请填写调用名称',
            'contents.required' => '请填写内容',
        ]);

        $result=System::create([
            'name'=>$request->name,
            'ename'=>$request->ename,
            'content'   =>$request->contents
        ]);
        if($request!==false){
            return redirect()->action('Admin\SystemController@index');
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
        $info=System::find($id);
        return view('Admin.system.edit',compact('info'));
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
            'name' => 'required|max:255',
            'ename' => 'required|max:255',
            'contents' => 'required',

        ],[
            'name.required' => '请填写名称',
            'ename.required' => '请填写调用名称',
            'contents.required' => '请填写内容',
        ]);

        $result=System::where('id',$id)->update([
            'name'=>$request->name,
            'ename'=>$request->ename,
            'content'   =>$request->contents
        ]);
        if($result!==false){
            return redirect()->action('Admin\SystemController@index');
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
        $info=System::find($id);
        if($info->isadmin){
            return response()->json('该参数为系统保留参数，不能删除',403);
        }
        $result=System::destroy($id);
        if($result!==false){
            return response()->json('删除成功');
        }else{
            return response()->json('删除失败，请刷新重试',403);
        }
    }
}
