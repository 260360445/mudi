<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Staff as _Staff;
use app\index\model\Role as _Role;

class Staff  extends Root {

    public function wlist () {
        $this->assign('role_list', _Role::id2sm());
        $this->assign('user_list', _Staff::wlist());
        $this->assign('_status', _Staff::$_status);
        return $this->fetch();
    }

    public function edit () {
        $e = _Staff::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function add () {
        $e = _Staff::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function del ($id) {
        return _Staff::del($id);
    }

    public function set_status ($id, $val) {
        return _Staff::set_status($id, $val);
    }

}
