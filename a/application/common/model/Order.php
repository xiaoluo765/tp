<?php

namespace app\common\model;

use think\Model;

class Order extends Model
{
    protected $table = 'shop_orders';
    protected $pk = 'oid';
    protected $insert = ['create_at'];

    public function getStatusAttr($value){
    	$status = ['1'=>'已下单','2'=>'已发货','3'=>'已收货','4'=>'取消订单'];
    	return $status[$value];
    }

    public function detail()
    {
    	return $this->hasMany('Detail','orders_oid','oid');
    }

    public function goods()
    {
        return $this->belongsTo('Goods','gid','gid');
    }

    
}
