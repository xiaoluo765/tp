<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cate;


class GoodController extends Controller
{
    public function goodlist(Request $req,$id)
    {
        $condition = [];
        //获取到$id对应的一级类下的所有的二级类的$id的数组
    	$cate_ids = Cate::where('path','like',"%,$id,%")->column('cid');
        //把一级类加到二级类数组中
        //得到一个包含一级类id的二级类的数组
        array_unshift($cate_ids,$id);

        if($id){
            $condition[]=['cate_id','in',$cate_ids];
        }
        //通过搜索商品名称找到这个方法
        $gname = $req -> get('gname');
        // dump($req);die;
        if(!empty($gname)){
            $condition[] = ['gname','like','%'.$gname.'%'];
        }

        //查找二级类下的商品
        
        $goods = Goods::where($condition)->where('stock','<>','0')->where('status','<>','3')->paginate(8)->appends($_GET);
        // var_dump($goods);
        // die;

        return view('good/list',['goods'=>$goods]);
    }
    public function gooddetail($id)
    {
        $detail = Goods::find($id);

        // dump($detail['stock']);die;

    	return view('good/detail',['detail'=>$detail]);
    }
}
