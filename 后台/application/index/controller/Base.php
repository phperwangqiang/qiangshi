<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Config;
use think\Request;
use think\Input;
use think\Db;
class Base extends Controller{
	public function thumbupload(Request $request)
	{
		$file = request()->file('file'); // 获取上传的文件
	    if ($file==null) {
	        exit(json_encode(array('code'=>0, 'msg'=>'未上传图片')));
	    }
	    // 获取文件后缀
	    $temp = explode(".", $_FILES["file"]["name"]);
	    $extension = end($temp);
	    // 判断文件是否合法
	    if(!in_array($extension, array("gif","jpeg","jpg","png","mp4","mov"))){
	        exit(json_encode(array('code'=>0, 'msg'=>'上传图片不合法')));
	    }
	    $info = $file->move(ROOT_PATH.'public'.DS.'uploads'); // 移动文件到指定目录 没有则创建
	    $img = '/uploads/'.$info->getSaveName();
	    exit(json_encode(array('code'=>1, 'msg'=>$img,'temp'=>$temp)));
	}
		public function post($url, $data, $proxy = null, $timeout = 20) {
			$curl = curl_init();  
			curl_setopt($curl, CURLOPT_URL, $url);    
			curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); //在HTTP请求中包含一个"User-Agent: "头的字符串。        
			curl_setopt($curl, CURLOPT_HEADER, 0); //启用时会将头文件的信息作为数据流输出。   
			curl_setopt($curl, CURLOPT_POST, true); //发送一个常规的Post请求  
			curl_setopt($curl,  CURLOPT_POSTFIELDS, $data);//Post提交的数据包  
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。     
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //文件流形式         
			curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); //设置cURL允许执行的最长秒数。   
			$content = curl_exec($curl);  
			curl_close($curl);  
			unset($curl);
			return $content;  
		} 
     public function sendsmscode(){
		$phone=input('post.phone');
		$code=rand(100000,999999);
		$da['code']=$code;
		$da['phone']=$phone;
		$da['inputtime']=time();

		$content='您的验证码为：'.$code.'，请不要将验证码告诉其他人，注意您的账户安全';
		$data['Account'] = '15940938933';
		$data['Pwd'] 	 = 'cd3c8b64a9425b48369283551';
		$data['Content'] = $content;
		$data['Mobile']	 = input('post.phone');
		$data['SignId']	 = '50287';
		$url="http://api.feige.ee/SmsService/Send";
			$res=$this->post($url,$data);
			if(json_decode($res,true)['Code']==0)
			{
				$res1=Db::name('smscode')->insert($da);
				$arr['code']='0000';
				$arr['msg']='发送成功';
			}
			else{
				$arr['code']='0001';
				$arr['msg']='用户发送短信超过限制，无法发送。';
			}
			return makejson($arr);
	}
	  public function getimgValidate(){
	  // echo 	dirname(__FILE__);
	  // exit;
	  $w=130;
	  $h=35;
	  $img = imagecreate($w,$h);
	  $gray = imagecolorallocate($img,0,0,0);
	  $black = imagecolorallocate($img,255,255,255);
	  $red = imagecolorallocate($img, 255, 0, 0);
	  $white = imagecolorallocate($img, 0, 0, 0);
	  $green = imagecolorallocate($img, 0, 255, 0);
	  $blue = imagecolorallocate($img, 0, 0, 255);
	  imagefilledrectangle($img, 0, 0, $w, $h, $black);
	  for($i = 0;$i < 80;$i++){
	    imagesetpixel($img, rand(0,$w), rand(0,$h), $gray);
	  }
	  $num1 = rand(1,9);
	  $num2 = rand(1,9);

	  imagettftext($img,20,rand(-45,45),10,25,$gray,dirname(__FILE__).'/../../a.ttf',$num1);
	  
	  $ss=$this->getRand();
	  imagettftext($img,20,rand(-5,5),35,25,$gray,dirname(__FILE__).'/../../a.ttf',$ss);
	  imagettftext($img,20,rand(-45,45),55,25,$gray,dirname(__FILE__).'/../../a.ttf',$num2);
	  imagettftext($img,20,rand(-15,15),75,25,$gray,dirname(__FILE__).'/../../a.ttf',"=");
	  imagettftext($img,20,rand(-15,15),100,25,$gray,dirname(__FILE__).'/../../a.ttf',"?");
	  // imagestring($img,5,65,rand(1,15),"=", $gray);
	  // imagestring($img,5,80,rand(1,15),"?", $gray);
	   header("content-type:image/png");
	  imagepng($img);
	  imagedestroy($img);
	  if($ss=="+")
	  {
	$result=$num1+$num2;
	  }
	  else if($ss=='-')
	  {
	     $result=$num1-$num2;
	 
	  }
	  else if($ss=="X")
	  {
	    $result=$num1*$num2;
	  }
	  Session::set('verify_result',md5($result.Config::get('accesskey')));
	}
	public function getRand(){
	  $code = rand(0,2);
	  switch ($code) {
	    case 0:
	      return "+";
	      break;
	    case 1:
	      return "-";
	      break;
	    case 2:
	      return "X";
	      break;
	    default:
	      # code...
	      break;
	  }
	}
	public function verifyisok($e){
	     if($e == $_SESSION['verify_result'])
	     {
	        return 1;
	     }
	     else{
	        return 0;
	     }
	}
	//新闻列表
	public function NewsList(){
		//页数 个数 栏目名
		if(input('get.p') && input('get.l')&&input('get.cid'))
		{
			$thispage=input('get.p');
			$thislimit=input('get.l');
			$ncont['cid']=input('get.cid');
			$count=Db::name('news')->where($ncont)->count();
			$res=Db::name('news')->where($ncont)->limit($thislimit)->page($thispage)->order('id desc')->select();
			$arr['code']=0;
			$arr['data']=$res;
			$arr['count']=$count;
			echo makejson($arr);
		}
		else{
			$arr['code']=1;
			$arr['data']="参数错误";
			echo makejson($arr);
		}
	}
	public function  _initialize(){
		// $tongji['ip']=getIP();
		// $tongji['inputtime']=time();
		// $tongji['creat_at']=date("Y-m-d H:i:s",time());
		// $tongji['url']=Request::instance()->domain().request() -> url();
		// Db::name('tongji')->insert($tongji);
	}
}