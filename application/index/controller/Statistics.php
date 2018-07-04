<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\Gset as _Gset;
use app\index\model\Glist as _Glist;
use app\index\model\Staff as _Staff;
use app\index\model\Syslx as _Syslx;
use app\index\model\Tpl as _Tpl;
use think\Request;
class Statistics  extends Root {
    //物品销售
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
}
