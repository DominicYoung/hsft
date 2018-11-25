<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Admin;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.login.index');
    }

   public  function check(Request $request){

       $this->validate($request, [
           'account' => 'required|max:255',
           'password' => 'required|max:255',

       ],[
           'password.required' => '请填写密码',
           'account.required' => '请填写账号',
       ]);



       $info=Admin::where('account',$request->account)->first();
       if(!Hash::check($request->password,$info['password'])){
           return response()->json('账号或密码错误',403);
       }
       $request->session()->put('logged_admin', $info->toArray());
       return response()->json('登陆成功');
   }
    public function logout(Request $request){
        $request->session()->forget('logged_admin');
        return response()->redirectTo('/admin/login');
    }
    public function test(Request $request){
        dd($request->session()->get('logged_admin'));
    }
}
