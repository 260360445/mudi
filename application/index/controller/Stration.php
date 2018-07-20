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
use app\index\model\Cem as _Cem;
use app\index\model\CemInfo as _Info;
use think\Request;
use think\Db;
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
        $this->assign('row_staff', _Staff::wlistf());
        $this->assign('cem_list', _Cem::wlist());
        $this->assign('sysyst', _Tpl::wlists());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = ['a.status'=>44,'a.sta'=>3];
        if ($cem_id['cem_id']) {
            $map['a.cem_id'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['a.cem_area_id'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['a.cem_row_id'] = $cem_row_id['cem_row_id'];
        }
        $this->assign('list', _Info::wlistt($map));
        return $this->fetch();
    }
    //墓位定购发票统计
    public function invoice () {
        return $this->fetch();
    }
    //墓位杂费单据管理
    public function fee () {
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //杂费信息 --有查询
    public function select_show_one(){
        return _Info::select_show_one($_POST);
    }
    //杂费信息 --全部
    public function select_show_zf_all(){
        return _Info::select_show_zf_all();
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
        $this->assign('row_staff', _Staff::wlistf());
        $this->assign('cem_list', _Cem::wlist());
        $this->assign('sysyst', _Tpl::wlists());
        $this->assign('cem_model', _Tpl::tlist(8));//墓位类型
        $this->assign('cem_status', _Tpl::tlist(9));//墓位状态
        $this->assign('cem_sty', _Tpl::tlist(2));//墓位样式
        $this->assign('cem_mat', _Tpl::tlist(3));//墓位材料
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = ['status'=>44,'sta'=>3];
        if ($cem_id['cem_id']) {
            $map['cem_id'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['cem_area_id'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['cem_row_id'] = $cem_row_id['cem_row_id'];
        }
        $count=count(_Info::wlist($map));
        $this->assign('count', $count);
        $this->assign('list', _Info::wlist($map));
        return $this->fetch();
    }
    //修改业务员信息
    public function user_set(){
        return _Info::user_set($_POST);
    }
    public function set_subuser(){
        $e = _Info::set_subuser($_POST);
        if ($e['status']) {
            return 'ok';
        }
        return 'no';
    }
    //墓位销售锁定管理
    public function lock () {
        $map = ['suo'=>2];
        $this->assign('row_staff', _Staff::wlistf());
        $this->assign('cem_model', _Tpl::tlist(8));//墓位类型
        $this->assign('cem_sty', _Tpl::tlist(2));//墓位样式
        $this->assign('cem_mat', _Tpl::tlist(3));//墓位材料
        $this->assign('list', _Info::wlist($map));
        return $this->fetch();
    }
    public function upd_lock_list(){
        if (Db::table('cem_info')->where('id', $_POST['id'])->update(['suo'=>3,'suo_staff_id'=>session('id'),'suo_time'=>time()]) !== false) {
            return 'ok';
        }
        return 'no';
    }
    //墓位订购时间格式
    public function format(){
         $this->assign('row_staff', _Staff::wlistf());
        $this->assign('cem_list', _Cem::wlist());
        $this->assign('sysyst', _Tpl::wlists());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = ['a.status'=>44,'a.sta'=>3,'a.pay_status'];
        if ($cem_id['cem_id']) {
            $map['a.cem_id'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['a.cem_area_id'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['a.cem_row_id'] = $cem_row_id['cem_row_id'];
        }
        $count=count(_Info::wlistt($map));
        $this->assign('count', $count);
        $this->assign('list', _Info::wlistt($map));
        return $this->fetch();
    }
    
}
