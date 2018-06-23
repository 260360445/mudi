<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Otm;
use think\Cache;
use think\Db;

class Deposit extends Root {

    protected $table = 'dep_sell';


    static public function wlisty ($map) {
        return self::field('id,sys_mw_id,long_title')->where($map)->order('id', 'desc')->column('*', 'id');
    }


   static public function deposit_set_wh_sell ($id) {
        $arr=self::field('id,long_title,jcm,summoney,sumgl,sta,settime,starttime,endtime,uname,ucode,mobile')->where(['id'=>$id['id']])->find();
        if($arr){
            $html='';
                $html.='<div class="jwhtan">';
                $html.='<div class="jwhtana">';
                    $html.='<form>';
                        $html.='<fieldset>';
                            $html.='<legend>寄存位信息</legend>';
                            $html.='<div class="jwhtanb">';
                                $html.='<p>您选择的是：'.$arr['long_title'].'</p>';
                            $html.='</div>  ';                        
                        $html.='</fieldset>';
                    $html.='</form>';
               $html.=' </div>';
                $html.='<div class="jwhtanc">';
                   $html.=' <form>';
                        $html.='<fieldset>';
                           $html.=' <legend>寄存位定购信息</legend>';
                            $html.='<div class="jwhtanca">';
                                $html.='<div class="jwhtancb">';
                                    $html.='<div>寄存位费：'.$arr['jcm'].'元</div>';
                                    $html.='<div>应付（已付）管理费总额：'.$arr['sumgl'].'元</div>';
                                    $html.='<div>应付（已付）款总额：'.$arr['summoney'].'元</div>';
                                    if($arr['sta'] == '3'){//
                                        $html.='<div>是否已交费：未付款</div>';
                                    }else if($arr['sta'] == '2'){//
                                        $html.='<div>是否已交费：已付款</div>';
                                    }
                                    $html.='<div>使用开始日期：'.date('Y-m-d',$arr['starttime']).'</div>   ';  
                                $html.='</div>';
                                $html.='<div class="jwhtancc">';
                                    $html.='<div>联系人：'.$arr['uname'].'</div>';
                                    $html.='<div>身份证：'.$arr['ucode'].'</div>';
                                    $html.='<div>联系电话：'.$arr['mobile'].'</div>';
                                    $html.='<div>定购日期：'.date('Y-m-d',$arr['settime']).'</div>';
                                    $html.='<div>使用结束日期：'.date('Y-m-d',$arr['endtime']).'</div> ';    
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="jwhtand">';
                    $html.='<div class="jwhtanda">';
                        $html.='<div onclick="lzdj()">故者落葬登记</div>';
                        $html.='<div>续交管理费</div>';
                        $html.='<div>退定</div>';
                    $html.='</div>';
                    $html.='<div class="jwhtandb">';
                        $html.='<div>打印寄存位定购合同</div>';
                        $html.='<div>打印寄存位证</div>';
                        $html.='<div>取消本次操作</div>';
                   $html.=' </div>';
                $html.='</div>';
            $html.='</div>';
        }else{
            $html='no';
        }
       return $html;
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
        $user = self::table('sys_mw')->where(['id'=>$info['eid']])->field('syszt')->find();
        if($user['syszt'] == 1){
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
        }else if($user['syszt'] == 2){
            return ['status' => false, 'msg' => '该位置已预订'];
        }
    }
}
