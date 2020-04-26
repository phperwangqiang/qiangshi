<?php
namespace app\qadmin\controller;
use think\Controller;
use think\Session;
use think\Db;
class Index extends Com
{
	public function test(){
		$this->assign('sign','index');
		return view();
	}
    public function index()
    {

    	
        $this->assign('sign','index');
        return view();
    }
    
    public function welcome()
    {
		$mernum = Db::name('members')->count();
		$imeinum = Db::name('imei')->count();
		$imeion = Db::name('imei')->where('state=2')->count();
		$ordernum = Db::name('order_info')->where('pay_status=2')->count();
		
		
		$zhoumer = Db::name('members')->where('`addtime` >= UNIX_TIMESTAMP( "'.date('Y-m-d', strtotime('last day this week')).'" ) AND `addtime` <= UNIX_TIMESTAMP( "'.date('Y-m-d H:i:s', time()).'" )')->count();
		$yuemer = Db::name('members')->where(' `addtime` >= UNIX_TIMESTAMP( "'. date('Y-m-01', time()).'" ) AND `addtime` <= UNIX_TIMESTAMP( "'.date('Y-m-d H:i:s', time()).'" )')->count();
		
		$zhouorder = Db::name('order_info')->where('pay_status=2 and `add_time` >= UNIX_TIMESTAMP( "'.date('Y-m-d', strtotime('last day this week')).'" ) AND `add_time` <= UNIX_TIMESTAMP( "'.date('Y-m-d H:i:s', time()).'" )')->count();
		$yueorder = Db::name('order_info')->where('pay_status=2 and  `add_time` >= UNIX_TIMESTAMP( "'. date('Y-m-01', time()).'" ) AND `add_time` <= UNIX_TIMESTAMP( "'.date('Y-m-d H:i:s', time()).'" )')->count();
		
		
		$this->assign('mernum',$mernum);
		$this->assign('imeinum',$imeinum);
		$this->assign('imeion',$imeion);
		$this->assign('ordernum',$ordernum);
		$this->assign('zhoumer',$zhoumer);
		$this->assign('yuemer',$yuemer);
		$this->assign('zhouorder',$zhouorder);
		$this->assign('yueorder',$yueorder);
        return view();
    }
    public function gsgl()
    {
        return view();
    }
}
