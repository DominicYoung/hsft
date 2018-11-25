<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Category;
use App\System;
use App\Http\Requests;
use App\Http\Controllers\Admin\TreeController;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        $mylm=Array();
        $Tree =  $this->getTree();
        if($Tree){
            $category = $Tree->getChilds();
            //遍历输出-使用图片
            foreach ($category as $key=>$id){
                $mylm[$id]=$Tree->showPre($id,true).$Tree->getValue($id);
            }
        }
        return view('Admin.Category.index',compact('mylm'));
    }
    public function getTree(){
        $b=Category::select('id','pid','title')->orderBy('orderid')->get();
        if($b){
            $Tree = new TreeController;
            foreach ($b as $lm){
                $Tree->setNode($lm['id'], $lm['pid'], $lm['title']);
            }
            return $Tree;
        }else{
            return false;
        }
    }

    public function create(){
        $info=new Category;
        $info->orderid=100;
        $mylm['0']='作为网站一级栏目';
        $Tree =  $this->getTree();
        if($Tree){
            $category = $Tree->getChilds();
            //遍历输出-不使用图片
            foreach ($category as $key=>$id){
                $mylm[$id]=$Tree->showPre($id).$Tree->getValue($id);
            }
        }
        return view('Admin.Category.add',compact('info','mylm'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255',
            'ename' => 'required|max:255',
            'pid' => 'required',
            'orderid' => 'required'
        ]);
        $result =Category::create($request->all());
        if($result!==false){
            return redirect()->action('Admin\CategoryController@index');
        }else{
            return response($result);
        }
    }
    public function edit($id){
        $info=Category::find($id);
        $Tree = $this->getTree();
        $category = $Tree->getChilds();
        //遍历输出-不使用图片
        $mylm['0']='作为网站一级栏目';
        foreach ($category as $key=>$id){
            $mylm[$id]=$Tree->showPre($id).$Tree->getValue($id);
        }
        return view('Admin.Category.add',compact('info','mylm'));
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'title' => 'required|max:255',
            'ename' => 'required|max:255',
            'pid' => 'required',
            'orderid' => 'required'
        ]);
        $input=$request->all();
        unset($input['_token']);
        $result =Category::where('id',$id)->update($input);
        if($result!==false){
            return redirect()->action('Admin\CategoryController@index');
        }else{
            return response($result);
        }
    }
    public function destroy($id){


        $tag=false;
        $vo	= Category::where('pid',$id)->first();
        if($vo) $tag=true;

        if($tag){
            return response()->json('系统提示：要删除的栏目如果有子栏目，必须先将其子栏目删除',422);
        }else{
            if(Category::destroy($id)){
                return response()->json('已成功删除');
            }else {
                return response()->json('删除失败',422);
            }
        }
    }
}
