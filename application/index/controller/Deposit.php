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
use app\index\model\Role as _Role;
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
    public function deposit_set_sell ($id) {
        return  _Sysjcw::deposit_set_sell($id);
    }
    public function deposit_set_sell_l ($id) {
        return  _Sysjcw::deposit_set_sell_y($id);
    }
    public function deposit_set_wh_sell ($id) {
        return  _Deposit::deposit_set_wh_sell($id);
    }
    public function deposit_set_wh_sell_l ($id) {
        return _Deposit::deposit_set_wh_sell_l($id);
    }
    public function dep_wh () {
        $this->assign('sys_list', _System::wlist());
        $this->assign('sys_list_s', _Systemt::wlist());
        $this->assign('sysjcc', _Systemc::wlist());
        $this->assign('sysys', _Systems::wlist());
        $this->assign('sysls', _Syslx::wlist());
        $this->assign('sysjcw', _Sysjcw::wlisty());
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
        $this->assign('deplist', _Deposit::wlisty($map));
        return $this->fetch();
    }
    public function dep_wh_del(){
        return _Deposit::dep_wh_del($_POST);
    }
    public function dep_tx () {
        $this->assign('row_role', _Role::id2sm());
        $time=time();
        $this->assign('ltime', $time);
        $request = Request::instance();
        $gtime = $request->only(['gtime']);
        $today = $request->only(['today']);
        $map = '';
         //本周
        $time = time();
        $w_day=date("w",$time);
        if($w_day=='1'){
            $cflag = '+0';
            $lflag = '-1';
        }else{
            $cflag = '-1';
            $lflag = '-2';
        }
        $weekstar = strtotime(date('Y-m-d',strtotime("$cflag week Monday", $time))); //本周一零点的时间戳
        $weekend = strtotime(date('Y-m-d',strtotime("$cflag week Monday", $time)))+604799;//本周末零点的时间戳
        //本月
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //三个月之内
        $now = time();
        $time = strtotime('-2 month', $now);
        $beginThismonth=mktime(0,0,0,date('m',$time),1,date('Y',$time));
        $endThismonth=mktime(0,0,0,date('m'),date('t',$now),date('t', $now), date('Y', $now));
        if ($gtime['gtime'] && $today['today']) {
            $t = time()+3600*8;//这里和标准时间相差8小时需要补足
            $tget = $t+3600*24*$today['today'];//比如5天前的时间
            if($gtime['gtime']==2){//一周内过期
                $map="endtime >='{$tget}' and endtime<='{$weekend}'";
            }else if($gtime['gtime']==3){//一个月内过期
                $map="endtime >='{$tget}' and endtime<='{$endThismonth}'";
            }else if($gtime['gtime']==4){//一个季度内过期
                $map="endtime >='{$tget}' and endtime<='{$endThismonth}'";
            }else if($gtime['gtime']==5){//已过期
                $map="endtime> '{$now}'";
            }
        }else if($gtime['gtime'] && !$today['today']){
            if($gtime['gtime']==2){//一周内过期
                $map="endtime >='{$weekstar}' and endtime<='{$weekend}'";
            }else if($gtime['gtime']==3){//一个月内过期
                $map="endtime >='{$beginThismonth}' and endtime<='{$endThismonth}'";
            }else if($gtime['gtime']==4){//一个季度内过期
                $map="endtime >='{$beginThismonth}' and endtime<='{$endThismonth}'";
            }else if($gtime['gtime']==5){//已过期
                $map="endtime > '{$now}'";
            }
        }
        $this->assign('list', _Deposit::wlist($map));
        return $this->fetch();
    }

    public function edit ($id, $title, $sn = '', $discount, $auth) {
        $e = _Role::edit($id, $title, $sn, $discount, $auth);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function dep_sell_add () {
        $e = _Deposit::dep_sell_set($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function dep_sell_wh_set(){
        $e = _Deposit::dep_sell_wh_set($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
}
