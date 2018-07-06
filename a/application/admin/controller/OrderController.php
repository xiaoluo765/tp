<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;
use app\common\model\Detail;

class OrderController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $conditon = [];
        if(!empty($_GET['status'])){
            $conditon[]=['status','=',$_GET['status']];
            $this->assign('status',$_GET['status']);
        }
        if(!empty($_GET['oid'])){
            $conditon[]=['oid','=',$_GET['oid']];
            $this->assign('oid',$_GET['oid']);
        }
        $order = Order::where($conditon)->paginate(2)->appends($_GET);
        return view('order/index',['order'=>$order]);
    }

    public function show()
    {
        $oid = $_GET['oid'];
        $detail = Detail::where('orders_oid',$oid)->select();
        // dump($detail);die;
        return view('order/show',['detail'=>$detail]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $id = $_GET['oid'];
        $order = Order::get($id);
        return view('order/edit',['order'=>$order]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $id = $_GET['oid'];
        try{
            Order::update($_POST,['oid'=>$id],true);
        }catch(Exception $e){
            return $this->error('订单修改失败','/order/edit?oid'.$id);
        }
        return $this->success('订单修改成功','/order/index');
    }

    public function out($id){
        Order::update(['ostatus'=>'2'],['oid'=>$id],true);
        return $this->success('发货成功');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        $id = $_GET['oid'];
        $orders = Order::find($id);
        // dump($orders);die;
        foreach($orders->detail as $k => $v){
            Detail::destroy($v->did);
        }
        $res = Order::destroy($id);
        if($res){
            return $this->success('订单删除成功','/order/index');
        }else{
            return $this->error('订单删除成功','/order/index');
        }
    }

    public function fa($id,$status=2)
    {
        Order::update(['status'=>$status],['oid'=>$id],true);
        return $this->success('发货成功');
    }

    public function shou($id,$status=3)
    {
        Order::update(['status'=>$status],['oid'=>$id],true);
        return $this->success('收货成功');
    }

    public function cancel($id,$status=4)
    {
        Order::update(['status'=>$status],['oid'=>$id],true);
        return $this->success('取消订单成功');
    }
}
