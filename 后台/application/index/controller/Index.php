<?php

namespace app\index\controller;



class Index

{

    public function index()

    {

        return '<h1 style="width:100%; height:500px; line-height:500px; font-size:60px; font-weight:100; color:#eee; text-align:center;">小视频获客小程序工具</h1>';

    }
    public function jiaocheng(){
    	return view();
    }
}

