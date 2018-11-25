<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('Admin.admin.index');
    }
    /**
     * 获取数据
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request,$id=null){
        $Admin=DB::table('admins');

        if(!empty($request->search['value'])){
            $Admin->Where(function ($query) use ($request){
                $query->where('phone', 'like', '%'.$request->search['value'].'%')
                    ->orWhere('truename', 'like', '%'.$request->search['value'].'%')
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
        $info=new Admin;
        return view('Admin.admin.edit',compact('info'));
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
            'truename' => 'required|max:255',
            'account' => 'required|max:255',
            'password' => 'required|max:255',

        ],[
            'truename.required' => '请填写真实姓名',
            'password.required' => '请填写密码',
            'account.required' => '请填写账号',
        ]);

        $reslut=Admin::create([
            'truename'=>$request->truename,
            'account'   =>$request->account,
            'password'   =>bcrypt($request->password)
        ]);
        if($request!==false){
            return redirect()->action('Admin\AdminController@index');
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
        $info=Admin::find($id);
        return view('Admin.admin.edit',compact('info'));
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
            'truename' => 'required|max:255',
            'phone'    => 'required|regex:/^1[34578][0-9]{9}$/',
        ],[
            'truename.required' => '请填写真实姓名',
            'phone.required' => '请填写手机号码',
            'phone.regex' => '手机格式不正确',
        ]);

        $result=Admin::where('id',$id)->update([
            'truename'=>$request->truename,
            'phone'   =>$request->phone
        ]);
        if($result!==false){
            return redirect()->action('Admin\AdminController@index');
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
        $result=Admin::destroy($id);
        if($result!==false){
            return response()->json('删除成功');
        }else{
            return response()->json('删除失败，请刷新重试',403);
        }
    }
}
