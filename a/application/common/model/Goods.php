<?php
namespace app\common\model;

use think\Model;

class Goods extends Model{
	protected $table = 'shop_goods';

	protected $pk = 'gid';

	protected $insert = ['ctime'];

	public function setCtimeAttr($value){
		return time();
	}
	public function getStatusAttr($value){
		$status = ['1'=>'新品','2'=>'上架','3'=>'下架'];
		return $status[$value];
	}
	//定义关联模型，通过商品模型找到分类模型
	public function cate()
	{
		// belongsTo('要关联的模型','两个模型关联的外键','主模型的主键');
		return $this->belongsTo('Cate','cate_id','cid');
	}



	public function detail()
	{
		return $this->hasMany('Detail','gid','gid');
	}

	public function order()
	{
		return $this->hasMany('Order','gid','gid');
	}

	
}