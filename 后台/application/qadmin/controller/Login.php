<?php
namespace app\qadmin\controller;
use think\Controller;
use think\input;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
class Login  extends Controller
{
    public function index()
    {
		// 获取包含域名的完整URL地址
        // return $this->fetch('index');
     
        // return view('index',['name'=>'thinkphp']);
      
        // // 或者批量赋值
        // $this->assign([
        //     'name'  => 'ThinkPHP',
        //     'email' => 'thinkphp@qq.com'
        // ]);
        // 模板输出
        // $this->display();
        
        return view();
	}

	public function checklogin()
    {
        // echo md5(md5('123456')."sx");
        // exit;
        $map['username'] = input('post.username');
		$map['password'] = md5(md5(input('post.password'))."sx"); 
        $result = Db::name('adminuser')->where($map)->find();
        // dump( Db::getLastSql());
        // dump($_POST);
        // dump($result);die;
        if ($result) 
        {
        	Session::set('adminname',$result['username']);
        	Session::set('adminid',$result['id']);
            $this->success('登陆成功', 'Index/index', 3);
        } else {
            $this->error('登陆失败');
        }
    }
    public function checklogin1(){

        $map['username'] = input('post.username');
        $map['password'] = md5(md5(input('post.password'))."sx"); 
        if(md5(input('post.yzm').Config::get('accesskey'))!=Session::get('verify_result'))
            {
                $arr['code']=101;
                $arr['msg']='验证码错误';
        }
        else{
             $result = Db::name('adminuser')->where($map)->find();
       
            if ($result) 
            {
                Session::set('adminname',$result['username']);
                Session::set('adminid',$result['id']);
                $arr['code']=200;
                $arr['msg']='登录成功';
            } else {
                $arr['code']=400;
                $arr['msg']='用户名或密码错误';
            }
        }
       
        return json_encode($arr,true);
    }
    public function logout()
    {
        session(null);
        echo 0;
    }
}
