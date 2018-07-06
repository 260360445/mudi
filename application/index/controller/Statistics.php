<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\Gset as _Gset;
use app\index\model\Glist as _Glist;
use app\index\model\Staff as _Staff;
use app\index\model\Syslx as _Syslx;
use app\index\model\Tpl as _Tpl;
use app\index\model\Cem as _Cem;
use app\index\model\CemInfo as _Info;
use think\Request;
class Statistics  extends Root {
    //物品销售统计
    public function glist () {
        $this->assign('gset', _Gset::wlist());
        $this->assign('row_staff', _Staff::wlistf());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $starttime = $request->only(['starttime']);
        $endtime = $request->only(['endtime']);
        $map = '';
        if ($cem_id['cem_id'] && $starttime['starttime'] && $endtime['endtime']) {
            $map= 'gsetid = '.$cem_id["cem_id"].' and time >= '.strtotime($starttime["starttime"]).' and time < '.strtotime($endtime["endtime"]);
        }else if ($cem_id['cem_id'] && $starttime['starttime'] && !$endtime['endtime']) {
            $map= 'gsetid = '.$cem_id["cem_id"].' and time >= '.strtotime($starttime["starttime"]);
        }else if ($cem_id['cem_id'] && !$starttime['starttime'] && $endtime['endtime']) {
            $map= 'gsetid = '.$cem_id["cem_id"].' and time < '.strtotime($endtime["endtime"]);
        }else if ($cem_id['cem_id'] && !$starttime['starttime'] && !$endtime['endtime']) {
            $map= 'gsetid = '.$cem_id["cem_id"];
        }
        $this->assign('row_cem_id', $cem_id['cem_id']);
    	$this->assign('glist', _Glist::wlistf($map));
        return $this->fetch();
    }
    //墓位状态统计
    public function mwsta(){
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //查询墓位状态数量
    public function select_cem(){
        $data = _Info::select_cem($_POST);
        return $data;
    }
    //查询墓位状态总数量
    public function select_show_all(){
        $data = _Info::select_show_all($_POST);
        return $data;
    }
    //墓位销售情况统计
    public function mwcount(){
        $this->assign('cem_list', _Cem::wlist()); 
        return $this->fetch();
    }
    //墓位销售情况统计
    public function select_cem_list(){
        $data = _Info::select_cem_list($_POST);
        return $data;
    }
    //墓位销售情况统计--总计
    public function select_cem_list_all(){
        $data = _Info::select_cem_list_all($_POST);
        return $data;
    }
    public function select_cem_list_all_time(){
        $data = _Info::select_cem_list_all_time($_POST);
        return $data;
    }
    //墓位预订情况统计
    public function mwyu(){
        $this->assign('cem_list', _Cem::wlist()); 
        return $this->fetch();
    }
    //墓位预订情况统计--单个
    public function select_cem_yu_list(){
        $data = _Info::select_cem_yu_list($_POST);
        return $data;
    }
    //墓位预订情况统计--全部 没有时间
    public function select_cem_yu_list_all(){
        $data = _Info::select_cem_yu_list_all($_POST);
        return $data;
    }
    //墓位预订情况统计--全部 有时间
    public function select_cem_yu_list_all_time(){
        $data = _Info::select_cem_yu_list_all_time($_POST);
        return $data;
    }
    //墓位销售员业绩统计
    public function user(){
        $this->assign('row_staff', _Staff::wlistf()); 
        return $this->fetch();
    }
    //墓位销售员业绩统计-个人
    public function select_user_list(){
        $data = _Info::select_user_list($_POST);
        return $data;
    }
    //墓位销售员业绩统计-全部  没有时间
    public function select_user_list_all(){
        $data = _Info::select_user_list_all($_POST);
        return $data;
    }
}
