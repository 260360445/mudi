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
use think\Db;
use think\Request;
class Statistic  extends Root {
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
    //墓位销售员业绩统计-全部  有时间
    public function select_user_list_all_time(){
        $data = _Info::select_user_list_all_time($_POST);
        return $data;
    }
    //墓位销售员业绩统计-个人  没有时间
    public function select_user_list_tab_one(){
        $data = _Info::select_user_list_tab_one($_POST);
        return $data;
    }
    //墓位销售员业绩统计-个人  有时间
    public function sselect_user_list_tab_one_time(){
        $data = _Info::sselect_user_list_tab_one_time($_POST);
        return $data;
    }
    //墓位销售、剩余情况表
    public function mwsell(){
        $this->assign('cem_list', _Cem::wlist()); 
        return $this->fetch();
    }
    //墓位销售、剩余情况表 统计结果
    public function select_mwsell_list(){
        $data = _Info::select_mwsell_list($_POST);
        return $data;
    }
    //墓位销售、剩余情况表 统计结果
    public function select_mwsell_list_time(){
        $data = _Info::select_mwsell_list_time($_POST);
        return $data;
    }
    //墓位销售、剩余情况表 统计园区总体
    public function show_mwsell_all(){
        $data = _Info::show_mwsell_all($_POST);
        return $data;
    }
    //墓位销售、剩余情况表 统计园区总体
    public function show_mwsell_all_time(){
        $data = _Info::show_mwsell_all_time($_POST);
        return $data;
    }
    //来访及成交情况表
    public function come(){
        return $this->fetch();
    }
    //来访及成交情况表
    public function show_all_come(){
        $data = _Info::show_all_come($_POST);
        return $data;
    }
    //各渠道来访及成交情况表
    public function qudao(){
        $arr=Db::table('come_channel')->where(['pid'=>0])->select();
        $this->assign('list',$arr);
        return $this->fetch();
    }
    //各渠道来访及成交情况表--渠道1
    public function select_area(){
        $arr=Db::table('come_channel')->where(['pid'=>$_POST['cem_id']])->select();
        return $arr;
    }
     //各渠道来访及成交情况表--没有时间
    public function show_qudao_all(){
        $data = _Info::show_qudao_all($_POST);
        return $data;
    }
     //各渠道来访及成交情况表--有时间
    public function show_qudao_all_time(){
        $data = _Info::show_qudao_all_time($_POST);
        return $data;
    }
    //各年龄段销售情况统计
    public function age(){
        return $this->fetch();
    }
    //各年龄段销售情况统计
    public function show_all_age(){
        $data = _Info::show_all_age($_POST);
        return $data;
    }
    //墓位碑文杂费统计
    public function zf(){
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //墓位碑文杂费统计--没有时间
    public function select_zf_list(){
        $data = _Info::select_zf_list($_POST);
        return $data;
    }
    //墓位碑文杂费统计--有时间
    public function select_zf_list_time(){
        $data = _Info::select_zf_list_time($_POST);
        return $data;
    }
    //墓位碑文杂费统计--详情
    public function select_zf_list_all(){
        $data = _Info::select_zf_list_all($_POST);
        return $data;
    }
    //墓位碑文情况统计
    public function bw(){
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //墓位碑文情况统计
    public function select_bw_list(){
        $data = _Info::select_bw_list($_POST);
        return $data;
    }
    //墓位碑文情况统计-有时间
    public function select_bw_list_time(){
        $data = _Info::select_bw_list_time($_POST);
        return $data;
    }
    //墓位碑文情况统计-全部墓园 没有时间
    public function select_bw_all_list(){
        $data = _Info::select_bw_all_list($_POST);
        return $data;
    }
    //墓位碑文情况统计-全部墓园 有时间
    public function select_bw_all_list_time(){
        $data = _Info::select_bw_all_list_time($_POST);
        return $data;
    }
    //墓位碑文情况统计-详细信息
    public function select_bw_list_all(){
        $data = _Info::select_bw_list_all($_POST);
        return $data;
    }
    //各个墓区、排售况分析
    public function sell(){
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //各个墓区、排售况分析 总体情况
    public function show_sell_row_all(){
        $data = _Info::show_sell_row_all($_POST);
        return $data;
    }
    //各个墓区、排售况分析 分开情况
    public function show_sell_row_one(){
        $data = _Info::show_sell_row_one($_POST);
        return $data;
    }
    //墓位祭扫安葬情况统计
    public function jslist(){
        return $this->fetch();
    }
    //墓位祭扫安葬情况统计
    public function select_js_list(){
        $data = _Info::select_js_list($_POST);
        return $data;
    }
    //安葬情况统计表
    public function select_js_list_zang(){
        $data = _Info::select_js_list_zang($_POST);
        return $data;
    }
    //客服代表日销售统计
    public function daily(){
        return $this->fetch();
    }
    //客服代表日销售统计
    public function show_all_daily(){
        $data = _Info::show_all_daily($_POST);
        return $data;
    }
    //客服代表月销售统计
    public function dailm(){
        return $this->fetch();
    }
    //客服代表月销售统计
    public function show_all_dailm(){
        $data = _Info::show_all_dailm($_POST);
        return $data;
    }
    //墓位折扣统计
    public function zlist(){
        $this->assign('cem_list', _Cem::wlist());
        return $this->fetch();
    }
    //墓位折扣统计
    public function select_zlist(){
        $data = _Info::select_zlist($_POST);
        return $data;
    }
    //墓位折扣统计
    public function select_zlist_time(){
        $data = _Info::select_zlist_time($_POST);
        return $data;
    }
    //客服代表月销售情况对比
    public function maisell(){
        return $this->fetch();
    }
}
