<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\Gset as _Gset;
use app\index\model\Glist as _Glist;
use app\index\model\Role as _Role;
use app\index\model\Tpl as _Tpl;
use app\index\model\System as _System;
use app\index\model\Systemt as _Systemt;
use app\index\model\Systemc as _Systemc;
use app\index\model\Deposit as _Deposit;
use app\index\model\CemInfo as _Info;
use app\index\model\Cem as _Cem;
use think\Request;
class Finan  extends Root {
	//墓位预订收费确认
    public function muwei () {
        $this->assign('role', _Role::wlist());
        $this->assign('cem_list', _Cem::wlist());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = ['status'=>39,'sta'=>3];
        if ($cem_id['cem_id']) {
            $map['cem_id'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['cem_area_id'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['cem_row_id'] = $cem_row_id['cem_row_id'];
        }
        $this->assign('list', _Info::wlist($map));
        return $this->fetch();
    }
    public function finan_set_muwei(){
        $e = _Info::finan_set_muwei($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
    public function finan_set_muweit(){
        $e = _Info::finan_set_muweit($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
    //墓位预订退订确认
    public function muweit () {
        $this->assign('role', _Role::wlist());
        $this->assign('cem_list', _Cem::wlist());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = ['status'=>39,'sta'=>2];
        if ($cem_id['cem_id']) {
            $map['cem_id'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['cem_area_id'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['cem_row_id'] = $cem_row_id['cem_row_id'];
        }
        $this->assign('list', _Info::wlist($map));
        return $this->fetch();
    }
    //墓位定购收费确认
    public function muweis () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //墓位定购退购确认
    public function muweist () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //碑文杂费收费确认
    public function muweiz () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }

    //寄存位收费确认
    public function syslist () {
        $time=time();
        $this->assign('ltime',$time);
        $this->assign('sys_list', _System::wlist());
        $this->assign('sys_list_s', _Systemt::wlist());
        $this->assign('sysjcc', _Systemc::wlist());
        $this->assign('role', _Role::id2sm());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $sysysid = $request->only(['sysysid']);
        $map = [];
        if ($cem_id['cem_id']) {
            $map['sysid'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['sysid_s'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['sysid_c'] = $cem_row_id['cem_row_id'];
        }
    	$this->assign('list', _Deposit::wlist_hlist($map));
        return $this->fetch();
    }
    //寄存位收费确认
    public function finan_set_syslist () {
        $e = _Deposit::finan_set_syslist($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
    //物品销售
    public function glist () {
    	$this->assign('glist', _Glist::wlist());
        $this->assign('role', _Role::id2sm());
        return $this->fetch();
    }
    //物品销售确认 
    public function finan_set_glist () {
        $e = _Glist::set($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }

    //骨灰盒销售
    public function hlist () {
    	$this->assign('hlist', _Gset::wlist_hlist());
        $this->assign('sysyst', _Tpl::wlists());
        $this->assign('row_role', _Role::wlist());
        return $this->fetch();
    }
    //骨灰盒销售确认 
    public function finan_set_hlist () {
        $e = _Gset::finan_set_hlist($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }
     public function hlist_edit () {
        $e = _Systemc::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function hlist_add () {
        $e = _Systemc::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function hlist_del ($id) {
        return _Systemc::del($id);
    }

}
