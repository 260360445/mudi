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
    static public function wlist ($map) {
        return self::field('id,long_title,settime,starttime,endtime,jcm,glmo,glmt,summoney,uname,gzgx,sex,phone,home,gzdw,roleid,beizhu')->where($map)->where(['syszt'=>2])->order('id', 'desc')->column('*', 'id');
    }
    static public function wlist_hlist($map){
      return self::where($map)->where(['syszt'=>3])->order('id', 'desc')->column('*', 'id');
    }
   static public function deposit_set_wh_sell ($id) {
        $arr=self::field('id,sys_mw_id,long_title,jcm,summoney,sumgl,sta,settime,starttime,endtime,uname,ucode,mobile')->where(['id'=>$id['id']])->find();
        if($arr){
            if($arr['sta'] == '2'){
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
                        $html.='<div onclick="lzdj('.$arr['id'].')">故者落葬登记</div>';
                        $html.='<div>续交管理费</div>';
                        $html.='<div onclick="tuiding('.$arr['id'].','.$arr['sys_mw_id'].')">退定</div>';
                    $html.='</div>';
                    $html.='<div class="jwhtandb">';
                        $html.='<div>打印寄存位定购合同</div>';
                        $html.='<div>打印寄存位证</div>';
                        $html.='<div onclick="close('.$arr['id'].')">取消本次操作</div>';
                   $html.=' </div>';
                $html.='</div>';
            $html.='</div>';
            }else{
              $html='nom';
            }
        }else{
            $html='no';
        }
       return $html;
    }
    static public function deposit_set_wh_sell_l($id){
        $arr=self::field('id,sys_mw_id,long_title,con,settime,starttime,endtime,uname,ucode,sex,phone,gzdw,email,home,mobile,beizhu,gname,gsex,address,work,gtime,diestarttime,dieendtime,roleid')->where(['id'=>$id['id']])->find();
        $user = self::table('role')->field('id,title')->select();
        if($arr){
            $html='';
            $html.='<form class="add_row_wh" method="post">';
            $html.='<div class="lztan" style="display: block;">';
                $html.='<div class="lztana">';
                        $html.='<fieldset>';
                            $html.='<legend>故者落葬信息</legend>';
                            $html.='<div class="lztanb">';
                                $html.='<div class="lztanba">';
                                    $html.='<p>寄存位全称：</p>';
                                    $html.='<input type="hidden" name="eid" value="'.$arr['id'].'" />';
                                    $html.='<input type="hidden" name="setsysid" value="'.$arr['sys_mw_id'].'" />';
                                    $html.='<input type="text" value="'.$arr['long_title'].'" disabled>';
                                $html.='</div>';
                                $html.='<div class="lztanbb">';
                                    $html.='<p>证书编号：</p>';
                                    $html.='<input type="text" value="'.$arr['con'].'" disabled>';
                                    $html.='<i>*</i>';
                               $html.=' </div>';
                            $html.='</div>';
                            $html.='<div class="lztanc">';
                                $html.='<div class="lztanca">';
                                    $html.='<p>故者姓名：</p>';
                                    $html.='<input type="text" name="gname"  id="gname" value="'.$arr['gname'].'">';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="lztancb">';
                                    $html.='<p>出生日期：</p>';
                                    $html.='<input class="Wdate" name="gtime" value="'.date('Y-m-d',$arr['gtime']).'" type="text" onClick="WdatePicker()">';
                                $html.='</div>';
                                $html.='<div class="lztancc">';
                                    $html.='<p>定购日期：</p>';
                                    $html.='<input type="text" value="'.date('Y-m-d',$arr['settime']).'" disabled>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="lztand">';
                                $html.='<div class="lztanda">';
                                    $html.='<p>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</p>';
                                    $html.='<select name="gsex"  id="gsex">';
                                      if($arr['gsex'] == '2'){
                                            $html.='<option value="2" selected>男</option>';
                                            $html.='<option value="3">女</option>';
                                        }else{
                                            $html.='<option value="2">男</option>';
                                            $html.='<option value="3" selected>女</option>';
                                        }
                                    $html.='</select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="lztandb">';
                                   $html.=' <p>逝世日期：</p>';
                                    $html.='<input class="Wdate" name="diestarttime" value="'.date('Y-m-d',$arr['diestarttime']).'" type="text" onClick="WdatePicker()">';
                               $html.=' </div>';
                               $html.=' <div class="lztandc">';
                                   $html.=' <p>使用开始：</p>';
                                   $html.=' <input class="Wdate" name="starttime" type="text" value="'.date('Y-m-d',$arr['starttime']).'" onClick="WdatePicker()">';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="lztane">';
                               $html.=' <div class="lztanea">';
                                   $html.=' <p>原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;籍：</p>';
                                   $html.=' <input type="text" name="address"  id="address" value="'.$arr['address'].'">';
                                   $html.=' <i>*</i>';
                               $html.=' </div>';
                               $html.=' <div class="lztaneb">';
                                    $html.='<p>落葬日期：</p>';
                                    $html.='<input class="Wdate" name="dieendtime" type="text" value="'.date('Y-m-d',$arr['dieendtime']).'" onClick="WdatePicker()">';
                                $html.='</div>';
                                $html.='<div class="lztanec">';
                                   $html.=' <p>使用结束：</p>';
                                    $html.='<input class="Wdate" name="endtime" type="text" value="'.date('Y-m-d',$arr['endtime']).'" onClick="WdatePicker()">';
                               $html.=' </div>';
                           $html.=' </div>';
                            $html.='<div class="lztanf">    ';                            
                                $html.='<div class="lztanfa">';
                                    $html.='<p>工作单位：</p>';
                                   $html.=' <input type="text" name="work"  id="work" value="'.$arr['work'].'">';
                                $html.='</div>';
                            $html.='</div>';
                       $html.=' </fieldset>';
                $html.='</div>';
                $html.='<div class="gztanj">';
                   $html.=' <div class="gztanjle">';
                       $html.=' <div class="gztanja">';
                               $html.=' <fieldset>';
                                    $html.='<legend>联系人信息</legend>';
                                   $html.=' <div class="gztanjc">';
                                       $html.=' <div class="gztanjca">';
                                           $html.=' <p>联系人姓名：</p>';
                                            $html.='<input type="text" name="uname" id="uname" value="'.$arr['uname'].'">';
                                            $html.='<i>*</i>';
                                       $html.=' </div>';
                                        $html.='<div class="gztanjcb">';
                                            $html.='<p>故者关系：</p>';
                                            $html.='<select name="gzgx" id="gzgx">';
                                              $html.='  <option value="其他">其他</option>';
                                            $html.='</select>';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjd">';
                                       $html.=' <div class="gztanjda">';
                                            $html.='<p>身份证号：</p>';
                                            $html.='<input type="text" value="'.$arr['ucode'].'" name="ucode" id="ucode" maxlength="18">';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                       $html.=' <div class="gztanjdb">';
                                            $html.='<p>性别：</p>';
                                            $html.='<select name="sex" id="sex">';
                                            if($arr['sex'] == '2'){
                                                $html.='<option value="2" selected>男</option>';
                                                $html.='<option value="3">女</option>';
                                            }else{
                                                $html.='<option value="2">男</option>';
                                                $html.='<option value="3" selected>女</option>';
                                            }
                                            $html.='</select>';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                    $html.='</div>';
                                   $html.=' <div class="gztanje">';
                                        $html.='<div class="gztanjea">';
                                           $html.=' <p>联系电话：</p>';
                                           $html.=' <input type="text" value="'.$arr['phone'].'" name="phone" id="phone">';
                                           $html.=' <i>*</i>';
                                        $html.='</div>';
                                        $html.='<div class="gztanjeb">';
                                            $html.='<p>手机：</p>';
                                            $html.='<input type="text" value="'.$arr['mobile'].'" name="mobile" id="mobile">';
                                            $html.='<i></i>';
                                        $html.='</div>';
                                    $html.='</div>     ';                         
                                    $html.='<div class="gztanjg">';
                                       $html.=' <div class="gztanjga">';
                                           $html.=' <p>工作单位：</p>';
                                           $html.=' <input type="text" value="'.$arr['gzdw'].'" name="gzdw" id="gzdw"> ';                                     
                                       $html.=' </div>   ';                                   
                                   $html.=' </div>';
                                   $html.=' <div class="gztanjg">';
                                        $html.='<div class="gztanjga">';
                                            $html.='<p>电子邮件：</p>';
                                            $html.='<input type="text" value="'.$arr['email'].'" name="email" id="email">  ';                                     
                                        $html.='</div>    ';                                  
                                    $html.='</div>';
                                    $html.='<div class="gztanjh">';
                                      $html.='  <div class="gztanjha">';
                                        $html.='    <p>家庭住址：</p>';
                                         $html.='   <input type="text" value="1" value="'.$arr['home'].'" name="home" id="home"> ';                                      
                                        $html.='</div>  ';                                    
                                    $html.='</div>';
                                $html.='</fieldset>';
                        $html.='</div>';
                        $html.='<div class="gztanjb">';
                             $html.='   <fieldset>';
                                $html.='    <legend>操作提示</legend>';
                               $html.=' </fieldset>';
                       $html.=' </div>';
                    $html.='</div>';
                   $html.=' <div class="gztanjri">';
                           $html.=' <fieldset>';
                              $html.='  <legend>故者落葬操作信息</legend>';
                                $html.='<div class="gztanjria">';
                                    $html.=' <p>业务员：</p>';
                                    $html.='<select disabled style="color:#C6C6C6;">';
                                        foreach ($user as $key => $value) {
                                            if($value['id'] == $arr['roleid']){
                                                $html.=' <option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                            }else{
                                                $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                            }
                                        }
                                    $html.='</select>';
                                    $html.=' <i>*</i>';
                                $html.='</div>';              
                               $html.=' <div class="gztanjric">';
                                    $html.='  <p>备注：</p>';
                                    $html.='  <textarea name="beizhu" id="beizhu">'.$arr['beizhu'].'</textarea>';
                               $html.=' </div>';
                               $html.=' <div class="gztanjrid">';
                                   $html.=' <div class="gztanjrida" onclick="seveg('.$arr['id'].')">保存</div>';
                                   $html.=' <div class="gztanjridb" onclick="closela()">取消</div>';
                                $html.='</div>';
                                $html.='<div class="gztanjrie" disabled style="color:#C6C6C6;">打印寄存位证</div>';
                                $html.='<div class="gztanjrif" disabled style="color:#C6C6C6;">打印寄存位档案表</div>';
                           $html.=' </fieldset>';
                   $html.=' </div>';
                $html.='</div>';
           $html.=' </div>';
           $html.=' </form>';
        }else{
            return ['status' => false, 'msg' => '系统错误，请从新设置'];
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
        $info['sumgl']=$info['glmo']*$info['glmt'];
        $info['con']='Con'.date('YmdHis',time());
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
    static public function dep_sell_wh_set ($info) {
        if (!(int)$info['eid'] || empty($info['eid'])) {
            return ['status' => false, 'msg' => '系统错误，请从新设置'];
        }
        if (!(int)$info['setsysid'] || empty($info['setsysid'])) {
            return ['status' => false, 'msg' => '系统错误，请从新设置'];
        }
        $info['time']=time();
        $info['gtime']=strtotime($info['gtime']);//出生日期
        $info['diestarttime']=strtotime($info['diestarttime']);//逝世日期
        $info['dieendtime']=strtotime($info['dieendtime']);//落葬日期
        $info['starttime']=strtotime($info['starttime']);
        $info['endtime']=strtotime($info['endtime']);
        $info['syszt']=2;
        $user = self::table('sys_mw')->where(['id'=>$info['setsysid']])->field('syszt')->find();
        if($user['syszt'] == 2){
            Db::startTrans();
            try{
                Db::table('dep_sell')->where(['id'=>$info['eid']])->update($info);
                Db::table('sys_mw')->where(['id'=>$info['setsysid']])->update(['syszt'=>3]);
                // 提交事务
                Db::commit();
                return RE_SUCCESS;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return RE_ERROR;
            }
        }else{
            return ['status' => false, 'msg' => '该位置已落葬'];
        }
    }
    static public function dep_wh_del($info){
        Db::startTrans();
        try{
            Db::table('dep_sell')->where(['id'=>$info['id']])->delete();
            Db::table('sys_mw')->where(['id'=>$info['sid']])->update(['syszt'=>1]);
            // 提交事务
            Db::commit();
            return 'ok';
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return 'no';
        }
    }
    static function finan_set_syslist($info){
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::where('id', $info['id'])->update(['sta'=>2]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
