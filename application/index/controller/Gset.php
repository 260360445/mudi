<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\Gset as _Gset;
use app\index\model\Glist as _Glist;
use app\index\model\Role as _Role;
use app\index\model\Syslx as _Syslx;
use app\index\model\Tpl as _Tpl;
use think\Request;
class Gset  extends Root {
	//物品设置
    public function gset () {
    	$this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
     public function gset_edit () {
        $e = _Gset::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function gset_add () {
        $e = _Gset::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function gset_del ($id) {
        return _Gset::del($id);
    }


    //物品销售
    public function glist () {
    	$this->assign('glist', _Gset::wlist());
        $this->assign('role', _Role::wlist());
        return $this->fetch();
    }
    public function glist_add () {
        $e = _Glist::add($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
    public function glist_del ($id) {
        return _Gset::del($id);
    }
    //骨灰盒销售
    public function hlist () {
        $this->assign('sysyst', _Tpl::wlists());
    	$this->assign('sysls', _Syslx::wlist());
        $this->assign('role', _Role::wlist());
        return $this->fetch();
    }
    public function gset_set_hlist () {
        $e = _Gset::gset_set_hlist($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
    public function hlist_del ($id) {
        return _Systemc::del($id);
    }
  
}
