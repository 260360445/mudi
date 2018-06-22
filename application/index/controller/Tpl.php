<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Tpl as _Tpl;

abstract class Tpl  extends Root
{
    public $type;
    public $Obj;
    public function _initialize() {
        parent :: _initialize();
        $this->Obj = new _Tpl($this->type);
        $this->assign('name', $this->Obj->tname());
    }

    public function wlist () {
        $this->assign('list', $this->Obj->wlist());
        return $this->fetch('tpl/wlist');
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
        $e = $this->Obj->add($title);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function edit ($id, $title, $sn = '') {
        $e = $this->Obj->edit($id, $title, $sn);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function del ($id) {
        $this->res = $this->Obj->del($id);
    }

}
