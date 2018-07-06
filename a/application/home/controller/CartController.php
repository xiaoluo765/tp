<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;

class CartController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function addCart(Request $req)
    {
        //获取购买商品的id
        $gid = $req->post('gid');
        //获取要购买商品的信息
        $goods = Goods::find($gid);

        $cnt = $req->post('cnt');
        $goods->cnt = $cnt;
        //将要添加到购物车中的商品保存到session中，为了防止覆盖，使用的是一个二维的数组
        //$goods是一个一维数组，
        session("cart.$gid",$goods);
        return view('cart/mycart',['goods'=>$goods]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function listCar(Request $req)
    {
        $goods = Goods::where('gname','like','%米%')->select();
        //总金额
        $count = 0;
        //总数量
        $sum = 0;
        // echo '<pre>';
        // var_dump(session('cart'));die;
        if(!empty(session('cart'))){
            foreach(session('cart') as $k => $v){
                $sum += $v->cnt;
                $count += $v->cnt * $v->price;
            }
        }
        session('sum',$sum);
        session('count',$count);
        return view('cart/car',['sum'=>$sum,'count'=>$count,'goods'=>$goods]);
    }

    public function incr($id){
        //从购物车中找到要修改数量的商品，将商品的cnt字段的值+1
        //cart中存放的是对象数组，数组中每个元素都是一个商品对象
        session("cart.$id")->cnt++;
        //跳转到指定路由
        return redirect('/cart/list');
    }

    public function desc($id){
        if(session("cart.$id")->cnt <= 1){
            session("cart.$id")->cnt = 1;
        }else{
            session("cart.$id")->cnt--;
        }
        return redirect('/cart/list');

    }

    public function delete($id)
    {
        session("cart.$id",null);
        return redirect('/cart/list');
    }
    
    
}
