<?php
namespace app\index\model;

use think\Model;

abstract class Root extends Model {

    //自定义初始化
    protected function initialize() {

    }

    public function tpl_return_false () {
        return ['status' => false, 'msg' => DOERROR];
    }

    public function tpl_return_true () {
        return ['status' => true, 'msg' => DOSUCCESS];
    }
}
