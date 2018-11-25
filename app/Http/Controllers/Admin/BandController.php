<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\Band;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BandController extends Controller
{
    public function index(){
        return view('Admin.band.index');
    }
    /**
     * 获取数据
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request,$id=null){
        $Admin=DB::table('bands');

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
        $info=new Band;
        return view('Admin.band.edit',compact('info'));
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'keyword' => 'required|max:255',
            'seo' => 'required|max:255',
            'titlepic' => 'required|max:255',

        ],[
            'title.required' => '请填写名称',
            'description.required' => '请填写描述',
            'seo.required' => '请填写SEO描述',
            'keyword' => '请填写关键字',
            'titlepic.required' => '请上传图片',
        ]);

        $reslut=Band::create([
            'title'=>$request->title,
            'description'   =>$request->description,
            'titlepic'   =>$request->titlepic,
            'seo' => $request->seo,
            'keyword' => $request->keyword
        ]);
        if($request!==false){
            return redirect()->action('Admin\BandController@index');
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
        $info=Band::find($id);
        return view('Admin.band.edit',compact('info'));
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
            'description' => 'required|max:255',
            'seo' => 'required|max:255',
            'keyword' => 'required|max:255',
            'titlepic' => 'required|max:255',

        ],[
            'title.required' => '请填写名称',
            'description.required' => '请填写描述',
            'seo.required' => '请填写SEO描述',
            'keyword' => '请填写关键字',
            'titlepic.required' => '请上传图片',
        ]);

        $result=Band::where('id',$id)->update([
            'title'=>$request->title,
            'titlepic'=>$request->titlepic,
            'seo' => $request->seo,
            'description'   =>$request->description,
            'keyword' => $request->keyword
        ]);
        if($result!==false){
            return redirect()->action('Admin\BandController@index');
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
        $result=Band::destroy($id);
        if($result!==false){
            return response()->json('删除成功');
        }else{
            return response()->json('删除失败，请刷新重试',403);
        }
    }
}
