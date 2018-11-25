<?php

namespace App\Http\Controllers\Admin;

use App\Apply;
use Illuminate\Http\Request;

use DB;
use Wechat;
use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WechatmessageController;

use App\Http\Controllers\Admin\GamesController;

class GamesController extends Controller
{
    public function transferopenid(){
        $people=DB::table('members')->lists('openid', 'id');
        $applies=DB::table('applies')->get();
        foreach($applies as $vo){
            DB::table('applies')->where('id',$vo->id)->update([
                'openid'=>$people[$vo->uid]
            ]);
        }
    }

    public function markSubscribeUser(){

        $controller=new GamesController();
        $subscribers=$controller->fetchWechatUser();

        $applies=DB::table('applies')->get();
        foreach($applies as $vo){
            if(in_array($vo->openid,$subscribers)){
                DB::table('applies')->where('id',$vo->id)->update([
                    'subscribe'=>1
                ]);
            }

        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Game=DB::table('games')->where('games.ispublish',1);

        if(!empty($request->columns[2]['search']['value'])){
            $Game ->Where('games.tags', 'like', '%'.$request->columns[2]['search']['value'].'%');
        }

        if(!empty($request->search['value'])){
            $Game->Where(function ($query) use ($request){
                $query->where('games.title', 'like', '%'.$request->search['value'].'%')
                      ->orWhere('games.truename', 'like', '%'.$request->search['value'].'%')
                      ->orWhere('games.nickname', 'like', '%'.$request->search['value'].'%')
                      ->orWhere('games.phone', 'like', '%'.$request->search['value'].'%');
            });
        }
        $count=$Game->count();
        $orderField=$request->columns[$request->order['0']['column']]['data'];

        $info=$Game->skip($request->start)->take($request->length)->orderBy($orderField,$request->order['0']['dir'])
            ->leftJoin('applies', function ($join) {
                $join->on('games.id', '=', 'applies.game_id')
                    ->where('applies.pay_status', '<', 2);
            })
            ->selectRaw('games.*,count(applies.id) as count')
            ->groupBy('games.id')
            ->get();
        return response()->json(['data'=>$info,"draw"=>$request->draw,"recordsTotal"=> $count,"recordsFiltered"=>$count]);
    }

    public function applies(){

        $games=DB::table('games')->where('ispublish',1)->where('deadline','<',date('Y-m-d H:i:s',time()))->count();
        $list=DB::table('applies')->where('pay_status','<',2)->lists('openid');
        $people=count($list);

        $focus=$this->fetchWechatUser();

        $focuspeople=count(array_intersect(array_unique($list),$focus));
        return view('Admin.game.index',compact('games','people','focuspeople'));
    }
    public function fetchWechatUser(){

        $user=Wechat::user();
        $userlist=[];
        $nextOpenId = null;
        do{
            $list=$user->lists($nextOpenId);
            if($list['data']['openid']==null){
                $list['data']['openid']=[];
            }
            $userlist=array_merge($userlist,$list['data']['openid']);
            $nextOpenId=$list['next_openid'];
        }while($list['count']==10000);


       return $userlist;
    }
    public function pause($id){
        $info=Game::find($id);
        $info->adminpause=!$info->adminpause;
        $info->save();
        if($info->adminpause==1){
            return response()->json('暂停成功');
        }else{
            return response()->json('恢复成功');
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
        $info=Game::find($id);
        $info->starttime=substr($info->starttime,0,-3);
        $info->endtime=substr($info->endtime,0,-9);
        $info->deadline=substr($info->deadline,0,-9);

        $count=DB::table('applies')->where('game_id',$id)->where('pay_status','<',2)->count();
        return view('Admin.game.edit',compact('info','count'));
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
            'title' => 'required|max:255',
            'starttime'=>'required|date_format:Y-m-d H:i',
            'endtime'=>'required|date_format:Y-m-d',
            'address'=>'required',
            'fee'=>'required',
            'groups'=>'required',
            'deadline'=>'required|date_format:Y-m-d',
            'people' => 'required|numeric',
            'note' => 'required',
        ],[
            'title.required'=>'比赛名称必须填写',
            'address.required'=>'比赛地址必须填写',
            'people.required'=>'比赛人数必须填写',
            'fee.required'=>'比赛费用必须填写',
            'groups.required'=>'比赛组别必须填写',
            'note.required'=>'比赛详解必须填写'
        ]);

        $input=$request->all();

        $input['endtime']=$input['endtime'].' 23:59:59';
        if(substr($input['starttime'],0,-6)==$input['deadline']){
            $input['deadline']=$input['starttime'];
        }else{
            $input['deadline']=$input['deadline'].' 23:59:59';
        }

        if($input['deadline']>$input['starttime']){

            return response('报名截止时间必须早于比赛开始时间',422);
        }
        if($input['endtime']<$input['starttime']){
            return response('比赛开始时间必须早于结束时间',422);

        }


        unset($input['_token']);
        $result=Game::where('id',$id)->update($input);
        if($result===false){
            abort(403,'提交失败，请刷新重试');
        }
        return redirect('admin/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $info=Game::find($id);
        $result=Game::destroy($id);
        if(time()<strtotime($info->endtime)){
            $applies=Apply::where('game_id',$info->id)->where('pay_status','<',2)->lists('openid');

            $first=$info->fee=='0.00'?'您报名的比赛已被取消':'您报名的比赛已被取消，所支付报名费将在3个工作日内退回到您的账户';

            //发送模板消息
            $WechatMessage=new WechatmessageController();

            foreach($applies as $vo){
                $WechatMessage->cancelNotice([
                    'first'=>$first,
                    'title'   =>$info->title,
                    'time'   =>$info->starttime,
                    'people'  =>$info->phone,
                    'remark'  =>'如有疑问，可联系赛事主办方或国球汇客服',
                    'openid'    =>$vo
                ],'');
            }
        }
        if($result===false){
            return response()->json(403,'删除失败');
        }else{
            return response()->json('删除成功');
        }
    }

   public function map($ad){
       $info=file_get_contents('http://apis.map.qq.com/ws/geocoder/v1/?address='.$ad.'&key=4ZGBZ-OSLWS-ISIOM-6QC5F-AVMEF-IUF7F');
       $address=json_decode($info,true);
       $map='';
       if($address['status']==0){
            $map=$address['result']['location']['lat'].','.$address['result']['location']['lng'];
       }

       return view('Admin.game.map',compact('map'));
   }
}
