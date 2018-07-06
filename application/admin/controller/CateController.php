<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Cate;

class CateController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $conditon = [];
        if(!empty($_GET['cname'])){
            $conditon[] = ['cname','like',"%{$_GET['cname']}%"];
            $conditon[] = ['pid','like',"%{$_GET['cname']}%"];
            $conditon[] = ['cid','like',"%{$_GET['cname']}%"];
            $this->assign('cname',$_GET['cname']);
        }
        if(!empty($_GET['cid'])){
            $conditon[] = ['cid','=',$_GET['cid']];
            $this->assign('cid',$_GET['cid']);
        }
        $cates = Cate::where($conditon)->order('concat(path,cid)')->select();
        $cate = Cate::whereor($conditon)->order('concat(path,cid)')->paginate(10)->appends($_GET);
        return view('cate/index',['cate'=>$cate,'cates'=>$cates]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($id)
    {
        //如果此方法对应路由动态部分，就需要在方法的参数中定义一个参数来匹配动态的那部分内容
        //select * from shop_cate order by concat(path,cid);
        //path,cid两列合并后排序
        $cate = Cate::order('concat(path,cid)')->select();
        return view('cate/insert',['cate'=>$cate,'cid'=>$id]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $req)
    {
        $data = $req -> post();
        //组装path字段
        //如果是一级类，path=0
        if($data['pid'] == '0'){
            $data['path'] = '0,';
        }else{
            //如果不是一级类，path=父类id的path+'父类ID,'
            $data['path']=Cate::get($data['pid'])->path.$data['pid'].',';
        }

        try{
            Cate::create($data,true);
        }catch(\Exception $e){
            return $this->error('分类添加失败','/cate/create');
        }
        return $this->success('分类添加成功','/cate/index');
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
        $cate = Cate::find($id);
        return view('cate/edit',['cate'=>$cate]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request 请求对象，所有跟请求相关的信息都在里面，只需要获取到用户提交的post
     * @param  int  $id  要修改的那个分类的id，cate/update/:id
     * @return \think\Response
     */
    public function update(Request $req,$id)
    {
        //获取表单提交的post数据
        $data = $req->post();
        try{
            Cate::update($data,['cid'=>$id],true);
        }catch(\Exception $e){
            return $this->error('修改失败',"/cate/{$id}/edit");
        }
        return $this->success('修改成功','/cate/index');

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $cate = Cate::where('pid','=',$id)->find();
        if($cate){
            //$cate=0时没有子类
            return $this->error('当前类有子类，不能删除','/cate/index');
        }
        $res = Cate::destroy($id);
        if($res){
            return $this->success('分类删除成功','/cate/index');
        }else{
            return $this->error('分类删除失败','/cate/index');
        }
    }
}
