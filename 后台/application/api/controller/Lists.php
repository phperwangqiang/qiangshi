<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\input;
use think\Config;
class Lists extends Controller{
	//视频列表
	public function shipin(){
		if(input('post.uid')!="")
		{
			$res=Db::name('video')->select();
			if($res){
				$arr['code']=200;
				$arr['msg']='请求成功';
				$arr['data']=$res;
			}
			else{
				$arr['code']=400;
				$arr['msg']='还未上传视频';
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	//案例列表
	public function cases(){
		if(input('post.uid')!="")
		{
			$res=Db::name('case')->select();
			if($res){
				$arr['code']=200;
				$arr['msg']='请求成功';
				$arr['data']=$res;
			}
			else{
				$arr['code']=400;
				$arr['msg']='还未上传案例';
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	//商品列表
	public function goods(){
		if(input('post.uid')!="")
		{
			$res=Db::name('goods')->select();
			if($res){
				$arr['code']=200;
				$arr['msg']='请求成功';
				$arr['data']=$res;
			}
			else{
				$arr['code']=400;
				$arr['msg']='还未上传商品';
			}
		}
		else{
			$arr['code']=401;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	} 
}