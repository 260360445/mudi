<?php
namespace app\index\controller;

use think\Controller;
use think\Cache;
// use think\Request;

// index 总控 c
 class Root  extends Controller
 {
    public $res = [];    // 返回的变量
    public $DB;
    public $passport;   //  凭证
    public $staff = []; //  员工信息

    public function _initialize()
    {
        header("Content-type: text/html; charset=utf-8");
        header("Access-Control-Allow-Origin:*");
        $this->res['passport_check'] = true;
        $this->check_passport();
    }

    public function check_passport ()
    {
        $this->passport = input('post.passport');
        if (empty($this->passport)) {
            $this->passport_false();
        }

        if (strlen($this->passport) !== 96) {
            $this->passport_false();
        }

        if (!$this->staff = Cache::get($this->passport)) {
            $this->passport_false();
        }
    }

    public function passport_false ()
    {
        $this->res['passport_check'] = false;
        $this->r0('请重新登陆');
    }

    public function r0 ($msg = null)
    {
        $msg && $this->res['msg'] = $msg;
        $this->res['status'] = false;
        exit;
    }

    public function r1 ($msg = null)
    {
        $msg && $this->res['msg'] = $msg;
        $this->res['status'] = true;
        exit;
    }

    public function msg ($str) {
        $this->res['msg'] = $str;
    }

    public function k2v ($k, $v)
    {
        $this->res[$k] = $v;
    }

    public function __destruct ()
    {
        echo json_encode($this->res);
    }
}
