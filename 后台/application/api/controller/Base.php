<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\input;
class Base extends Controller{
	
    public function weChatLogin()
    {
        $code=input('post.code');
        
        $url='https://api.weixin.qq.com/sns/jscode2session?appid=wx8732da3322a6061e&secret=d69c12765b7853d405c4dfceb85db17f&js_code='.$code.'&grant_type=authorization_code';
        $res=$this->curlqingqiu($url);
        echo json_encode($res);
        exit;
        $openid=json_decode($res,true)['openid'];
        $session_key=json_decode($res,true)['session_key'];
        $cunzaiwhere['openid']=$openid;
        $iscunzai=Db::name('phone_user')->where($cunzaiwhere)->find();
        if($iscunzai)
        {
            //如果存在执行登录
            $token=$this->maketoken();
            $adata['token']=$token;
            $adata['session_key']=$session_key;
            $res1=Db::name('phone_user')->where($cunzaiwhere)->update($adata);
            $ret=Db::name('phone_user')->where($cunzaiwhere)->find();
            if($res1)
            {
                $data['userid']=$ret['id'];
                $data['token']=$token;
                $arr['code']=200;
                $arr['msg']='success';
                $arr['data']=$data;
            }        	else{
                $arr['code']=400;
                $arr['msg']='faild';
            }
        }
        else{        	//如果不存在执行注册并登录
            $bdata['token']=$this->maketoken();
            $bdata['session_key']=$session_key;
            $bdata['creatime']=time();
            $bdata['openid']=$openid;
            $bdata['type']=0;
            $res2=Db::name('phone_user')->insertGetId($bdata);
            if($res2)        	{
                $data['token']=$bdata['token'];
                $data['userid']=$res2;
                $arr['code']=200;
                $arr['msg']='success';
                $arr['data']=$data;
            }        	else{
                $arr['code']=400;
                $arr['msg']='faild';
            }
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