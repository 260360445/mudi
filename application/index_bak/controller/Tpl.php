<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Tpl as _Tpl;

abstract class Tpl  extends Root
{
    public $type;
    public $Obj;
    public function _initialize() {
        $this->Obj = new _Tpl($this->type);
    }

    public function wlist () {
        $this->res['list'] = $this->Obj->wlist();
        $this->r1();
    }

    public function id2tit () {
        $this->res['list'] = $this->Obj->id2tit();
        $this->r1();
    }

    public function id8tit () {
        $this->res['list'] = $this->Obj->id8tit();
        $this->r1();
    }

    public function add ($title, $order = 0) {
        $this->res = $this->Obj->add($title, $order);
    }

    public function edit ($id, $title, $order = null) {
        $this->res = $this->Obj->edit($id, $title, $order);
    }

    public function del ($id) {
        $this->res = $this->Obj->del($id);
    }

}
