<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\input;
use think\Config;
class Login extends Controller{
 public function index()
    {
    	 $info=Config::get('Wx');
    	 $appid=$info['appid'];
    	 $secret=$info['secret'];
        $code=input('post.code');
//        echo $code;
        $url='https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';
        $res=$this->curlqingqiu($url);
       
        $openid=json_decode($res,true)['openid'];
        $session_key=json_decode($res,true)['session_key'];
        $cunzaiwhere['openid']=$openid;
        $iscunzai=Db::name('user')->where($cunzaiwhere)->find();
        if($iscunzai)
        {
            //如果存在执行登录
            $token=$this->maketoken();
            $adata['token']=$token;
            $adata['session_key']=$session_key;
            $res1=Db::name('user')->where($cunzaiwhere)->update($adata);
            $ret=Db::name('user')->where($cunzaiwhere)->find();
            $ret['nickname']=urldecode($ret['nickname']);
            if($res1)
            {
                $data['userid']=$ret['id'];
                $data['token']=$token;
                $arr['code']=200;
                $arr['msg']='success';
                $arr['data']=$ret;
            }        	
            else{
                $arr['code']=400;
                $arr['msg']='faild';
            }
        }
        else{
        	//如果不存在执行注册并登录
            $bdata['token']=$this->maketoken();
            $bdata['session_key']=$session_key;
            $bdata['createat']=date('Y-m-d H:i:s',time());
            $bdata['inputtime']=time();
            $bdata['openid']=$openid;
            
            $res2=Db::name('user')->insertGetId($bdata);
            $data=Db::name('user')->where('id='.$res2)->find();
            $data['nickname']=urldecode($data['nickname']);
            if($res2)        	
            {
                $data['token']=$bdata['token'];
                $data['userid']=$res2;
                $arr['code']=200;
                $arr['msg']='success';
                $arr['data']=$data;
            }        	
            else{
                $arr['code']=400;
                $arr['msg']='faild';
            }
        }
        return makejson($arr);
    }
    public function maketoken(){
        $token=rand(123123123,999999999);
        $tokenmd5=md5($token);
        return $tokenmd5;
    }
    public function upnicknameandavatar(){
        $data['nickname']=urlencode(input('post.nickname'));
        $data['picurl']=input('post.avatarurl');
        $data['country']=input('post.country');
        $data['province']=input('post.province');
        $data['city']=input('post.city');
        $where['id']=input('post.uid');
        $res=Db::name('user')->where($where)->update($data);
        if($res)		
        {
            $arr['code']=200;
            $arr['msg']='success';
        }		
        else{
            $arr['code']=200;
            $arr['msg']='success';
        }
        return makejson($arr);
    }
     public function curlqingqiu($url){
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括URL
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        // 3. 执行并获取HTML文档内容
    	$output = curl_exec($ch);
    	return $output;
    	if($output === FALSE ){
    	    echo "CURL Error:".curl_error($ch);
    	}
    	// 4. 释放curl句柄
        curl_close($ch);
    }
}