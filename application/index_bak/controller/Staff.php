<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\AdvMd;
use app\index\model\CouponMd;

class Staff  extends Root {

    public function _initialize() {

        parent::_initialize();
        if (!session('id')) {
            $this->redirect('P/Login');
            exit;
        }

        $this->DB = db();
    }

}
