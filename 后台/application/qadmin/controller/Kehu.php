<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Kehu extends Com
{

	public function index(){
		$this->assign('sign','kehu');
		return view();
	}
	public function index1(){
		$this->assign('sign','kehu1');
		return view();
	}
	public function qzindex(){
		$this->assign('sign','qzkehu');
		return view();
	}
	public function setyg(){
		$yglist=Db::name('employee')->select();
		$this->assign('khlist',input('get.data'));
		$this->assign('yglist',$yglist);
		return view();
	}
	public function fpajax(){
		$yg=input('post.yg');
		$khlist=input('post.khlist');
		if(strpos($khlist, ',')){
			$kharr=explode(',',$khlist);
			foreach ($kharr as $key => $value) {
				$where['id']=$value;
				$data['fromid']=$yg;
				Db::name('user')->where($where)->update($data);
			}
		}
		else{
			$where['id']=$khlist;
			$data['fromid']=$yg;
			Db::name('user')->where($where)->update($data);
		}
		$arr['code']=200;
		$arr['msg']='分配成功';
		return makejson($arr);
		//$yglist=Db::name('fenpei')->select();
	}
	public function qzkehu(){
		if(input('get.p') && input('get.l'))
		{
	    	$where['fromid']=0;
	    	$where['phone']='';
	    	$thispage=input('get.p');
			$thislimit=input('get.l');
			$count=Db::name('user')->where($where)->count();
	        $res=Db::name('user')->where($where)->limit($thislimit)->page($thispage)->order('id desc')->select();
	        foreach ($res as $key => $value) {
	        	$con['id']=$value['fromid'];
	        	$res[$key]['ygname']=Db::name('employee')->where($con)->find()['name'];
	        	$res[$key]['nickname']=urldecode($value['nickname']);
	        }
	        $arr['code']=0;
	        $arr['data']=$res;
	        $arr['count']=$count;
        }
        else{
        	$arr['code']=404;
	        $arr['data']='参数配置有误';
        }
        echo json_encode($arr,true);
	}
	public function indexajax(){
		if(input('get.p') && input('get.l'))
		{
			$where['phone']=array('neq','');
	    	$where['fromid']=array('neq',0);
	    	$thispage=input('get.p');
			$thislimit=input('get.l');
			$count=Db::name('user')->where($where)->count();
	        $res=Db::name('user')->where($where)->limit($thislimit)->page($thispage)->order('id desc')->select();
	        foreach ($res as $key => $value) {
	        	$con['id']=$value['fromid'];
	        	$res[$key]['ygname']=Db::name('employee')->where($con)->find()['name'];
	        	$res[$key]['nickname']=urldecode($value['nickname']);
	        }
	        $arr['code']=0;
	        $arr['data']=$res;
	        $arr['count']=$count;
        }
        else{
        	$arr['code']=404;
	        $arr['data']='参数配置有误';
        }
        echo json_encode($arr,true);
	}
	public function indexajax1(){
		if(input('get.p') && input('get.l'))
		{
	    	$where['fromid']=0;
	    	$where['phone']=array('neq','');
	    	$thispage=input('get.p');
			$thislimit=input('get.l');
			$count=Db::name('user')->where($where)->count();
	        $res=Db::name('user')->where($where)->limit($thislimit)->page($thispage)->order('id desc')->select();
	        foreach ($res as $key => $value) {
	        	
	        	$res[$key]['nickname']=urldecode($value['nickname']);
	        }
	        $arr['code']=0;
	        $arr['data']=$res;
	        $arr['count']=$count;
        }
        else{
        	$arr['code']=404;
	        $arr['data']='参数配置有误';
        }
        echo json_encode($arr,true);
	}
}