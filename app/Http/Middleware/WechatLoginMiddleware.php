<?php

namespace App\Http\Middleware;

use Closure;
use Wechat;
use App\Member;

class WechatLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 请一定要自己存储用户的登录信息，不要每次都授权
        if (!$request->session()->has('logged_user')) {
            $auth=Wechat::auth();

            $user = $auth->authorize('http://pingpang.cdguangqi.com/'.$_SERVER['REQUEST_URI']); // 返回用户 Bag
//            $user = $auth->authorize('http://wx3.guoqiuhui.net/'.$_SERVER['REQUEST_URI']); // 返回用户 Bag
            //插入数据库
            $id=$this->saveInfo($user->all());
            $user->uid=$id;
            $request->session()->put('logged_user', $user->all());

            // 跳转到其它授权才能访问的页面
        }
        return $next($request);
    }

    /**
     * 保存用户信息到数据库
     * @param $data
     * @return mixed
     */
    private function saveInfo($data){
        unset($data['language']);
        unset($data['privilege']);
        $member = Member::where('openid',$data['openid'])->first();
        if($member){
            Member::where('openid',$data['openid'])->update($data);
            $id=$member->id;
        }else{
            $id=Member::insertGetId($data);
        }
        return $id;
    }
}
