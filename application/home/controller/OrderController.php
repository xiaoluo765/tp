<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;
use app\common\model\Detail;
use app\common\model\Homelogin;

class OrderController extends Controller
{
    //收货人信息
    public function info(){
        return view('order/info');
    }
    //结算页
    public function jsy(Request $req)
    {
        $tel_pattern = '/^1[3-9]\d{9}$/';
        if(!preg_match($tel_pattern,$req->post('tel'))){
            return $this->error('手机号不符合','/order/info');
        }
        if(empty($req->post('rec')) && empty($req->post('tel')) && empty($req->post('addr'))){
            return $this->error('信息不能为空','/order/info');
        }
        session('orders.rec',$req->post('rec'));
        session('orders.tel',$req->post('tel'));
        session('orders.addr',$req->post('addr'));
        session('orders.umsg',$req->post('umsg'));

        $carts = session('cart');
        // $num = 0;
        // $total = 0;
        // foreach($carts as $k => $v){
        //     $num += $v->cnt;
        //     $total += $v->price * $v->cnt;
        // }
        // session('orders.total',$total);
        return view('order/jsy',['carts'=>$carts]);
    }

    //结算完成页
    public function ok()
    {
        foreach(session('cart') as $k => $v){
            $cnt = $v->cnt;
        }
        session('orders.cnt',$cnt);
        session('orders.oid',date('YmdHis').mt_rand(1000,9999));
        session('orders.user_uid',session('homeUser.uid'));
        session('orders.status',1);
        session('orders.create_at',time());
        session('orders.total',session('count'));
        // session([
        //     'orders.cnt' => $cnt,
        //     'orders.oid' => date('YmdHis').mt_rand(1000,9999),
        //     'orders.user_uid' => session('homeUser.uid'),
        //     'orders.status' => 1,
        //     'orders.create_at' => time(),
        //     'orders.total' => session('count'),
        //     ]);
        // echo '<pre>';
        // var_dump(session('cart'));die;
        try{
            $order = Order::create(session('orders'),true);
            $order->detail()->saveAll(session('cart'));
        }catch(\Exception $e){
            return $this->error('订单提交失败','/');
        }

        $msg = [
            'rec'   => session('orders.rec'),
            'tel'   => session('orders.tel'),
            'addr'  => session('orders.addr'),
            'oid'  => session('orders.oid'),
            'count' => session('count'),
        ];
        session('cart',null);
        session('orders',null);
        // echo '<pre>';
        // var_dump($msg);die;
        return view('order/success',['msg'=>$msg]);
    }

    public function myorder()
    {
        
        $total = 0;
        $cnt = 0;
        $order = Order::where('user_uid','=',session('homeUser.uid'))->paginate(2);
        $orders = Order::where('user_uid','=',session('homeUser.uid'))->select();
        foreach($orders as $k => $v){
            $total += $v['total'];
            $cnt = $v['cnt'];
        }
        // $orders = Order::where('user_uid','=',session('homeUser.uid'))->where('status','!=','取消');

        // dump($orders);
        // die;
        return view('order/myorder',['order'=>$order,'total'=>$total]);
    }

    public function cancel($id,$status=4)
    {
        Order::update(['status'=>$status],['oid'=>$id],true);
        return $this->success('取消成功');
    }

    public function queren($id,$status=3)
    {
        Order::update(['status'=>$status],['oid'=>$id],true);
        return $this->success('收货成功');
    }

    public function delete($id)
    {
        $orders = Order::find($id);
        // dump($orders);die;
        foreach($orders->detail as $k => $v){
            Detail::destroy($v->did);
        }
        $res = Order::destroy($id);
        if($res){
            return $this->success('订单取消成功','/order/myorder');
        }else{
            return $this->error('订单取消成功','/order/myorder');
        }
    }


    
}




