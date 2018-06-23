<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Otm;
use think\Cache;
use think\Db;

class Deposit extends Root {

    protected $table = 'dep_sell';


    static public function wlist () {
        return self::select();
    }


    static public function id2sm () {
        return self::column('id, title, discount, sn', 'id');
    }

    static public function dep_sell_set ($info) {
        if (!(int)$info['eid']) {
            return ['status' => false, 'msg' => '系统错误，请从新设置'];
        }
        if(!preg_match("/^\+?[1-9][0-9]*$/",$info['jcm'])){
            return ['status' => false, 'msg' => '寄存位费填写错误'];
        }
        if(!preg_match("/^\+?[1-9][0-9]*$/",$info['glmo'])){
            return ['status' => false, 'msg' => '管理费填写错误'];
        }
        if(!preg_match("/^\+?[1-9][0-9]*$/",$info['glmt'])){
            return ['status' => false, 'msg' => '年限填写错误'];
        }
        $info['time']=time();
        $info['sys_mw_id']=$info['eid'];
        $info['settime']=strtotime($info['settime']);
        $info['starttime']=strtotime($info['starttime']);
        $info['endtime']=strtotime($info['endtime']);
        $info['summoney']=$info['jcm']+$info['glmo']*$info['glmt'];
        $info['sta']=2;
        $user = self::table('sys_mw')->where(['id'=>$info['eid'])->field('sta')->find();
        if($user['sta'] == 3){
            Db::startTrans();
            try{
                Db::table('dep_sell')->insert($info);
                Db::table('sys_mw')->where(['id'=>$info['eid']])->update(['syszt'=>2]);
                // 提交事务
                Db::commit();
                return RE_SUCCESS;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return RE_ERROR;
            }
        }else if($user['sta'] == 2){
            return ['status' => false, 'msg' => '该位置已预订'];
        }
    }
}
