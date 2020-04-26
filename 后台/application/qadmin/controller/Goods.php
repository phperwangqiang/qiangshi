<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Goods extends Com
{
	public function index(){
		$this->assign('sign','goods');
		return view();
	}
	//视频列表数据
	public function indexajax(){
		if(input('get.p') && input('get.l'))
		{
	    	$where=array();
	    	$thispage=input('get.p');
			$thislimit=input('get.l');
			$count=Db::name('goods')->where($where)->count();
	        $res=Db::name('goods')->where($where)->limit($thislimit)->page($thispage)->order('id desc')->select();
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
			$res=Db::name('goods')->where($where)->find();
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
		$picurl=input('post.picurl');
		$price=input('post.price');
		$id=input('post.id');
		if($id!="" && $name!="" && $description!=""  && $picurl!="")
		{
			$where['name']=$name;
			$where['id']=array('neq',$id);
			$iscunzai=Db::name('goods')->where($where)->find();
			if($iscunzai){
				$arr['code']=402;
				$arr['msg']='商品名称已经存在';
			}
			else{
				$con['id']=$id;
				$data['name']=$name;
				$data['description']=$description;
				$data['mobile']=input('post.mobile');
				$data['price']=input('post.price');
				$data['picurl']=$picurl;
				$data['inputtime']=time();
				$data['createat']=date('Y-m-d H:i:s',time());
				$res=Db::name('goods')->where($con)->update($data);
				if($res)
				{
					$arr['code']=200;
					$arr['msg']='修改成功';
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
		$this->assign('sign','goods');
		return view();
	}
	public function addajax(){
		$name=input('post.name');
		$description=input('post.description');
		$price=input('post.price');
		$picurl=input('post.picurl');
		if($name!="" && $description!="" && $picurl!="")
		{
			$where['name']=$name;
			$iscunzai=Db::name('case')->where($where)->find();
			if($iscunzai){
				$arr['code']=402;
				$arr['msg']='视频名称已经存在';
			}
			else{
				$data['name']=$name;
				$data['description']=$description;
				$data['picurl']=$picurl;
				$data['price']=$price;
				$data['inputtime']=time();
				$data['createat']=date('Y-m-d H:i:s',time());
				$data['mobile']=input('post.mobile');
				$res=Db::name('goods')->insert($data);
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
			$res=Db::name('goods')->where($where)->delete();
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