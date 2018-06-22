<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Staff as _Staff;
use app\index\model\Auth as _Auth;

class P  extends Root
{
    public function _initialize()
    {
        header("Content-type: text/html; charset=utf-8");
        header("Access-Control-Allow-Origin:*");
    }
    // 员工登陆
    public function staff_login ($account, $pwd)
    {
        $this->res =  _Staff::login($account, $pwd);
    }

    public function init () {

    }
}
