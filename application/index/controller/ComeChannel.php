<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\ComeChannel as _Channel;

class ComeChannel  extends Root {

    public function _initialize() {
        parent::_initialize();
        $this->assign('t1', _Channel::t1());
        $this->assign('t2', _Channel::t2());
        $this->assign('t3', _Channel::t3());
    }

    public function t1 () {
        return $this->fetch();
    }

    public function t2 () {
        error_reporting(0);
        return $this->fetch();
    }

    public function t3 () {
        error_reporting(0);
        return $this->fetch();
    }


    public function tlist ($pid = 0, $ppid = 0) {
        $map = ['ppid' => 0];
        $pid &&  $map['pid'] = $pid;
        $ppid &&  $map['ppid'] = $ppid;
        return _Channel::wlist($map);
    }

    public function edit () {
        $e = _Channel::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function add () {
        // wcc($_POST);
        $e = _Channel::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function del ($id) {
        return _Channel::del($id);
    }

    public function set_status ($id, $val) {
        return _Channel::set_status($id, $val);
    }

}
