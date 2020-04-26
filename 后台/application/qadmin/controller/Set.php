<?php
namespace app\qadmin\controller;
use think\Controller;
use think\Session;
use think\Db;
use think\Request;
class Set extends Com
{
    public function index(){
        //$con['id']=session('adminid');
        //Db::name('adminuser')->where($con)->find();
        $this->assign('sign','set');
        return view();
    }
    public function indexajax(){
        $con['id']=session('adminid');
        $data['password']=md5(md5(input('post.passwd')).'sx');
        $res=Db::name('adminuser')->where($con)->update($data);
        $arr['code']=200;
        $arr['msg']='修改成功';
        return makejson($arr);
    }
}
