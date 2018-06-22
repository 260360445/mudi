<?php
namespace app\index\controller;

use app\index\controller\Root;

class Index  extends Root {

    public function index () {
        return $this->fetch();
    }

    public function okz () {
        return $this->fetch();
    }

}
