<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\input;
use think\Config;
class Home extends Controller{
	public function enable(){
		$arr['code']=200;
		$arr['msg']=0;
		return makejson($arr);
	}
	public function decryptData( $encryptedData, $iv, &$data,$sessionKey,$appid )
	{
	   if (strlen($sessionKey) != 24) {
	      return "1000";
	   }
	   $aesKey=base64_decode($sessionKey);
	   if (strlen($iv) != 24) {
	      return "error2";
	   }
	   $aesIV=base64_decode($iv);
	   $aesCipher=base64_decode($encryptedData);
	   $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
	   $dataObj=json_decode($result);
	   if( $dataObj  == NULL )
	   {
	      return "aes 解密失败1";
	   }
	   if( $dataObj->watermark->appid != $appid )
	   {
	      return "aes 解密失败2";
	   }
	   $data = $result;
	   return "OK";
	}
	public function get_session_key(){
     
  	}
	public function getcompanyinfo(){
		if(input('post.uid')!=""){
			$company=Db::name('company')->where('id=1')->find();
			if($company)
			{
				$arr['code']=200;
				$arr['msg']='请求成功';
				$arr['data']=$company;
			}
			else{
				$arr['code']=404;
				$arr['msg']='请配置LOGO和公司名称';
			}
		}
		else{
			$arr['code']='400';
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	public function isupmobile(){
		if(input('post.uid')!=""){
			$where['id']=input('post.uid');
			$res=Db::name('user')->where($where)->find();
			if($res["phone"]!="")
			{
				$arr['code']=200;
				$arr['msg']='已经获取';
			}
			else{
				$arr['code']=201;
				$arr['msg']='还未获取';
			}
		}
		else{
			$arr['code']=400;
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
	public function upmobile(){
		if(input('post.uid')!="" && input('post.iv')!="" && input('post.encryptedData')!="" && input('post.type')!="" && input('post.tid')!="")
		{
			$encryptedData=input('post.encryptedData');
		     $iv=input('post.iv');
		     $uid=input('post.uid');
		     $uwhere['id']=$uid;
		     $userinfo=Db::name('user')->where($uwhere)->find();
		     $openid=$userinfo['openid'];
		     $info1=Config::get('Wx');
		     $appid=$info1['appid'];
		     $secret=$info1['secret'];
		     $sessionKey=urldecode($userinfo['session_key']);
		     if($openid&&$appid&&$iv&&$encryptedData){
		        
		        $errCode = $this->decryptData($encryptedData, $iv, $data,$sessionKey,$appid);
		        
		        $mobile=json_decode($data,true)['phoneNumber'];

		     }
		    
			$where['id']=input('post.uid');
			$res=Db::name('user')->where($where)->find();
			if($res)
			{
				$bdata['phone']=$mobile;
				if($res['reson']=="")
				{
					$tid=input('post.tid');
					$type=input('post.type');

					if($type==1)
					{
						$typestr='视频';
						$n1con['id']=$tid;
						$namestr=Db::name('video')->where($n1con)->find()['name'];
					}
					else if($type==2)
					{
						$typestr='案例';
						$n1con['id']=$tid;
						$namestr=Db::name('case')->where($n1con)->find()['name'];
					}
					else{
						$typestr='商品';
						$n1con['id']=$tid;
						$namestr=Db::name('goods')->where($n1con)->find()['name'];
					}
					$bdata['reson']='通过'.$typestr."《".$namestr."》获取到";
				}
				
				$res=Db::name('user')->where($where)->update($bdata);
				if($res)
				{
					$arr['code']=200;
					$arr['msg']='上传成功';
				}
				else{
					$arr['code']=401;
					$arr['msg']='已获取';
				}
			}
			else{
				$arr['code']=400;
				$arr['msg']='身份验证失败';
			}
			
		}
		else{
			$arr['code']='402';
			$arr['msg']='参数错误';
		}
		return makejson($arr);
	}
}