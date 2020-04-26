<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Pic extends Controller
{

	public function thumbupload(){
		$file = request()->file('file'); // 获取上传的文件
	    if ($file==null) {
	        exit(json_encode(array('code'=>0, 'msg'=>'未上传图片')));
	    }
	    // 获取文件后缀
	    $temp = explode(".", $_FILES["file"]["name"]);
	    $extension = end($temp);
	    // 判断文件是否合法
	    if(!in_array($extension, array("gif","jpeg","jpg","png"))){
	        exit(json_encode(array('code'=>0, 'msg'=>'上传图片不合法')));
	    }
	    $info = $file->move(ROOT_PATH.'public'.DS.'uploads'); // 移动文件到指定目录 没有则创建
	    $img = '/uploads/'.$info->getSaveName();
	    exit(json_encode(array('code'=>1, 'msg'=>$img)));
	}
}