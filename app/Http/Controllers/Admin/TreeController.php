<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TreeController extends Controller
{
    public $data=array();
    public $cateArray=array();

    function Tree()
    {

    }
    function setNode ($id, $parent, $value)
    {
        $parent = $parent?$parent:0;
        $this->data[$id]                = $value;
        $this->cateArray[$id]        = $parent;
    }
    function getChildsTree($id=0)
    {
        $childs=array();
        foreach ($this->cateArray as $child=>$parent)
        {
            if ($parent==$id)
            {
                $childs[$child]=$this->getChildsTree($child);
            }

        }
        return $childs;
    }
    function getChilds($id=0)//得到所有的孩子（包括孙子）（深度优先，便于显示）
    {
        $childArray=array();
        $childs=$this->getChild($id);
        foreach ($childs as $child)
        {
            $childArray[]=$child;
            $childArray=array_merge($childArray,$this->getChilds($child));
        }
        return $childArray;
    }
    function getChild($id)//得到第一层的孩子
    {
        $childs=array();
        foreach ($this->cateArray as $child=>$parent)
        {
            if ($parent==$id)
            {
                $childs[$child]=$child;
            }
        }
        return $childs;
    }
    //单线获取父节点
    function getNodeLever($id)//得到走到根的路径（与路径导航正好相反）本身不在内
    {
        $parents=array();
        if (key_exists($this->cateArray[$id],$this->cateArray))
        {
            $parents[]=$this->cateArray[$id];
            $parents=array_merge($parents,$this->getNodeLever($this->cateArray[$id]));
        }
        return $parents;
    }
    function showPre($id,$useImg=false)
    {
        $img1='└';
        $img2='├';
        $img3='　';
        $img4='│';
        if ($useImg) {
            $imgPath='<img align=absmiddle src=/imgs/';
            $imgfolder=$imgPath.'admin_tree_folder.gif>';
            $img1=$imgPath.'admin_tree_minusbottom.gif>';
            $img2=$imgPath.'admin_tree_minusmiddle.gif>';
            $img3=$imgPath.'admin_tree_empty.gif>';
            $img4=$imgPath.'admin_tree_line.gif>';
            $img5=$imgPath.'admin_tree_plusbottom.gif>';
            $img6=$imgPath.'admin_tree_plusmiddle.gif>';
        }
        $p=$this->getNodeLever($id);
        $pre='';
        foreach($p as $value){
            $temp=($this->isLast($value))?$img3:$img4;
            $pre=$temp.$pre;
        }
        if((count($this->getChild($id))>0)&&($useImg)){//使用图片的话，如有子类，则前面用有“+”的图片
            $img1=$img5;
            $img2=$img6;
        }
        $pre.=$this->isLast($id)?$img1:$img2;//同一层的最后一个用img1，不是最后一个则用img2
        if ($useImg) {//使用图片的话，所有的名字前面都加黄色文件夹的那个图片
            $pre.=$imgfolder;
        }
        return $pre;
    }
    function isLast($id)//是否是同一层的最后一个
    {
        $brother=$this->getChild($this->cateArray[$id]);
        end($brother);
        $result=(key($brother)==$id);
        return $result;
    }
    function getValue ($id)
    {
        return $this->data[$id];
    } // end func
}
