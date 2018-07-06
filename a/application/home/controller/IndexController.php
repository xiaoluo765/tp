<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Cate;
use think\facade\Session;
use app\common\model\Goods;


class IndexController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
     {
    //     $good = Goods::all('91,92,93,94,95,96');
        $lunbo = Goods::all('108,109,110,111,112');
        $goods = Goods::select();
        return view('index/index',['goods'=>$goods,'lunbo'=>$lunbo]);
        
    }

    public function header()
    {
        $goods = Goods::select();
        // echo '<pre>';
        // var_dump($goods);
        // die;
        return view('common/index_header',['goods'=>$goods]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
