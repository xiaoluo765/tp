<?php

namespace app\common\model;

use think\Model;

class Detail extends Model
{
    protected $table = 'shop_details';
    protected $pk = 'did';

    public static function init()
    {
        //self::event('事件',执行的操作)
        //$detail形参表示当天
        self::event('after_insert',function($detail){
            Goods::find($detail->gid)->setDec('stock',$detail->cnt);
        });

        self::event('before_delete',function($detail){
            Goods::find($detail->gid)->setInc('stock',$detail->cnt);
        });
    } 


    public function order()
    {
        return $this->belongsTo('Order','orders_oid','oid');
    }

    public function goods()
    {
    	return $this->belongsTo('Goods','gid','gid');
    }

}

