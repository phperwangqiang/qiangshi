<?php
namespace app\qadmin\controller;
use think\Controller;
use think\Session;
use think\Db;
class Com extends Controller
{
	protected $_model;

    public function _initialize()
    {
        parent::_initialize();
        if(session('adminid') < 1) 
        {
        	$this->redirect('Login/index');
    	}
    	
    }

    public function delete()
	{
		Db::name($this->_model)->delete(input('id'));
	}

	public function state()
	{
		Db::name($this->_model)->update(input('post.'));
	}
   
}
