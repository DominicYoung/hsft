<?php

namespace App\Http\Middleware;

use DB;
use Closure;

class InvitationMiddleware
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
        $info=DB::table('members')->where('id',$request->session()->get('logged_user.uid'))->first();
        if(empty($info)||$info->status==0){
            return redirect()->action('Home\InvitationController@index');
        }
        return $next($request);
    }
}
