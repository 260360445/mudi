<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Tpl as _Tpl;
class CemInfo extends Root {

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    // protected $autoWriteTimestamp = 'datetime';

    protected $table = 'cem_info';

    static public function wlist ($map = []) {
        return self::where($map)->order('cem_id', 'asc')->column('*', 'id');
    }   
    static public function wlistt ($map = []) {
        return self::field('a.id,a.long_title,a.pay_status,a.sta,a.status,a.price,a.money,a.reserve_money,a.unpaid_money,a.pay_status,a.reserve_date,a.reserve_date,a.remind_date,a.update_by,a.beizhu,a.salesman,b.name,b.sex,b.idcard,b.tel,b.phone,b.postcode,b.address,b.workplace,b.email,b.relationship,d.dead_name')->alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where($map)->select();
    }
    static public function select_buy_ding($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->where(['a.id'=>$info['id']])->find();
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $cem_sty=_Tpl::tlist(2);//墓位样式
        $html='';
        $html.='<div class="ydtan" style="display:block;">';
            $html.='<div class="tanfs">';
                $html.='<form>';
                    $html.='<fieldset>';
                        $html.='<legend>墓位信息</legend>';
                        $html.='<div class="tanfsa">';
                            $html.='<p>您选择的是：'.$arr['long_title'].'|墓位样式：'.$cem_sty[$arr['style']]['title'].'</p>';
                            $html.='<div class="tanfsb">';
                                $html.='<div>墓位长：'.$arr['width'].'米</div>';
                                $html.='<div>墓位宽：'.$arr['length'].'米</div>';
                                $html.='<div>价格：'.$arr['price'].'</div>';
                                $html.='<div>墓位材质：'.$cem_mat[$arr['material']]['title'].'</div>';
                                $html.='<div>墓位状态：'.$cem_status[$arr['status']]['title'].'</div>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
                $html.='</form>';
            $html.='</div>';
            $html.='<div class="tangs">';
                $html.='<form>';
                    $html.='<fieldset>';
                        $html.='<legend>墓位预订信息</legend>';
                        $html.='<div class="tangsa">';
                            $html.='<div class="tangsb">';
                                $html.='<div>成交价：'.$arr['money'].'元</div>';
                                $html.='<div>预付款：'.$arr['reserve_money'].'元</div>';
                                $shengyu=$arr['money']-$arr['reserve_money'];
                                $html.='<div>剩余款：'.$arr['unpaid_money'].'元</div>';
                                $html.='<div>预订日期：'.date('Y-m-d',$arr['reserve_date']).'</div>';
                            $html.='</div>';
                            $html.='<div class="tangsc">';
                                $html.='<div>联系人：'.$arr['name'].'</div>';
                                $html.='<div>身份证：'.$arr['idcard'].'</div>';
                                $html.='<div>联系电话：'.$arr['tel'].'</div>';
                                $html.='<div>过期日期：'.date('Y-m-d',$arr['remind_date']).'</div>';
                            $html.='</div>';
                       $html.=' </div>';
                    $html.='</fieldset>';
                $html.='</form>';
            $html.='</div>';
            $html.='<div class="ydtana">';
                $html.='<div class="ydtanb">';
                    $html.='<div onclick="tc2_show();">修改预订墓位信息</div>';
                    $html.='<div onclick="tc3_show();">交清余款（购墓）</div>';
                    $html.='<div onclick="setqx()">取消预订</div>';
                $html.='</div>';
                $html.='<div class="ydtanc" onclick="setqxclose()">退出</div>';
            $html.='</div>';
        $html.='</div>';
        return $html;
    }
    static public function select_buy_ding_buy($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where(['a.id'=>$info['id']])->find();
        $user = self::table('staff')->field('id,nickname')->select();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $html='';
        $html.='<div class="whtan" style="display:block;">';
            $html.='<div class="whtana">';
                $html.='<form>';
                    $html.='<fieldset>';
                        $html.='<legend>墓位预订信息</legend>';
                        $html.='<div class="whtanb">';
                            $html.='<div class="whtand">';
                                $html.='<p>墓位全称：</p>';
                                $html.='<input type="hidden" value="'.$info['id'].'" id="seid"/>';
                                $html.='<input type="text" value="'.$arr['long_title'].'" disabled/>';
                                $html.='<i></i>';
                            $html.='</div>';
                            $html.='<div class="whtand">';
                                $html.='<p>预定日期：</p>';
                                $html.='<input class="Wdate" name="reserve_date" value="'.date('Y-m-d',$arr['reserve_date']).'" type="text" onClick="WdatePicker()">';
                                $html.='<i></i>';
                            $html.='</div>';
                            $html.='<div class="whtand">';
                                $html.='<p>提醒日期：</p>';
                                $html.='<input class="Wdate" name="remind_date" type="text" value="'.date('Y-m-d',$arr['remind_date']).'"  onClick="WdatePicker()">';
                                $html.='<i></i>';
                            $html.='</div>';
                       $html.=' </div>';
                        $html.='<div class="whtanb">';
                            $html.='<div class="whtand">';  
                                $html.='<p>原始价格：</p>';
                                $html.='<input type="text" value="'.$arr['price'].'" disabled/>';
                                $html.='<i></i>';
                            $html.='</div>';
                            $html.='<div class="whtand">';
                               $html.=' <p>成交价格：</p>';
                               $html.=' <input type="text" value="'.$arr['money'].'" disabled/>';
                               $html.=' <i>*</i>';
                           $html.=' </div>';
                            $html.='<div class="whtand">';
                                $html.='<p>预订金额：</p>';
                                $html.='<input type="text" value="'.$arr['reserve_money'].'" disabled/>';
                                $html.='<i>*</i>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="whtanb">';
                            $html.='<div class="whtand">';
                                $html.='<p>补交金额：</p>';
                                $html.='<input type="text" disabled/>';
                                $html.='<i>*</i>';
                            $html.='</div>';
                            $html.='<div class="whtand">';
                               $html.=' <p>余额：</p>';
                               $html.=' <input type="text" value="'.$arr['unpaid_money'].'"  disabled/>';
                                $html.='<i>*</i>';  
                               $html.=' <em>价格单位：（元）</em>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
                $html.='</form>';
            $html.='</div>';
            $html.='<div class="whtane">';
               $html.=' <div class="whtanele">';
                  $html.='  <form>';
                        $html.='<fieldset>';
                            $html.='<legend>联系人信息</legend>';
                            $html.='<div class="whlea">';
                                $html.='<div class="whleb">';
                                    $html.='<p>故者姓名：</p>';
                                    $html.='<input type="text" name="dead_name" value="'.$arr['dead_name'].'"/>';
                                    $html.='<i></i>';
                                $html.='</div>';
                                $html.='<div class="whlec">';
                                    $html.='<p>故者关系：</p>';
                                    $html.='<select name="dead_relationship" id="dead_relationship">';/*'relationship*/
                                        foreach ($tpl as $key => $value) {
                                            if($value['id'] == $arr['relationship']){
                                                $html.=' <option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                            }else{
                                                $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';    
                                            }
                                        }
                                    $html.='</select>';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="whlea">';
                                $html.='<div class="whleb">';
                                   $html.=' <p>联系人姓名：</p>';
                                    $html.='<input type="text" value="'.$arr['name'].'" name="contacts_name"/>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="whlec">';
                                    $html.='<p>邮政编码：</p>';
                                    $html.='<input type="text" value="'.$arr['postcode'].'" name="contacts_postcode"/>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="whlea">';
                               $html.=' <div class="whleb">';
                                   $html.=' <p>身份证号：</p>';
                                    $html.='<input type="text" value="'.$arr['idcard'].'" name="contacts_idcard"/>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="whlec">';
                                    $html.='<p>性别：</p>';
                                     $html.='<select name="contacts_sex" id="contacts_sex">';
                                     if($arr['sex'] == '1'){
                                        $html.='<option value="1" selected>男</option>';
                                       $html.='<option value="0">女</option>';
                                     }else{
                                        $html.='<option value="1" selected>男</option>';
                                       $html.='<option value="0">女</option>';    
                                     }
                                   $html.='</select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="whlea">';
                                $html.='<div class="whleb">';
                                   $html.='<p>联系电话：</p>';
                                    $html.='<input type="text" value="'.$arr['tel'].'" name="contacts_tel"/>';
                                    $html.='<i>*</i>';
                               $html.=' </div>';
                                $html.='<div class="whlec">';
                                    $html.='<p>手机：</p>';
                                    $html.='<input type="text" value="'.$arr['phone'].'" name="contacts_phone"/>';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="whlea">';
                               $html.=' <div class="whleb">';
                                    $html.='<p>工作单位：</p>';
                                    $html.='<input type="text" value="'.$arr['workplace'].'" name="contacts_workplace"/>';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="whlea">';
                                $html.='<div class="whleb">';
                                    $html.='<p>电子邮件：</p>';
                                    $html.='<input type="text" value="'.$arr['email'].'" name="contacts_email"/>';
                                    $html.='<i></i>';
                               $html.=' </div>';
                           $html.=' </div>';
                           $html.=' <div class="whlea">';
                               $html.=' <div class="whleb">';
                                   $html.=' <p>家庭住址：</p>';
                                   $html.=' <input type="text" value="'.$arr['address'].'" name="contacts_address"/>';
                                   $html.=' <i></i>';
                               $html.=' </div>';
                           $html.=' </div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
               $html.=' <div class="whtaneri">';
                    $html.='<form>';
                       $html.='<fieldset>';
                           $html.=' <legend>墓位预订操作信息</legend>';
                            $html.='<div class="whtanyw">';
                                $html.='<p>业务员：</p>';
                               $html.=' <input type="text" value="'.session('nickname').'"/>';
                                $html.='<i>*</i>';
                           $html.='</div>';
                            $html.='<div class="whtanyw">';
                               $html.=' <p>操作员：</p>';
                                $html.=' <select name="salesman" id="salesman">';/*staff*/
                                    foreach ($user as $key => $value) {
                                        $html.=' <option value="'.$value['id'].'">'.$value['nickname'].'</option>';
                                    }
                                $html.=' </select>';
                                $html.='<i>*</i>';
                            $html.='</div>';
                            $html.='<div class="whtanbz">';
                               $html.=' <p>备注：</p>';
                                $html.='<textarea id="beizhu">'.$arr['beizhu'].'</textarea>';
                            $html.='</div>';
                            $html.='<div class="whtanbc">';
                                $html.=' <button class="whtanbca" type="button" onclick="subresding()">保存</button>';
                                $html.='  <button class="whtanbcb" type="button" onclick="closeresding()">取消</button>';
                            $html.='</div>';
                            $html.='<div class="whtandy">打印墓位预订单</div>';
                        $html.='</fieldset>';
                   $html.=' </form>';
               $html.=' </div>';
           $html.=' </div>';
            $html.='<div class="whtancz">';
               $html.=' <form>';
                    $html.='<fieldset>';
                       $html.=' <legend>操作提示</legend>';
                   $html.='</fieldset>';
                $html.='</form>';
            $html.='</div>';
        $html.='</div>';
        return $html;
    }
    static public function select_buy_type($info){
        $arr=self::where(['id'=>$info['id']])->find();
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_mat=_Tpl::tlist(3);//墓位材料  
        $html='';
        $html.='<div class="ktan" style="display:block;">';
           $html.='<div class="ktana">';
               $html.='<p>您选择的是：<span class="long_title">'.$arr['long_title'].'</span></p>';
          $html.=' </div>';
           $html.='<div class="ktanb">';
              $html.=' <div>墓位长：<span class="c_width">'.$arr['width'].'<span>米</span></span></div>';
               $html.='<div>墓位宽：<span class="c_height"> '.$arr['length'].' <span>米</span></span></div>';
               $html.='<div>价格：<span class="c_width"> '.$arr['price'].'<span></span></span></div>';
               $html.='<div>墓位材质：<span class="c_width">：'.$cem_mat[$arr['material']]['title'].'<span></span></span></div>';
               $html.='<div>墓位状态：<span class="c_width">'.$cem_status[$arr['status']]['title'].'<span></span></span></div>';
           $html.='</div>';
           $html.='<div class="ktanc">';
               $html.=' <div class="ktanca" onclick="ydmw();">预订墓位</div>';
               $html.='<div class="ktancb" onclick="zjgm()">直接购墓</div>';
           $html.='</div>';
        $html.='</div>';
        return $html;
    }
    static public function reserve($info){
        $arr=self::where(['id'=>$info['id']])->find();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $user = self::table('staff')->field('id,nickname')->select();
        $html='';
        $html.='<form class="add_row" method="post">';
        $html.='<div class="whtan" style="display:block;">';
           $html.='<div class="whtana">';
                   $html.='<fieldset>';
                      $html.=' <legend>墓位预订信息</legend>';
                       $html.='<div class="whtanb">';
                           $html.='<div class="whtand">';
                               $html.='<p>墓位全称：</p>';
                               $html.='<input type="hidden" value="'.$info['id'].'" id="seid"/>';
                               $html.='<input type="text" value="'.$arr['long_title'].'" readonly />';
                               $html.='<i></i>';
                           $html.='</div>';
                           $html.='<div class="whtand">';
                               $html.='<p>预定日期：</p>';
                               $html.=' <input class="Wdate" name="reserve_date" type="text" onClick="WdatePicker()">';
                               $html.='<i></i>';
                           $html.='</div>';
                           $html.='<div class="whtand">';
                               $html.='<p>提醒日期：</p>';
                             $html.='<input class="Wdate" name="remind_date" type="text" onClick="WdatePicker()">';
                              $html.=' <i></i>';
                           $html.='</div>';
                       $html.='</div>';
                       $html.='<div class="whtanb">';
                           $html.='<div class="whtand">';
                               $html.='<p>原始价格：</p>';
                               $html.='<input type="text" value="'.$arr['price'].'" readonly />';
                               $html.='<i></i>';
                           $html.='</div>';
                           $html.='<div class="whtand">';
                               $html.='<p>成交价格：</p>';
                               $html.='<input type="text" name="money"/>';
                               $html.='<i>*</i>';
                           $html.='</div>';
                          $html.=' <div class="ktand">';
                               $html.='价格单位：（元）';
                           $html.='</div>';
                       $html.='</div>';
                       $html.='<div class="whtanb">';
                           $html.='<div class="whtand">';
                              $html.=' <p>预订金额：</p>';
                              $html.=' <input type="text" name="reserve_money"/>';
                              $html.=' <i>*</i>';
                           $html.='</div>';
                           $html.='<div class="whtand">';
                               $html.='<p>余额：</p>';
                               $html.='<input type="text" name="unpaid_money" />';
                              $html.=' <i>*</i>';
                           $html.='</div>';
                           $html.='<div class="ktane" onclick="zksq()">折扣授权</div>';
                       $html.='</div>';
                   $html.='</fieldset>';
           $html.='</div>';
           $html.='<div class="whtane">';
              $html.=' <div class="whtanele">';

                      $html.=' <fieldset>';
                          $html.=' <legend>联系人信息</legend>';
                           $html.='<div class="whlea">';
                               $html.='<div class="whleb">';
                                  $html.=' <p>故者姓名：</p>';
                                  $html.=' <input type="text" name="dead_name" />';
                                   $html.='<i></i>';
                               $html.='</div>';
                               $html.='<div class="whlec">';
                                   $html.=' <p>故者关系：</p>';
                                   $html.='<select name="dead_relationship" id="dead_relationship">';/*'relationship*/
                                        foreach ($tpl as $key => $value) {
                                            $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                        }
                                   $html.='</select>';
                                   $html.='<i></i>';
                               $html.='</div>';
                          $html.=' </div>';
                           $html.='<div class="whlea">';
                               $html.='<div class="whleb">';
                                   $html.='<p>联系人姓名：</p>';
                                   $html.='<input type="text" name="contacts_name" />';
                                   $html.='<i>*</i>';
                               $html.='</div>';
                               $html.='<div class="whlec">';
                                   $html.='<p>邮政编码：</p>';
                                   $html.='<input type="text" value="150036" name="contacts_postcode"/>';
                                   $html.='<i>*</i>';
                              $html.=' </div>';
                           $html.='</div>';
                           $html.='<div class="whlea">';
                              $html.=' <div class="whleb">';
                                   $html.='<p>身份证号：</p>';
                                   $html.='<input type="text" name="contacts_idcard"  />';
                                   $html.='<i>*</i>';
                              $html.=' </div>';
                               $html.='<div class="whlec">';
                                   $html.='<p>性别：</p>';
                                   $html.='<select name="contacts_sex" id="contacts_sex">';
                                       $html.='<option value="1">男</option>';
                                       $html.='<option value="0">女</option>';
                                   $html.='</select>';
                                   $html.='<i>*</i>';
                               $html.='</div>';
                           $html.='</div>';
                           $html.='<div class="whlea">';
                               $html.='<div class="whleb">';
                                  $html.=' <p>联系电话：</p>';
                                   $html.='<input type="text" name="contacts_tel"/>';
                                   $html.='<i>*</i>';
                               $html.='</div>';
                               $html.='<div class="whlec">';
                                   $html.='<p>手机：</p>';
                                   $html.='<input type="text" name="contacts_phone"  />';
                                   $html.='<i></i>';
                               $html.='</div>';
                           $html.='</div>';
                           $html.='<div class="whlea">';
                               $html.='<div class="whleb">';
                                   $html.='<p>工作单位：</p>';
                                   $html.='<input type="text" name="contacts_workplace" />';
                                   $html.='<i></i>';
                               $html.='</div>';
                           $html.='</div>';
                           $html.='<div class="whlea">';
                               $html.='<div class="whleb">';
                                   $html.='<p>电子邮件：</p>';
                                   $html.='<input type="text" name="contacts_email" />';
                                   $html.='<i></i>';
                               $html.='</div>';
                           $html.='</div>';
                           $html.='<div class="whlea">';
                              $html.=' <div class="whleb">';
                                   $html.='<p>家庭住址：</p>';
                                   $html.='<input type="text"  name="contacts_address" />';
                                   $html.='<i></i>';
                               $html.='</div>';
                           $html.='</div>';
                      $html.=' </fieldset>';

               $html.=' </div>';
               $html.=' <div class="whtaneri">';

                       $html.=' <fieldset>';
                           $html.=' <legend>墓位预订操作信息</legend>';
                           $html.=' <div class="whtanyw">';
                               $html.=' <p>操作员：</p>';
                               $html.=' <input type="text" value="'.session('nickname').'" readonly/>';
                               $html.=' <i>*</i>';
                           $html.=' </div>';
                           $html.=' <div class="whtanyw">';
                               $html.=' <p>业务员：</p>';
                               $html.=' <select name="salesman" id="salesman">';/*staff*/
                                    foreach ($user as $key => $value) {
                                        $html.=' <option value="'.$value['id'].'">'.$value['nickname'].'</option>';
                                    }
                               $html.=' </select>';
                              $html.='  <i>*</i>';
                           $html.=' </div>';
                           $html.=' <div class="whtanbz">';
                               $html.=' <p>备注：</p>';
                              $html.='  <textarea id="beizhu"></textarea>';
                           $html.=' </div>';
                           $html.=' <div class="whtanbc">';
                               $html.=' <button class="whtanbca" type="button" onclick="subres()">保存</button>';
                              $html.='  <button class="whtanbca" type="button" onclick="closeres()">取消</button>';
                           $html.=' </div>';
                           $html.=' <div class="whtandy">打印墓位预订单</div>';
                      $html.='  </fieldset>';

               $html.=' </div>';
           $html.=' </div>';
          $html.='  <div class="whtancz">';
                   $html.=' <fieldset>';
                       $html.=' <legend>操作提示</legend>';
                  $html.='  </fieldset>';
               $html.=' </form>';
           $html.=' </div>';
        return $html;
    }
    static public function reserve_zjgm_jie($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where(['a.id'=>$info['id']])->find();
        $user = self::table('staff')->field('id,nickname')->select();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $html='';
        $html.=' <form>';
        $html.='<div class="dgtan" style="display:block;">';
            $html.='<div class="dgtana">';
                    $html.='<fieldset>';
                        $html.='<legend>墓位定购信息</legend>';
                        $html.='<div class="dgtanb">';
                            $html.='<div class="dgtanba">';
                               $html.=' <p>墓位全称：</p>';
                               $html.='<input type="hidden" id="setid" value="'.$info['id'].'" />';
                               $html.=' <input type="text" value="'.$arr['long_title'].'" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtanbb">';
                                $html.='<p>墓位费：</p>';
                                $html.='<input type="text" value="'.$arr['money'].'" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtanbc">';
                                $html.='<p>定购日期：</p>';
                                $html.='<input class="Wdate" name="settime" id="settime" type="text" onClick="WdatePicker()">';
                           $html.=' </div>';
                        $html.='</div>';
                        $html.='<div class="dgtanc">';
                            $html.='<div class="dgtanca">';
                                $html.='<p>预交金额：</p>';
                                $html.='<input type="text" value="'.$arr['reserve_money'].'" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtancb">';
                            $yue=$arr['money']-$arr['reserve_money'];
                               $html.=' <p>管理费：</p>';
                                $html.='<input type="text" class="dgtancba" name="manage_money" id="manage_money" onblur="glmone()">';
                                $html.=' <em>X</em>';
                                $html.='<input type="text" class="dgtancbb" name="manage_year" id="manage_year" onchange="glmtwo()">';
                                $html.='<b>年=</b>';
                                $html.='<input type="text" class="dgtancbc" name="manage_sum_money" id="manage_sum_money" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtancc">';
                                $html.='<p>使用开始：</p>';
                                $html.='<input class="Wdate" name="starttime" id="starttime" type="text" onClick="WdatePicker()">';
                           $html.=' </div>';
                        $html.='</div>';
                       $html.=' <div class="dgtand">';
                            $html.='<div class="dgtanda zjtana">';
                                $html.='<p>余额：</p>';
                                $html.=' <input type="hidden" value="'.$arr['unpaid_money'].'" id="yuee"/>';
                               $html.=' <input type="text" value="'.$arr['unpaid_money'].'" disabled />';
                            $html.='</div>';
                            
                            $html.='<div class="whtand">';
                                $html.='<p>应付总额：</p>';
                                $html.='<input type="text" name="pay_sum_money" id="pay_sum_money" disabled/>';
                            $html.='</div>';
                            $html.='<div class="dgtandc">';
                                $html.='<p>使用结束：</p>';
                                $html.='<input class="Wdate" name="endtime" id="endtime" type="text" onClick="WdatePicker()">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
            $html.='</div>';
            $html.='<div class="gztanj" style="margin-top: 20px;">';
                $html.='<div class="gztanjle">';
                    $html.='<div class="gztanja">';
                            $html.='<fieldset>';
                                $html.='<legend>联系人信息</legend>';
                               $html.=' <div class="gztanjc">';
                                    $html.='<div class="gztanjca">';
                                        $html.='<p>联系人姓名：</p>';
                                        $html.='<input type="text" name="contacts_name" value="'.$arr['name'].'">';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjcb">';
                                        $html.='<p>故者关系：</p>';
                                        $html.='<select name="dead_relationship" id="dead_relationship">';/*'relationship*/
                                            foreach ($tpl as $key => $value) {
                                                if($value['id'] == $arr['relationship']){
                                                    $html.=' <option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                                }else{
                                                    $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                                }
                                            }
                                        $html.='</select>';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                               $html.=' </div>';
                                $html.='<div class="gztanjd">';
                                   $html.=' <div class="gztanjda">';
                                        $html.='<p>身份证号：</p>';
                                        $html.='<input type="text" name="contacts_idcard" value="'.$arr['idcard'].'">';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjdb">';
                                        $html.='<p>性别：</p>';
                                        $html.='<select name="contacts_sex" id="contacts_sex">';
                                        if($arr['sex'] == '1'){
                                            $html.='<option value="1" selected>男</option>';
                                            $html.=' <option value="0">女</option>';
                                        }else{
                                            $html.='<option value="1">男</option>';
                                            $html.=' <option value="0" selected>女</option>';
                                        }
                                        $html.='</select>';
                                        $html.='<i>*</i>';
                                   $html.=' </div>';
                                $html.='</div>';
                                $html.='<div class="gztanje">';
                                   $html.=' <div class="gztanjea">';
                                        $html.='<p>联系电话：</p>';
                                        $html.='<input type="text" name="contacts_tel" value="'.$arr['tel'].'"/>';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjeb">';
                                        $html.='<p>手机：</p>';
                                        $html.='<input type="text" name="contacts_phone" id="mobile" onblur="gmobile()" maxlength="11" value="'.$arr['phone'].'">'; 
                                        $html.='<i></i>';
                                    $html.='</div>';
                                $html.='</div>     ';                         
                                $html.='<div class="gztanjg">';
                                    $html.='<div class="gztanjga">';
                                        $html.='<p>工作单位：</p>';
                                        $html.='<input type="text" name="contacts_workplace"  value="'.$arr['workplace'].'"/>';                                      
                                    $html.='</div> ';                                    
                                $html.='</div>';
                                $html.='<div class="gztanjg">';
                                   $html.=' <div class="gztanjga">';
                                       $html.=' <p>电子邮件：</p>';
                                       $html.='<input type="text" name="contacts_email"  value="'.$arr['email'].'"/>';                                    
                                    $html.='</div>    ';                                  
                                $html.='</div>';
                                $html.='<div class="gztanjh">';
                                   $html.=' <div class="gztanjha">';
                                        $html.='<p>家庭住址：</p>';
                                        $html.='<input type="text" name="contacts_address" value="'.$arr['address'].'">   ';                                      
                                    $html.='</div>    ';                                  
                                $html.='</div>';
                           $html.=' </fieldset>';
                    $html.='</div>';
                    $html.='<div class="gztanjb">';
                           $html.=' <fieldset>';
                            $html.='    <legend>操作提示</legend>';
                            $html.='</fieldset>';
                    $html.='</div>';
                $html.='</div>';
                 $html.='<div class="gztanjri">';
                        $html.=' <fieldset>';
                             $html.='<legend>故者落葬操作信息</legend>';
                             $html.='<div class="gztanjria">';
                                 $html.=' <p>操作员：</p>';
                                 $html.=' <input type="text" value="'.session('nickname').'">';
                                 $html.=' <i>*</i>';
                            $html.=' </div> ';
                            $html.=' <div class="gztanjria">';
                                $html.='  <p>业务员：</p>';
                                $html.=' <select name="salesman" id="salesman">';/*staff*/
                                    foreach ($user as $key => $value) {
                                        $html.=' <option value="'.$value['id'].'">'.$value['nickname'].'</option>';
                                    }
                                $html.=' </select>';
                                $html.='  <i>*</i>';
                             $html.='</div>       ';                       
                             $html.='<div class="gztanjric">';
                                   $html.='<p>备注：</p>';
                                  $html.=' <textarea id="beizhu">'.$arr['beizhu'].'</textarea>';
                             $html.='</div>';
                             $html.='<div class="gztanjrid">';
                                $html.=' <button type="button" class="gztanjrida" onclick="subforms()">保存</button>';
                                $html.=' <button type="button" class="gztanjrida" onclick="closeghtml()">取消</button>';
                            $html.=' </div>';
                            $html.=' <div class="gztanjrie">选择身份证扫描件</div>';
                             $html.='<div class="gztanjrie">打印购墓合同（正）</div>';
                           $html.='  <div class="gztanjrif">打印购墓合同（反）</div>';
                         $html.='</fieldset>';
                $html.='</div>';
             $html.='</div>';
          $html.='</div>';
          $html.=' </form>';
        return $html;
    }
    static public function reserve_zjgm($info){
        $arr=self::where(['id'=>$info['id']])->find();
        $user = self::table('staff')->field('id,nickname')->select();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $html='';
        $html.=' <form>';
        $html.='<div class="dgtan" style="display:block;">';
            $html.='<div class="dgtana">';
                    $html.='<fieldset>';
                        $html.='<legend>墓位定购信息</legend>';
                        $html.='<div class="dgtanb">';
                            $html.='<div class="dgtanba">';
                               $html.=' <p>墓位全称：</p>';
                               $html.='<input type="hidden" id="setid" value="'.$info['id'].'" />';
                               $html.=' <input type="text" value="'.$arr['long_title'].'" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtanbb">';
                                $html.='<p>原始价格：</p>';
                                $html.='<input type="text" value="'.$arr['price'].'" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtanbc">';
                                $html.='<p>定购日期：</p>';
                                $html.='<input class="Wdate" name="settime" id="settime" type="text" onClick="WdatePicker()">';
                           $html.=' </div>';
                        $html.='</div>';
                        $html.='<div class="dgtanc">';
                            $html.='<div class="dgtanca">';
                                $html.='<p>墓位费：</p>';
                                $html.='<input type="text" name="mw_price" id="mw_price" onblur="jcwf()">';
                            $html.='</div>';
                            $html.='<div class="dgtancb">';
                               $html.=' <p>管理费：</p>';
                                $html.='<input type="text" class="dgtancba" name="manage_money" id="manage_money" onblur="glmone()">';
                                $html.=' <em>X</em>';
                                $html.='<input type="text" class="dgtancbb" name="manage_year" id="manage_year" onchange="glmtwo()">';
                                $html.='<b>年=</b>';
                                $html.='<input type="text" class="dgtancbc" name="manage_sum_money" id="manage_sum_money" disabled>';
                            $html.='</div>';
                            $html.='<div class="dgtancc">';
                                $html.='<p>使用开始：</p>';
                                $html.='<input class="Wdate" name="starttime" id="starttime" type="text" onClick="WdatePicker()">';
                           $html.=' </div>';
                        $html.='</div>';
                       $html.=' <div class="dgtand">';
                            $html.='<div class="dgtanda zjtana">';
                                $html.='<p>应付总额：</p>';
                               $html.=' <input type="text" name="pay_sum_money" id="pay_sum_money" disabled/>';
                            $html.='</div>';
                            $html.='<div class="dgtandb zjtanb">';
                                $html.='<p>价格单位：（元）</p>';
                                $html.='<div class="zjtanc">折扣授权</div>';
                            $html.='</div>';
                            $html.='<div class="dgtandc">';
                                $html.='<p>使用结束：</p>';
                                $html.='<input class="Wdate" name="endtime" id="endtime" type="text" onClick="WdatePicker()">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
            $html.='</div>';
            $html.='<div class="gztanj" style="margin-top: 20px;">';
                $html.='<div class="gztanjle">';
                    $html.='<div class="gztanja">';
                            $html.='<fieldset>';
                                $html.='<legend>联系人信息</legend>';
                               $html.=' <div class="gztanjc">';
                                    $html.='<div class="gztanjca">';
                                        $html.='<p>联系人姓名：</p>';
                                        $html.='<input type="text" name="contacts_name" >';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjcb">';
                                        $html.='<p>故者关系：</p>';
                                        $html.='<select name="dead_relationship" id="dead_relationship">';/*'relationship*/
                                            foreach ($tpl as $key => $value) {
                                                $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                            }
                                        $html.='</select>';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                               $html.=' </div>';
                                $html.='<div class="gztanjd">';
                                   $html.=' <div class="gztanjda">';
                                        $html.='<p>身份证号：</p>';
                                        $html.='<input type="text" name="contacts_idcard">';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjdb">';
                                        $html.='<p>性别：</p>';
                                        $html.='<select name="contacts_sex" id="contacts_sex">';
                                            $html.='<option value="1">男</option>';
                                           $html.=' <option value="0">女</option>';
                                        $html.='</select>';
                                        $html.='<i>*</i>';
                                   $html.=' </div>';
                                $html.='</div>';
                                $html.='<div class="gztanje">';
                                   $html.=' <div class="gztanjea">';
                                        $html.='<p>联系电话：</p>';
                                        $html.='<input type="text" name="contacts_tel"/>';
                                        $html.='<i>*</i>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjeb">';
                                        $html.='<p>手机：</p>';
                                        $html.='<input type="text" name="contacts_phone" id="mobile" onblur="gmobile()" maxlength="11">'; 
                                        $html.='<i></i>';
                                    $html.='</div>';
                                $html.='</div>     ';                         
                                $html.='<div class="gztanjg">';
                                    $html.='<div class="gztanjga">';
                                        $html.='<p>工作单位：</p>';
                                        $html.='<input type="text" name="contacts_workplace" />';                                      
                                    $html.='</div> ';                                    
                                $html.='</div>';
                                $html.='<div class="gztanjg">';
                                   $html.=' <div class="gztanjga">';
                                       $html.=' <p>电子邮件：</p>';
                                       $html.='<input type="text" name="contacts_email" />';                                    
                                    $html.='</div>    ';                                  
                                $html.='</div>';
                                $html.='<div class="gztanjh">';
                                   $html.=' <div class="gztanjha">';
                                        $html.='<p>家庭住址：</p>';
                                        $html.='<input type="text" name="contacts_address">   ';                                      
                                    $html.='</div>    ';                                  
                                $html.='</div>';
                           $html.=' </fieldset>';
                    $html.='</div>';
                    $html.='<div class="gztanjb">';
                           $html.=' <fieldset>';
                            $html.='    <legend>操作提示</legend>';
                            $html.='</fieldset>';
                    $html.='</div>';
                $html.='</div>';
                 $html.='<div class="gztanjri">';
                        $html.=' <fieldset>';
                             $html.='<legend>故者落葬操作信息</legend>';
                             $html.='<div class="gztanjria">';
                                 $html.=' <p>操作员：</p>';
                                 $html.=' <input type="text" value="'.session('nickname').'">';
                                 $html.=' <i>*</i>';
                            $html.=' </div> ';
                            $html.=' <div class="gztanjria">';
                                $html.='  <p>业务员：</p>';
                                $html.=' <select name="salesman" id="salesman">';/*staff*/
                                    foreach ($user as $key => $value) {
                                        $html.=' <option value="'.$value['id'].'">'.$value['nickname'].'</option>';
                                    }
                                $html.=' </select>';
                                $html.='  <i>*</i>';
                             $html.='</div>       ';                       
                             $html.='<div class="gztanjric">';
                                   $html.='<p>备注：</p>';
                                  $html.=' <textarea id="beizhu"></textarea>';
                             $html.='</div>';
                             $html.='<div class="gztanjrid">';
                                $html.=' <button type="button" class="gztanjrida" onclick="subform()">保存</button>';
                                $html.=' <button type="button" class="gztanjrida" onclick="closeghtml()">取消</button>';
                            $html.=' </div>';
                            $html.=' <div class="gztanjrie">选择身份证扫描件</div>';
                             $html.='<div class="gztanjrie">打印购墓合同（正）</div>';
                           $html.='  <div class="gztanjrif">打印购墓合同（反）</div>';
                         $html.='</fieldset>';
                $html.='</div>';
             $html.='</div>';
          $html.='</div>';
          $html.=' </form>';
        return $html;
    }
    static public function del ($ids) {
        if (empty($ids) || !count($ids) ) {
            return ['status' => false, 'msg' => '请选择要删除的墓位'];
        }
        if (self::where('id', 'in', $ids)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    //预订墓位 退订
    static public function ten_setqx($info){
        if (self::where('id', $info['id'])->update(['sta'=>2]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    //确认墓位预订收费
    static public function finan_set_muwei($info){
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::where('id', $info['id'])->update(['pay_status'=>2]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    //确认墓位预订退订收费
    static public function finan_set_muweit($info){
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::where('id', $info['id'])->update(['pay_status'=>3]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function edit ($info) {
        if (empty($info['ids']) || !count($info['ids']) ) {
            return ['status' => false, 'msg' => '请选择要修改的墓位'];
        }

        $feild = [
            // 'cem_id',
            // 'cem_area_id',
            // 'cem_row_id',
            'price',
            'material',
            'style',
            'model',
            'status',
            'length',
            'width',
            'acreage',
        ];
        $update = [];
        // $long_title = self::long_title($info['cem_id'], $info['cem_area_id'], $info['cem_row_id']);
        if (!empty($info['e_all']) && $info['e_all'] ) {
            foreach ($feild as $v) {

                $update[$v] = $info[$v];
            }
        } else {
            foreach ($feild as $v) {
                if (!empty($info['e_' . $v]) && $info['e_' . $v] ) {
                    $update[$v] = $info[$v];
                }
            }
        }
        // wcc($update);
        foreach ($info['ids'] as $id) {
            if (self::where('id', $id)->update($update) === false) {
                return RE_ERROR;
            }
        }

        return RE_SUCCESS;
    }

    static public function set_status ($id, $val) {

        if (self::where('id', $id)->update(['status' => $val]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function long_title ($cem_id, $area_id, $row_id) {
        $e = '';
        $e .= self::table('cem')->where('id', $cem_id)->value('title');
        $e .= '-';
        $e .= self::table('cem_area')->where('id', $area_id)->value('title');
        $e .= '-';
        $e .= self::table('cem_row')->where('id', $area_id)->value('title');
        $e .= '-';
        return $e;
    }

    static public function add ($info) {
        if (!(int)$info['cem_id']) {
            return ['status' => false, 'msg' => '请选择墓园'];
        }
        if (!(int)$info['cem_area_id']) {
            return ['status' => false, 'msg' => '请选择墓区'];
        }
        if (!(int)$info['cem_row_id']) {
            return ['status' => false, 'msg' => '请选择墓排'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['many_num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        $long_title = self::long_title($info['cem_id'], $info['cem_area_id'], $info['cem_row_id']);
        if ($info['type'] == 'one'  && self::insert([
                'title'          => $info['title'],
                'long_title'     => $long_title . $info['title'],
                'cem_id'         => $info['cem_id'],
                'cem_area_id'    => $info['cem_area_id'],
                'cem_row_id'     => $info['cem_row_id'],
                'style'          => $info['style'],
                'material'       => $info['material'],
                'model'          => $info['model'],
                'status'         => $info['status'],
                'length'         => $info['length'],
                'width'          => $info['width'],
                'acreage'        => $info['acreage'],
                'price'        => $info['price'],
                'create_time'    => dttm(),
                'create_by'    => session('id'),
            ]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['many_num']; $i++) {
                $data_list[] = [
                        'long_title'     => $long_title . $i . '号',
                        'title'          => $i . '号',
                        'cem_id'         => $info['cem_id'],
                        'cem_area_id'    => $info['cem_area_id'],
                        'cem_row_id'     => $info['cem_row_id'],
                        'style'          => $info['style'],
                        'material'       => $info['material'],
                        'model'          => $info['model'],
                        'status'         => $info['status'],
                        'length'         => $info['length'],
                        'width'          => $info['width'],
                        'acreage'        => $info['acreage'],
                        'price'        => $info['price'],
                        'create_time'    => dttm(),
                        'create_by'    => session('id'),
                    ];
            }
            if (count($data_list) && self::insertAll($data_list) !== false) {
                return RE_SUCCESS;
            }

        }
        return RE_ERROR;
    }


    public function long_name ($id) {
        $e =  self::alias('a')
            ->join('contacts b','a.contacts_id = b.id')
            ->where('a.id', $id)->find();
    }

    public function pay_status () {
        return ['未付款', '已付款'];
    }

}
