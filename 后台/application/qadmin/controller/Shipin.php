<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Shipin extends Com
{
	public function play(){
		return view();
	}
	public function index(){
		$this->assign('sign','shipin');
		return view();
	}
	//视频列表数据
	public function indexajax(){
		if(input('get.p') && input('get.l'))
		{
	    	$where=array();
	    	$thispage=input('get.p');
			$thislimit=input('get.l');
			$count=Db::name('video')->where($where)->count();
	        $res=Db::name('video')->where($where)->limit($thislimit)->page($thispage)->order('id desc')->select();
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
	//修改
	public function edit(){
		if(input('get.id')){
			$where['id']=input('get.id');
			$res=Db::name('video')->where($where)->find();
			$this->assign('res',$res);
			return view();
		}
		else{
			echo '参数错误';
		}
	}
	public function editajax(){
		$name=input('post.name');
		$description=input('post.description');
		$videourl=input('post.videourl');
		$picurl=input('post.picurl');
		$id=input('post.id');
		if($id!="" && $name!="" && $description!="" && $videourl!="" && $picurl!="")
		{
			$where['name']=$name;
			$where['id']=array('neq',$id);
			$iscunzai=Db::name('video')->where($where)->find();
			if($iscunzai){
				$arr['code']=402;
				$arr['msg']='视频名称已经存在';
			}
			else{
				$con['id']=$id;
				$data['name']=$name;
				$data['description']=$description;
				$data['videourl']=$videourl;
				$data['picurl']=$picurl;
				$data['inputtime']=time();
				$data['mobile']=input('post.mobile');
				$data['wxewm']=input('post.wxewm');
				$data['createat']=date('Y-m-d H:i:s',time());
				$res=Db::name('video')->where($con)->update($data);
				if($res)
				{
					$arr['code']=200;
					$arr['msg']='添加成功';
				}
				else{
					$arr['code']=400;
					$arr['msg']='网络故障';
				}
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	//添加
	public function add(){
		$this->assign('sign','shipin');
		return view();
	}
	public function addajax(){
		$name=input('post.name');
		$description=input('post.description');
		$videourl=input('post.videourl');
		$picurl=input('post.picurl');
		if($name!="" && $description!="" && $videourl!="" && $picurl!="")
		{
			$where['name']=$name;
			$iscunzai=Db::name('video')->where($where)->find();
			if($iscunzai){
				$arr['code']=402;
				$arr['msg']='视频名称已经存在';
			}
			else{
				$data['name']=$name;
				$data['description']=$description;
				$data['videourl']=$videourl;
				$data['picurl']=$picurl;
				$data['wxewm']=input('post.wxewm');
				$data['mobile']=input('post.mobile');
				$data['inputtime']=time();
				$data['createat']=date('Y-m-d H:i:s',time());
				$res=Db::name('video')->insert($data);
				if($res)
				{
					$arr['code']=200;
					$arr['msg']='添加成功';
				}
				else{
					$arr['code']=400;
					$arr['msg']='网络故障';
				}
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	//删除
	public function del(){
		if(input('post.id')!="")
		{
			$where['id']=input('post.id');
			$res=Db::name('video')->where($where)->delete();
			if($res)
			{
				$arr['code']=200;
				$arr['msg']='删除成功';
			}
			else{
				$arr['code']=404;
				$arr['msg']='删除失败';
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数有误';
		}
		return makejson($arr);
	}
	
}