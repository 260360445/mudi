<?php
namespace app\index\model;

use think\Model;

abstract class Root extends Model {

    //自定义初始化
    protected function initialize() {

    }

    public function tpl_return_false () {
        return RE_ERROR;
    }

    public function tpl_return_true () {
        return RE_SUCCESS;
    }

}
