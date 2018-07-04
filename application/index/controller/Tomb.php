<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Tpl as _Tpl;
use app\index\model\ComeChannel as _Channel;
use app\index\model\Contacts as _Contacts;
use app\index\model\Dead as _Dead;
use app\index\model\Staff as _Staff;
use app\index\model\Visit as _Visit;
use app\index\model\Cem as _Cem;
use app\index\model\CemInfo as _Info;
use think\Db;
class Tomb  extends Root {

    public function _initialize() {
        parent::_initialize();
        $this->assign('t1', _Channel::t1());
        $this->assign('t2', _Channel::t2());
        $this->assign('t3', _Channel::t3());
        $this->assign('cem_list', _Cem::wlist());
        $Tpl = new _Tpl(2);
        $this->assign('cem_style', $Tpl->tlist(2));
        $this->assign('cem_material', $Tpl->tlist(3));
        $this->assign('relationship', $Tpl->tlist(4));
        $this->assign('cem_status', $Tpl->tlist(9));
        $this->assign('come_num', $Tpl->tlist(13));
        $this->assign('come_fun', $Tpl->tlist(5));
        $this->assign('no_transaction_ps', $Tpl->tlist(6));
        $this->assign('staff', _Staff::id2tit());
    }

    public function www_list ($wh = '') {
        $map = [];
        if ($wh) {

            $map['name']         =  ['like', '%' .$wh. '%'];
            $map['email']        =  ['like', '%' .$wh. '%'];
            $map['address']      =  ['like', '%' .$wh. '%'];
            $map['workplace']    =  ['like', '%' .$wh. '%'];
            // $map['_logic'] = 'or';
            $this->assign('list', _Contacts::wlist($map));
        } else {
            $this->assign('list', _Contacts::plist($map));
        }
        $this->assign('wh', $wh);
        $this->assign('count', _Contacts::cnt($map));


    }

    public function sale ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function sale_info ($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function reserve () {
        $data = _Info::reserve($_POST);
        return $data;
    }
    public function reserve_add(){//预订墓位
        
        // 判断重复
        $user=Db::table('contacts')->field('id')->where(['name'=>$_POST['contacts_name'],'tel'=>$_POST['contacts_tel']])->find();
        //print_r($user);exit;
        if($user){
            Db::startTrans();
            try{
                Db::table('contacts')->where(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]); 
                $data['status']  = 39;
                $data['reserve_date']=strtotime($_POST['reserve_date']);
                $data['remind_date']=strtotime($_POST['remind_date']);
                $data['reserve_money']=$_POST['reserve_money'];
                $data['unpaid_money']=$_POST['unpaid_money'];
                $data['money']=$_POST['money'];
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id']=$user['id'];
                $data['beizhu']=$_POST['beizhu'];
                $data['mwnum']=$_POST['seid'];
                $data['lnum']=date('YmdHis',time());
                $data['hnum']='TQ'.date('YmdHis',time());
                $ss=Db::table('cem_info')->where(['id'=>$_POST['seid']])->update($data);
                $dead['cem_info_id'] = $_POST['seid'];
                $dead['relationship'] = $_POST['dead_relationship'];
                $dead['dead_name'] = $_POST['dead_name'];
                Db::table('dead')->insert($dead);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }else{
            Db::startTrans();
            try{
                Db::table('contacts')->insert(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]);
                $LastInsID =Db::table('contacts')->getLastInsID();
                Db::table('visit_log')->insert(['contacts_id'=>$LastInsID,'transaction_status'=>1,'transaction_suc_date'=>time(),'receiver'=>$_POST['salesman']]);
                $data['status']  = 39;
                $data['reserve_date']=strtotime($_POST['reserve_date']);
                $data['remind_date']=strtotime($_POST['remind_date']);
                $data['reserve_money']=$_POST['reserve_money'];
                $data['unpaid_money']=$_POST['unpaid_money'];
                $data['money']=$_POST['money'];
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['beizhu']=$_POST['beizhu'];
                $data['mwnum']=$_POST['seid'];
                $data['lnum']=date('YmdHis',time());
                $data['hnum']='TQ'.date('YmdHis',time());
                $data['contacts_id'] = $LastInsID;
                _Info::where('id', $_POST['seid'])->update($data);
                $dead['cem_info_id'] = $_POST['seid'];
                $dead['dead_name'] = $_POST['dead_name'];
                $dead['relationship'] = $_POST['dead_relationship'];
                _Dead::insert($dead);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }
    }
    public function reserve_dg_adds(){//结清尾款
         // 判断重复
        $user=Db::table('contacts')->field('id')->where(['name'=>$_POST['contacts_name'],'tel'=>$_POST['contacts_tel']])->find();
       
        if($user){
            Db::startTrans();
            try{
                $sss=Db::table('contacts')->where(['id'=>$user['id']])->update(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]); 
                $data['status']  = 44;
                $data['settime']=strtotime($_POST['settime']);
                $data['starttime']=strtotime($_POST['starttime']);
                $data['endtime']=strtotime($_POST['endtime']);
                $data['manage_money']=$_POST['manage_money'];
                $data['manage_year']=$_POST['manage_year'];
                $data['pay_status']=1;
                $data['salesman']=$_POST['salesman'];
                $data['beizhu']=$_POST['beizhu'];
                $data['pay_sum_money']=$_POST['yuee']+$_POST['manage_money']*$_POST['manage_year'];
                $data['manage_sum_money']=$_POST['manage_money']*$_POST['manage_year'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id']=$user['id'];
                $ss=Db::table('cem_info')->where(['id'=>$_POST['seid']])->update($data);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }else{
            Db::startTrans();
            try{
                Db::table('contacts')->insert(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]);
                $LastInsID =Db::table('contacts')->getLastInsID();
                Db::table('visit_log')->insert(['contacts_id'=>$LastInsID,'transaction_status'=>1,'transaction_suc_date'=>time(),'receiver'=>$_POST['salesman']]);
                $data['status']  = 44;
                $data['settime']=strtotime($_POST['settime']);
                $data['starttime']=strtotime($_POST['starttime']);
                $data['endtime']=strtotime($_POST['endtime']);
                $data['pay_status']=1;
                $data['manage_money']=$_POST['manage_money'];
                $data['manage_year']=$_POST['manage_year'];
                $data['pay_sum_money']=$_POST['yuee']+$_POST['manage_money']*$_POST['manage_year'];
                $data['manage_sum_money']=$_POST['manage_money']*$_POST['manage_year'];
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id'] = $LastInsID;
                _Info::where('id', $_POST['seid'])->update($data);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }
    }
    public function reserve_dg_add(){//墓位直接定够
         // 判断重复
        $user=Db::table('contacts')->field('id')->where(['name'=>$_POST['contacts_name'],'tel'=>$_POST['contacts_tel']])->find();
       
        if($user){
            Db::startTrans();
            try{
                $sss=Db::table('contacts')->where(['id'=>$user['id']])->update(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]); 
                $data['status']  = 44;
                $data['settime']=strtotime($_POST['settime']);
                $data['starttime']=strtotime($_POST['starttime']);
                $data['endtime']=strtotime($_POST['endtime']);
                $data['money']=$_POST['mw_price'];
                $data['manage_money']=$_POST['manage_money'];
                $data['manage_year']=$_POST['manage_year'];
                $data['pay_status']=1;
                $data['mwnum']=$_POST['seid'];
                $data['lnum']=date('YmdHis',time());
                $data['hnum']='TQ'.date('YmdHis',time());
                $data['salesman']=$_POST['salesman'];
                $data['beizhu']=$_POST['beizhu'];
                $data['pay_sum_money']=$_POST['mw_price']+$_POST['manage_money']*$_POST['manage_year'];
                $data['manage_sum_money']=$_POST['manage_money']*$_POST['manage_year'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id']=$user['id'];
                $ss=Db::table('cem_info')->where(['id'=>$_POST['seid']])->update($data);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }else{
            Db::startTrans();
            try{
                Db::table('contacts')->insert(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]);
                $LastInsID =Db::table('contacts')->getLastInsID();
                Db::table('visit_log')->insert(['contacts_id'=>$LastInsID,'transaction_status'=>1,'transaction_suc_date'=>time(),'receiver'=>$_POST['salesman']]);
                $data['status']  = 44;
                $data['settime']=strtotime($_POST['settime']);
                $data['starttime']=strtotime($_POST['starttime']);
                $data['endtime']=strtotime($_POST['endtime']);
                $data['money']=$_POST['mw_price'];
                $data['pay_status']=1;
                $data['mwnum']=$_POST['seid'];
                $data['lnum']=date('YmdHis',time());
                $data['hnum']='TQ'.date('YmdHis',time());
                $data['manage_money']=$_POST['manage_money'];
                $data['manage_year']=$_POST['manage_year'];
                $data['pay_sum_money']=$_POST['mw_price']+$_POST['manage_money']*$_POST['manage_year'];
                $data['manage_sum_money']=$_POST['manage_money']*$_POST['manage_year'];
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id'] = $LastInsID;
                _Info::where('id', $_POST['seid'])->update($data);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }
    }
    public function reserve_ding_add(){//墓位预订维护
        $user=Db::table('contacts')->field('id')->where(['name'=>$_POST['contacts_name'],'tel'=>$_POST['contacts_tel']])->find();
        if($user){
            Db::startTrans();
            try{
                Db::table('contacts')->where(['id'=>$user['id']])->update(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]); 
                $data['status']  = 39;
                $data['reserve_date']=strtotime($_POST['reserve_date']);
                $data['remind_date']=strtotime($_POST['remind_date']);
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['contacts_id']=$user['id'];
                $data['beizhu']=$_POST['beizhu'];
                $ss=Db::table('cem_info')->where(['id'=>$_POST['seid']])->update($data);
                $dead['cem_info_id'] = $_POST['seid'];
                $dead['relationship'] = $_POST['dead_relationship'];
                $dead['dead_name'] = $_POST['dead_name'];
                Db::table('dead')->where(['cem_info_id'=>$_POST['seid']])->update($dead);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }else{
            Db::startTrans();
            try{
                Db::table('contacts')->insert(['name'=>$_POST['contacts_name'],'sex'=>$_POST['contacts_sex'],'relationship'=>$_POST['dead_relationship'],'postcode'=>$_POST['contacts_postcode'],'idcard'=>$_POST['contacts_idcard'],'tel'=>$_POST['contacts_tel'],'phone'=>$_POST['contacts_phone'],'email'=>$_POST['contacts_email'],'address'=>$_POST['contacts_address'],'workplace'=>$_POST['contacts_workplace']]);
                $LastInsID =Db::table('contacts')->getLastInsID();
                Db::table('visit_log')->insert(['contacts_id'=>$LastInsID,'transaction_status'=>1,'transaction_suc_date'=>time(),'receiver'=>$_POST['salesman']]);
                $data['status']  = 39;
                $data['reserve_date']=strtotime($_POST['reserve_date']);
                $data['remind_date']=strtotime($_POST['remind_date']);
                $data['salesman']=$_POST['salesman'];
                $data['update_by']=session('id');
                $data['create_time']=$_POST['create_time'];
                $data['beizhu']=$_POST['beizhu'];
                $data['contacts_id'] = $LastInsID;
                _Info::where('id', $_POST['seid'])->update($data);
                $dead['cem_info_id'] = $_POST['seid'];
                $dead['dead_name'] = $_POST['dead_name'];
                $dead['relationship'] = $_POST['dead_relationship'];
                _Dead::insert($dead);
                // 提交事务
                Db::commit();
                return 'ok';
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return 'no';
            }
        }
    }
    public function set_huanyuan(){
        $e = _Info::set_huanyuan($_POST);
        if ($e['status']) {
            return 'ok';
        }
        return 'no';
    }
    public function set_beizhu(){//设置备注
        $e = _Info::set_beizhu($_POST);
        if ($e['status']) {
            return 'ok';
        }
        return 'no';
    }
    public function tuiding(){//已购墓位 退订
        $e = _Info::tuiding($_POST);
        if ($e['status']) {
            return 'ok';
        }
        return 'no';
    }
    public function reserve_buyed(){//已购墓位 墓位定购信息维护
        return _Info::reserve_buyed($_POST);
    }
    public function reserve_jsdtc(){//碑文计算单计算
        return _Info::reserve_jsdtc($_POST);
    }
    public function select_buy_type_yu(){//墓位预定--杂费
        return _Info::select_buy_type_yu($_POST);
    }
    public function reserve_zjgm(){
        return _Info::reserve_zjgm($_POST);
    }
    public function select_buy_type () {
        $data = _Info::select_buy_type($_POST);
        return $data;
    }
    public function select_buy_ding(){
        return _Info::select_buy_ding($_POST);
    }
    public function select_buy_ding_buy(){
        return _Info::select_buy_ding_buy($_POST);
    }
    public function reserve_zjgm_jie(){
        return _Info::reserve_zjgm_jie($_POST);
    }
    public function sale_sling_words ($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function tending ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    //取消墓位预订
    public function ten_setqx(){
        $e = _Info::ten_setqx($_POST);
        if ($e['status']) {
            return 'ok';
        }
        return 'no';
    }
    public function  tending_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  tending_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }


    public function buyed ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function  buyed_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  buyed_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function used ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function  used_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  used_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }


    public function visit_push () {
        if ($_POST) {
            $e = _Visit::add($_POST);
            if ($e['status']) {
                return $this->success($e['msg']);
            }
            return $this->error($e['msg']);
        }

        return $this->fetch();
    }

    public function visit_log ($wh = '') {
        $map = [];
        if ($wh) {

            $map['b.name']         =  ['like', '%' .$wh. '%'];
            $map['b.email']        =  ['like', '%' .$wh. '%'];
            $map['b.address']      =  ['like', '%' .$wh. '%'];
            $map['b.workplace']    =  ['like', '%' .$wh. '%'];
            // $map['_logic'] = 'or';
            $this->assign('list', _Visit::wlist($map));
        } else {
            $this->assign('list', _Visit::plist($map));
        }
        $this->assign('count', _Visit::cnt($map));
        $this->assign('wh', $wh);
        return $this->fetch();
    }
    public function t1 () {
        return $this->fetch();
    }

    public function t2 () {
        error_reporting(0);
        return $this->fetch();
    }

    public function t3 () {
        error_reporting(0);
        return $this->fetch();
    }

    public function tlist ($pid = 0, $ppid = 0) {
        $map = ['ppid' => 0];
        $pid &&  $map['pid'] = $pid;
        $ppid &&  $map['ppid'] = $ppid;
        return _Channel::wlist($map);
    }

    public function edit () {
        $e = _Channel::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function add () {
        // wcc($_POST);
        $e = _Channel::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function del ($id) {
        return _Channel::del($id);
    }

    public function set_status ($id, $val) {
        return _Channel::set_status($id, $val);
    }

}
