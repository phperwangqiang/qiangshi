<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Info extends Com
{
	public function index(){
		$info=Db::name('company')->where('id=1')->find();
		$this->assign('info',$info);
		$this->assign('sign','info');
		return view();
	}
	public function editajax(){
		if(input('post.name')!="" && input('post.picurl')!="")
		{
			$iscunzai=Db::name('company')->where('id=1')->find();
			if($iscunzai){
				$data['name']=input('post.name');
				$data['picurl']=input('post.picurl');
				$data['updatetime']=time();
				$data['updateat']=date('Y-m-d H:i:s',time());
				Db::name('company')->where('id=1')->update($data);
			}
			else{
				$data['name']=input('post.name');
				$data['picurl']=input('post.picurl');
				$data['inputtime']=time();
				$data['createat']=date('Y-m-d H:i:s',time());
				Db::name('company')->insert($data);
			}
			$arr['code']=200;
			$arr['msg']='修改成功';
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
}