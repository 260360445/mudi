<?php
namespace app\index\controller;
use app\index\model\Auth as _Auth;
use app\index\model\Deposit as _Deposit;
use app\index\model\Role as _Role;
use app\index\model\Tpl as _Tpl;
use app\index\model\ComeChannel as _Channel;
use app\index\model\Contacts as _Contacts;
use app\index\model\Staff as _Staff;
use app\index\model\Visit as _Visit;
use think\Request;
class Stration extends Root {
    public function _initialize() {
        parent::_initialize();
        $this->assign('t1', _Channel::t1());
        $this->assign('t2', _Channel::t2());
        $this->assign('t3', _Channel::t3());

        $Tpl = new _Tpl(4);
        $this->assign('relationship', $Tpl->wlist());
        $this->assign('tel', $Tpl->tlist(14));
        $this->assign('come_num', $Tpl->tlist(13));
        $this->assign('come_fun', $Tpl->tlist(5));
        $this->assign('no_transaction_ps', $Tpl->tlist(6));
        $this->assign('staff', _Staff::id2tit());
    }
    //墓位定购收费确认
    public function muweis () {
        /*$this->assign('sys_list', _System::wlist());
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
        $this->assign('sysjcw', _Sysjcw::wlist($map));*/
        return $this->fetch();
    }
    //墓位定购发票统计
    public function invoice () {
        return $this->fetch();
    }
    //墓位杂费单据管理
    public function fee () {
        return $this->fetch();
    }
    //来访登记管理
    public function visit_log ($wh = '') {
        $map = [];
        if ($wh) {
            $map['b.name']         =  ['like', '%' .$wh. '%'];
            $map['b.email']        =  ['like', '%' .$wh. '%'];
            $map['b.address']      =  ['like', '%' .$wh. '%'];
            $map['b.workplace']    =  ['like', '%' .$wh. '%'];
            $this->assign('list', _Visit::wlist($map));
        } else {
            $this->assign('list', _Visit::plist($map));
        }
        $this->assign('count', _Visit::cnt($map));
        $this->assign('wh', $wh);
        return $this->fetch();
    }
    public function visit_edit(){
        if ($_POST) {
             $e = _Visit::visit_edit($_POST);
            if ($e['status']) {
                return $this->success($e['msg']);
            }
            return $this->error($e['msg']);
        }
    }
    public function set_visit_log($id){
        return  _Visit::set_visit_log($id);
    }
    public function open_visit_log($id){
        return  _Visit::open_visit_log($id);
    }
    //销售员信息修改
    public function user () {
        return $this->fetch();
    }
    //墓位销售锁定管理
    public function lock () {
       
        return $this->fetch();
    }
    //墓位订购时间格式
    public function format(){
        return $this->fetch();
    }
}
