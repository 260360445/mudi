<?php
namespace app\index\controller;

use think\Controller;
use think\Cache;
use app\index\model\Auth as _Auth;
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
        if ($_POST) {
            $_POST['create_time'] = date('Y-m-d H:i:s');
        }
        error_reporting(0);
        $a = new _Auth;
        // $a->aa();
        // db('cem')->where('id', 1)->whereIn('title', '2')->select();
        header("Content-type: text/html; charset=utf-8");
        // header("Access-Control-Allow-Origin:*");
        // $this->res['passport_check'] = true;
        // $this->check_passport();


        if (!session('id')) {
            $this->redirect('P/login');
            exit;
        }

        $this->get_meun();
    }

    public function index () {
        $path  = $this->get_path();
        $_path = _Auth::get_first_son_by_path($path);
        return $this->redirect($_path);
    }

    public function get_meun () {
        $path = $this->get_path();
        $this->assign('path_info', _Auth::path_info($path));

        $this->assign('top_meun', _Auth::get_top_meun());
        $this->assign('left_meun', _Auth::get_left_meun_by_path($path));
    }

    public function get_path () {
        $request= \think\Request::instance();
        $module_name=$request->module();
        $controller_name=$request->controller();
        $action=$request->action();
        return $controller_name.'/'.$action;
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
     /**
     * [upload 图片上传]
     * @return [type] [description]
     */
    public function uploads($fname){
        // 获取表单上传文件
        $file = request()->file($fname);
         //return $file;
        if($file){
            $dir=date("Ymd",time());
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); //保存原图

            $fileName = $dir.'/'.$info->getFilename();
            return $fileName;
        }else{
            return false;
        }
    }
}
