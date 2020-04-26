<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\input;
use think\Config;
class Employee extends Controller{
	public function login(){
		if(input('post.username')!="" && input('post.userpwd')!="")
		{
			$where['mobile']=input('post.username');
			$where['passwd']=input('post.userpwd');
			$res=Db::name('employee')->where($where)->find();
			if($res){
				$con['phone']=array('neq','');
				$con['fromid']=$res['id'];

				$khlist=Db::name('user')->where($con)->select();
				foreach ($khlist as $key=>$value){
					$khlist[$key]['nickname']=urldecode($value['nickname']);
				}
				if($khlist)
				{
					$arr['code']=200;
					$arr['msg']='获取成功';
					$arr['data']=$khlist;
				}
				else{
					$arr['code']=400;
					$arr['msg']='没有分配客户';
				}
				
			}
			else{
				$arr['code']=401;
				$arr['msg']='用户名或密码错误';
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='请输入用户名和密码';
		}
		return makejson($arr);
	}
}