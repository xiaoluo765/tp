<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cate;

class GoodsController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    
    public function index()
    {
        $conditon = [];
        if(!empty($_GET['gname'])){
            $conditon[] = ['gname','like',"%{$_GET['gname']}%"];
            $conditon[] = ['price','like',"%{$_GET['gname']}%"];
            $conditon[] = ['status','like',"%{$_GET['gname']}%"];
            $conditon[] = ['stock','like',"%{$_GET['gname']}%"];
            $this->assign('gname',$_GET['gname']);
        }
        if(!empty($_GET['cate_id'])){
            $conditon[] = ['cate_id','=',$_GET['cate_id']];
            $this->assign('cate_id',$_GET['cate_id']);
        }
        $goods = Goods::whereor($conditon)->paginate(5)->appends($_GET);
        // dump($goods);die;
        // $goods = Goods::select();
        $cate = Cate::order('concat(path,cid)')->select();
        return view('goods/index',['goods'=>$goods,'cate'=>$cate]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $cate = Cate::order('concat(path,cid)')->select();
        // $image = \think\Image::open($str);
        return view('goods/insert',['cate'=>$cate]);
    
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {

        $data = $req->post();
        // echo '<pre>';
        // var_dump($data['cate_id']);
        // die;
        if(empty($data['cate_id'])){
            return $this->error('商品分类不能为空');
        }
        $file = $req->file('gpic');
        $info = $file -> move('static/uploads');
        if($info){
            // // return $this->success('添加成功','/goods/index');
            // echo $info->getExtension();
            // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getSaveName();
            // // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename();
            //图片路径
            $str = '/static/uploads/'.$info->getSaveName();
        }else{
            // return $this->error('添加失败','/goods/create');
            return $file->getError();

        }
        $data['gpic']=$str;


        $res = Goods::create($data,true);

        if($res){
            return $this->success('添加商品成功','/goods/index');
        }else{
            return $this->error('添加商品失败','/goods/create');
        }
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
        $goods = Goods::find($id);
        $cates = Cate::order('concat(path,cid)')->select();
        return view('goods/edit',['goods'=>$goods,'cates'=>$cates]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $req,$id)
    {
        $data = $req->post();
        $file = $req->file('gpic');
        if($file){
            $info = $file->move('static/uploads');
            $filename = '/static/uploads/'.$info->getSaveName();
            $data['gpic'] = $filename;
        }
        try{
            Goods::update($data,['gid'=>$id],true);
        }catch(Exception $e){
            return $this->error('修改失败',"/goods/{$id}/edit");
        }
        return $this->success('修改成功','/goods/index');
    }

    public function up($id,$status=2)
    {
        Goods::update(['status'=>$status],['gid'=>$id],true);
        return $this->success('商品上架成功');
    }
    public function down($id,$status=3)
    {
        Goods::update(['status'=>$status],['gid'=>$id],true);
        return $this->success('商品下架成功');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = Goods::destroy($id);
        if($res){
            return $this->success('删除成功','/goods/index');
        }else{
            return $this->error('删除失败','/goods/index');
        }
    }
}
