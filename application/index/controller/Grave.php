<?php
namespace app\index\controller;
use app\index\model\Auth as _Auth;
use app\index\model\Grave as _Grave;
use app\index\model\Role as _Role;
use app\index\model\Tpl as _Tpl;
use think\Request;
class Grave extends Root {
    
    //墓位祭扫、安葬登记
    public function grave () {
       
        $this->assign('role', _Role::wlist());
        $this->assign('tlist', _Tpl::tlist(10));
        /*$this->assign('sysjcc', _Systemc::wlist());
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
        $this->assign('sysjcw', _Sysjcw::wlist($map));*/
        return $this->fetch();
    }
    public function grave_add(){
        $e = _Grave::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    //墓位祭扫、安葬信息管理
    public function glist () {
        $this->assign('list', _Grave::wlist());
        $this->assign('tlist', _Tpl::tlist(10));
        $this->assign('role', _Role::wlist());
        return $this->fetch();
    }
}
