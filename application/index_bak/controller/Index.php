<?php
namespace app\index\controller;

use app\index\controller\Root;

class Index  extends Root {

    public function index () {
        // $this->res['staff'] = $this->staff;
    }

    public function okz () {
        return $this->fetch();
    }

}
