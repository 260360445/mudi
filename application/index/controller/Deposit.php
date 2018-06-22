<?php
namespace app\index\controller;
use app\index\model\Auth as _Auth;
use app\index\model\Deposit as _Deposit;
use app\index\model\System as _System;
use app\index\model\Systemt as _Systemt;
use app\index\model\Systemc as _Systemc;
use app\index\model\Systems as _Systems;
use app\index\model\Syslx as _Syslx;
use app\index\model\Sysjcw as _Sysjcw;
use think\Request;
class Deposit extends Root {

    public function dep_sell () {
        $this->assign('sys_list', _System::wlist());
        $this->assign('sys_list_s', _Systemt::wlist());
        $this->assign('sysjcc', _Systemc::wlist());
        $this->assign('sysys', _Systems::wlist());
        $this->assign('sysls', _Syslx::wlist());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $sysysid = $request->only(['sysysid']);
        $syszt = $request->only(['type']);
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
        if ($sysysid['sysysid']) {
            $map['sysysid'] = $sysysid['sysysid'];
        }
        if ($syszt['syszt']) {
            $map['syszt'] = $syszt['syszt'];
        }
        $this->assign('sysjcw', _Sysjcw::wlist($map));
        return $this->fetch();
    }
    public function sysjcc_wlist ($cem_id) {
        return _Systemt::wlists(['sysid' => $cem_id]);
    }
    public function sysjcw_wlist ($cem_id) {
        return _Systemc::wlists(['sysid_s' => $cem_id]);
    }
    public function dep_wh () {
        $this->assign('sys_list', _System::wlist());
        $this->assign('sys_list_s', _Systemt::wlist());
        $this->assign('sysjcc', _Systemc::wlist());
        $this->assign('sysys', _Systems::wlist());
        $this->assign('sysls', _Syslx::wlist());
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
        if ($sysysid['sysysid']) {
            $map['sysysid'] = $sysysid['sysysid'];
        }
        
        $this->assign('sysjcw', _Sysjcw::wlisty($map));
        return $this->fetch();
    }
    public function dep_tx () {
        //$this->assign('node_list', _Auth::wlist());
        //this->assign('list', _Deposit::wlist());
        return $this->fetch();
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
