<?php
namespace app\index\controller;

use app\index\model\Auth as _Auth;
use app\index\model\Role as _Role;
use think\Cache;

class Role extends Root {

    public function wlist () {
        $this->assign('node_list', _Auth::wlist());
        $this->assign('list', _Role::wlist());
        return $this->fetch();
    }

    // role_id
    public function get_auth ($id) {
        return  _Auth::auth_push_in_cache($id);
    }

    public function edit ($id, $title, $sn = '', $discount, $auth) {
        $e = _Role::edit($id, $title, $sn, $discount, $auth);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function add ($title, $discount) {
        $e = _Role::add($title, $discount);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

}
