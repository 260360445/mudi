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
    static public function wlists ($map = []) {
        return self::alias('a')->join('contacts b','a.contacts_id = b.id','LEFT')->where($map)->column('*', 'id');
    }   
    static public function wlistt ($map = []) {
        return self::field('a.id,a.long_title,a.pay_status,a.sta,a.status,a.price,a.money,a.settime,a.starttime,a.endtime,a.mwnum,a.lnum,a.hnum,a.pay_sum_money,a.manage_money,a.manage_year,a.manage_sum_money,a.reserve_money,a.unpaid_money,a.pay_status,a.reserve_date,a.reserve_date,a.remind_date,a.update_by,a.beizhu,a.salesman,b.name,b.sex,b.idcard,b.tel,b.phone,b.postcode,b.address,b.workplace,b.email,b.relationship,d.dead_name')->alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where($map)->select();
    }
    //故者落幕登记
    static public function reserve_gzdj($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where(['a.id'=>$info['id']])->find();
        $html='';
        $html.='<div class="gztan" style="display:block;">';
             $html.='<div class="gztana">';
                 $html.='<form>';
                     $html.='<fieldset>';
                         $html.='<legend>故者落葬信息</legend>';
                         $html.='<div class="gztanb">';
                             $html.='<div class="gztanba">';
                                 $html.='<p>墓位全称：</p>';
                                 $html.='<input type="text" value="'.$arr['long_title'].'" disabled/>';
                             $html.='</div>';
                             $html.='<div class="gztanbb">';
                                 $html.='<p>证书编号：</p>';
                                 $html.='<input type="text" value="'.$arr['znum'].'" disabled/>';
                                 $html.='<i>*</i>';
                             $html.='</div>';
                             $html.='<div class="gztanbc">';
                                 $html.='<p>定购日期：</p>';
                                 $html.='<input type="text" value="'.date('Y-m-d',$arr['settime']).'" disabled/>';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztanc">';
                            $html.=' <div class="gztanca">';
                                 $html.='<p>故者姓名：</p>';
                                 $html.='<input type="text" value="'.$arr['dead_name'].'"/>';
                                 $html.='<i>*</i>';
                            $html.=' </div>';
                            $html.=' <div class="gztancb">';
                                 $html.='<p>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</p>';
                                 $html.='<select name="dead_sex" id="dead_sex">';
                                     $html.='<option value="2">男</option>';
                                     $html.='<option value="3">女</option>';
                                 $html.='</select>';
                                 $html.='<i>*</i>';
                             $html.='</div>';
                             $html.='<div class="gztancc">';
                                $html.=' <p>使用开始：</p>';
                                $html.='<input class="Wdate" name="starttime" type="text" onClick="WdatePicker()">';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztand">';
                             $html.='<div class="gztanda">';
                                 $html.='<p>工作单位：</p>';
                                 $html.='<input type="text" name="dead_work" id="dead_work"/>';
                             $html.='</div>';
                             $html.='<div class="gztandb">';
                                $html.=' <p>原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;籍：</p>';
                                 $html.='<input type="text" name="dead_address" id="dead_address"/>';
                             $html.='</div>';
                             $html.='<div class="gztandc">';
                                 $html.='<p>使用结束：</p>';
                                 $html.='<input class="Wdate" name="endtime" type="text" onClick="WdatePicker()">';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztane">';
                             $html.='<div class="gztanea">';
                                 $html.='<p>出生日期：</p>';
                                 $html.='<input class="Wdate" name="gstime" type="text" onClick="WdatePicker()">';
                                $html.=' <b>（公历）</b>';
                             $html.='</div>';
                             $html.='<div class="gztaneb">';
                                $html.=' <p>逝世日期：</p>';
                                $html.=' <input class="Wdate" name="gdtime" type="text" onClick="WdatePicker()">';
                                $html.=' <b>（公历）</b>';
                             $html.='</div>';
                             $html.='<div class="gztanec">';
                                 $html.='<p>落葬日期：</p>';
                                 $html.='<input class="Wdate" name="gltime" type="text" onClick="WdatePicker()">';
                                $html.=' <b>（公历）</b>';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztanf">';
                             $html.='<div class="gztanfa">';
                                 $html.='<p>出生日期：</p>';
                                 $html.='<input type="text" name="nstime"/>';
                                 $html.='<b>（农历）</b>';
                             $html.='</div>';
                             $html.='<div class="gztanfb">';
                                $html.=' <p>逝世日期：</p>';
                                $html.=' <input type="text" name="ndtime"/>';
                                $html.=' <b>（农历）</b>';
                             $html.='</div>';
                             $html.='<div class="gztanfc">';
                                 $html.='<p>落葬日期：</p>';
                                 $html.='<input type="text" name="nltime"/>';
                                 $html.='<b>（农历）</b>';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztang">';
                             $html.='<div class="gztanga">';
                                 $html.='<select>';
                                   $html.='  <option>只显示农历</option>';
                                   $html.='  <option>只显示公历</option>';
                                   $html.='  <option>都显示</option>';
                                   $html.='  <option>都不显示</option>';
                                 $html.='</select>';
                             $html.='</div>';
                             $html.='<div class="gztangb">';
                                $html.=' <input class="Wdate" name="jrtime" type="text" onClick="WdatePicker()">';
                                 $html.='<p>（农历数字，用于祭祀日提醒）</p>';
                             $html.='</div>';
                             $html.='<div class="gztangc">';
                                 $html.='<select>';
                                    $html.='  <option>只显示农历</option>';
                                   $html.='  <option>只显示公历</option>';
                                   $html.='  <option>都显示</option>';
                                   $html.='  <option>都不显示</option>';
                                 $html.='</select>';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gztanh">';
                            $html.=' <div class="gztanha">';
                                 $html.='<select>';
                                    $html.='  <option>只显示农历</option>';
                                   $html.='  <option>只显示公历</option>';
                                   $html.='  <option>都显示</option>';
                                   $html.='  <option>都不显示</option>';
                                $html.=' </select>';
                            $html.=' </div>';
                        $html.=' </div>';
                    $html.=' </fieldset>';
                 $html.='</form>';
             $html.='</div>';
             $html.='<div class="gztanj" style="margin-top:20px;">';
                $html.=' <div class="gztanjle">';
                    $html.=' <div class="gztanja">';
                        $html.=' <form>';
                            $html.=' <fieldset>';
                                $html.=' <legend>联系人信息</legend>';
                                $html.=' <div class="gztanjc">';
                                     $html.='<div class="gztanjca">';
                                     $html.='<p>联系人姓名：</p>';
                                        $html.=' <input type="text" value="贾永庆"/>';
                                         $html.='<i>*</i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjcb">';
                                         $html.='<p>故者关系：</p>';
                                         $html.='<select>';
                                             $html.='<option>其他</option>';
                                         $html.='</select>';
                                         $html.='<i>*</i>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjd">';
                                    $html.=' <div class="gztanjda">';
                                        $html.=' <p>身份证号：</p>';
                                        $html.=' <input type="text" value="23010219560123101x"/>';
                                        $html.=' <i>*</i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjdb">';
                                         $html.='<p>性别：</p>';
                                         $html.='<select>';
                                             $html.='<option>男</option>';
                                             $html.='<option>女</option>';
                                         $html.='</select>';
                                         $html.='<i>*</i>';
                                    $html.=' </div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanje">';
                                    $html.=' <div class="gztanjea">';
                                         $html.='<p>联系电话：</p>';
                                        $html.=' <input type="text" value="84655402"/>';
                                        $html.=' <i>*</i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjeb">';
                                         $html.='<p>手机：</p>';
                                        $html.=' <input type="text" value="13101662496"/>';
                                        $html.=' <i></i>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjf">';
                                     $html.='<div class="gztanjfa">';
                                         $html.='<p>电子邮件：</p>';
                                         $html.='<input type="text" />';
                                         $html.='<i></i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjfb">';
                                        $html.=' <p>邮政编码：</p>';
                                         $html.='<input type="text" value="150010"/>';
                                         $html.='<i>*</i>';
                                    $html.=' </div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjg">';
                                    $html.=' <div class="gztanjga">';
                                         $html.='<p>工作单位：</p>';
                                         $html.='<input type="text" />';
                                    $html.=' </div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjh">';
                                     $html.='<div class="gztanjha">';
                                         $html.='<p>家庭住址：</p>';
                                         $html.='<input type="text" />';
                                     $html.='</div>';
                                $html.=' </div>';
                             $html.='</fieldset>';
                         $html.='</form>';
                    $html.=' </div>';
                     $html.='<div class="gztanjb">';
                        $html.=' <form>';
                            $html.=' <fieldset>';
                               $html.='  <legend>操作提示</legend>';
                             $html.='</fieldset>';
                        $html.=' </form>';
                    $html.=' </div>';
                 $html.='</div>';
                 $html.='<div class="gztanjri">';
                     $html.='<form>';
                         $html.='<fieldset>';
                            $html.=' <legend>故者落葬操作信息</legend>';
                             $html.='<div class="gztanjria">';
                                  $html.='<p>业务员：</p>';
                                 $html.=' <input type="text" value="锁定王爽"/>';
                                 $html.=' <i>*</i>';
                            $html.=' </div>';
                             $html.='<div class="gztanjrib">';
                                 $html.=' <p>操作员：</p>';
                                 $html.=' <input type="text" value="锁定王爽"/>';
                                 $html.=' <i>*</i>';
                             $html.='</div>';
                            $html.=' <div class="gztanjric">';
                                  $html.=' <p>备注：</p>';
                                  $html.=' <textarea></textarea>';
                             $html.='</div>';
                             $html.='<div class="gztanjrid">';
                                $html.=' <div class="gztanjrida">保存</div>';
                                $html.=' <div class="gztanjridb">取消</div>';
                            $html.=' </div>';
                            $html.=' <div class="gztanjrie" onclick="sfz()">查看身份证扫描件</div>';
                            $html.=' <div class="gztanjrif">打印墓位档案表</div>';
                         $html.='</fieldset>';
                     $html.='</form>';
                 $html.='</div>';
             $html.='</div>';
        return $html;
    }
    //修改业务员
    static public function user_set($info){
        $arr=self::field('id,long_title')->where(['id'=>$info['id']])->find();
        $user=self::table('staff')->field('nickname')->where(['id'=>$info['uid']])->find();
        $staff=self::table('staff')->field('id,nickname')->select();
        $html='';
        $html.='<div class="whtan" style="display:block;width: 258px;height: 229px;">';
            $html.='<div class="whtane">';
               $html.=' <div class="whtaneri">';
                    $html.='<form>';
                       $html.='<fieldset>';
                           $html.=' <legend>业务员信息</legend>';
                           $html.='<div class="whtanyw">';
                                $html.='<p>墓位全称：</p>';
                               $html.=' <input type="text" value="'.$arr['long_title'].'" disabled/>';
                            $html.='</div>';
                            $html.='<div class="whtanyw">';
                                $html.='<p>原业务员：</p>';
                               $html.=' <input type="text" value="'.$user['nickname'].'" disabled/>';
                            $html.='</div>';
                            $html.='<div class="whtanyw">';
                               $html.=' <p>修改业务员：</p>';
                                $html.=' <select name="salesman" id="salesman">';/*staff*/
                                    foreach ($staff as $key => $value) {
                                        $html.=' <option value="'.$value['id'].'">'.$value['nickname'].'</option>';
                                    }
                                $html.=' </select>';
                            $html.='</div>';
                            $html.='<div class="whtanbc">';
                                $html.=' <button class="whtanbca" type="button" onclick="subuser('.$info['id'].')">保存</button>';
                                $html.='  <button class="whtanbcb" type="button" onclick="closeuser()">取消</button>';
                            $html.='</div>';
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
    static public function reserve_buyed($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->where(['a.id'=>$info['id']])->find();
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $cem_sty=_Tpl::tlist(2);//墓位样式 
        $html='';
        $html.='<div class="tanc" style="display:block">';
            $html.='<div class="tanf">';
                $html.='<form>';
                    $html.='<fieldset>';
                        $html.='<legend>墓位信息</legend>';
                        $html.='<div class="tanfsa">';
                            $html.='<p>您选择的是：'.$arr['long_title'].'|墓位样式：'.$cem_sty[$arr['style']]['title'].'</p>';
                            $html.='<div class="tanfsb">';
                                $html.='<div>墓位长：'.$arr['width'].'米</div>';
                                $html.='<div>墓位宽：'.$arr['length'].'米</div>';
                                $html.='<div>墓位面积：'.$arr['acreage'].'平方米</div>';
                                $html.='<div>墓位材质：'.$cem_mat[$arr['material']]['title'].'</div>';
                                $html.='<div>墓位状态：'.$cem_status[$arr['status']]['title'].'</div>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
                $html.='</form>';
            $html.='</div>';
            $html.='<div class="tang">';
                $html.='<form>';
                    $html.='<fieldset>';
                        $html.='<legend>墓位定购信息</legend>';
                        $html.='<div class="tanga">';
                           $html.=' <div class="tangb">';
                                $html.='<div>墓位费：'.$arr['money'].'元</div>';
                                $html.='<div>应付（已付）管理费总额：'.$arr['manage_sum_money'].'元</div>';
                                $html.='<div>应付（已付）款总额：'.$arr['pay_sum_money'].'元</div>';
                                $html.='<div>是否已交费：已付款</div>';
                                $html.='<div>使用开始日期：'.date('Y-m-d',$arr['starttime']).'</div>';
                            $html.='</div>';
                            $html.='<div class="tangc">';
                                $html.='<div>联系人：'.$arr['name'].'</div>';
                                $html.='<div>身份证：'.$arr['idcard'].'</div>';
                                $html.='<div>联系电话：'.$arr['tel'].'</div>';
                                $html.='<div>购墓日期：'.date('Y-m-d',$arr['settime']).'</div>';
                                $html.='<div>使用结束日期：'.date('Y-m-d',$arr['endtime']).'</div>';
                            $html.='</div>';
                            $html.='<div class="tangd">';
                                $html.='<div class="tanfgda">';
                                    $html.='<p>备注：</p>';
                                    $html.='<div onclick="subbeizhu()" style="cursor:pointer">保存备注</div>';
                                $html.='</div>';
                                $html.='<textarea id="beizhu">'.$arr['beizhu'].'</textarea>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</fieldset>';
                $html.='</form>';
           $html.=' </div>';
            $html.='<div class="tanh">';
                $html.='<div class="tanha">';
                   $html.=' <p>当前墓位已下葬故者：0条记录</p>';
                    $html.='<div>刷新故者信息</div>';
                    $html.='<div onclick="gzdj()">故者落葬登记</div>';
                    $html.='<div onclick="xjglf()">续交管理费</div>';
                    $html.='<div onclick="tuiding()">墓位退订</div>';
                    $html.='<div onclick="huanyuan()">墓位还原</div>';
                $html.='</div>';
                $html.='<div class="tanhb">';
                    $html.='<table class="table table-bordered">';
                      $html.='<thead>';
                        $html.='<tr>';
                         $html.=' <th>墓位证编号</th>';
                          $html.='<th>墓位全称</th>';
                         $html.=' <th>故者姓名</th>';
                         $html.=' <th>故者性别</th>';
                         $html.=' <th>出生日期（公历）</th>';
                          $html.='<th>出生日期（农历）</th>';
                          $html.='<th>原籍</th>';
                          $html.='<th>工作单位</th>';
                          $html.='<th>逝世日期（公历）</th>';
                          $html.='<th>逝世日期（农历）</th>';
                          $html.='<th>下葬日期（公历）</th>';
                          $html.='<th>下葬日期（公历）</th>';
                          $html.='<th>操作员姓名</th>';
                          $html.='<th>出生日期显示</th>';
                          $html.='<th>逝世日期显示</th>';
                          $html.='<th>下葬日期显示</th>';
                          $html.='<th>备注</th>';
                          $html.='<th>逝世日期（农历数字）</th>';
                          $html.='<th>落葬状态</th>';
                        $html.='</tr>';
                      $html.='</thead>';
                      $html.='<tbody>';
                        $html.='<tr>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                         $html.=' <td></td>';
                         $html.=' <td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                        $html.='</tr>';
                      $html.='</tbody>';
                    $html.='</table>';
                $html.='</div>';
            $html.='</div>';
            $html.='<div class="tank">';
                $html.='<div>打印购墓合同（正）</div>';
                $html.='<div>打印购墓合同（反）</div>';
                $html.=' <div>打印墓位档案表</div>';
                $html.='<div onclick="bwtc()">墓位碑文设置</div>';
                $html.='<div>打印墓位证（正）</div>';
                $html.='<div>打印墓位证（反）</div>';
                $html.='<div>打印墓位证（定购信息）</div>';
                $html.='<div>打印墓位证（落葬信息）</div>';
                $html.='<div>保存购物合同图片</div>';
                $html.='<div>墓位证计数</div>';
                $html.='<div>关闭本窗体</div>';
            $html.='</div>';
        $html.='</div>';

        return $html;
    }
    static public function reserve_bwtc($info){

        $html='';
        $html.='<div class="bwtan" style="display:block;width: 817px;min-height: 550px;margin-left: -402px;margin-top: -268px;">';
             $html.='<div class="bwtanul">';
                 $html.='<ul>';
                     $html.='<li class="bwon" id="liset1"><a href="#" onclick="tab1()">碑文参数设置</a></li>';
                     $html.='<li id="liset2"><a href="#" onclick="tab2()">碑文内容设置</a></li>';
                 $html.='</ul>';
             $html.='</div>';
             $html.='<div class="bwtancon">';
                 $html.='<div class="inner" id="tab1">';
                    $html.=' <div class="bwtana">';
                        $html.=' <form>';
                            $html.=' <fieldset>';
                                $html.=' <legend>墓位信息</legend>';
                                $html.=' <div class="bwtanb">';
                                     $html.='<p>您选择的是：天福园A区6排0030号 | 墓位样式：双人墓</p>';
                                     $html.='<div class="bwtanc">';
                                         $html.='<div>墓位长：0.87米</div>';
                                         $html.='<div>墓位宽：0.78米</div>';
                                         $html.='<div>墓位面积：0.6786平方</div>';
                                         $html.='<div>墓位材质：花岗岩</div>';
                                         $html.='<div>墓位状态：已定购</div>';
                                     $html.='</div>';
                                $html.=' </div>';
                            $html.=' </fieldset>';
                         $html.='</form>';
                     $html.='</div>';
                     $html.='<div class="bwtand">';
                         $html.='<form>';
                             $html.='<fieldset>';
                                 $html.='<legend>碑文分项参数设置</legend>';
                                 $html.='<div class="bwtane">';
                                     $html.='<div class="bwtanea">';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>刻字样式：</p>';
                                             $html.='<select>';
                                             $html.='    <option></option>';
                                             $html.='</select>';
                                        $html.='</div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>刻字样式：</p>';
                                             $html.='<select>';
                                                 $html.='<option></option>';
                                             $html.='</select>';
                                        $html.=' </div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>刻字样式：</p>';
                                             $html.='<select>';
                                                $html.=' <option></option>';
                                             $html.='</select>';
                                         $html.='</div>';
                                     $html.='</div>';
                                     $html.='<div class="bwtanea">';
                                         $html.='<div class="bwtanf">';
                                            $html.=' <p>刷金：</p>';
                                             $html.='<select>';
                                               $html.='  <option></option>';
                                            $html.=' </select>';
                                        $html.=' </div>';
                                        $html.=' <div class="bwtanf">';
                                             $html.='<p>贴金箔：</p>';
                                             $html.='<select>';
                                                $html.=' <option></option>';
                                             $html.='</select>';
                                         $html.='</div>';
                                     $html.='</div>';
                                     $html.='<div class="bwtanea">';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>瓷像数量：</p>';
                                             $html.='<select>';
                                               $html.='  <option></option>';
                                             $html.='</select>';
                                        $html.='</div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>瓷像颜色：</p>';
                                             $html.='<select>';
                                                $html.=' <option></option>';
                                            $html.=' </select>';
                                         $html.='</div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>瓷像尺寸：</p>';
                                             $html.='<select>';
                                                 $html.='<option></option>';
                                             $html.='</select>';
                                         $html.='</div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>瓷像形状：</p>';
                                            $html.=' <select>';
                                                $html.=' <option></option>';
                                            $html.=' </select>';
                                         $html.='</div>';
                                    $html.=' </div>';
                                    $html.=' <div class="bwtanea">';
                                       $html.='  <div class="bwtanf">';
                                           $html.='  <p>影雕数量：</p>';
                                            $html.='<select>';
                                                $html.=' <option></option>';
                                             $html.='</select>';
                                        $html.=' </div>';
                                         $html.='<div class="bwtanf">';
                                             $html.='<p>影雕形状：</p>';
                                             $html.='<select>';
                                                 $html.='<option></option>';
                                            $html.=' </select>';
                                         $html.='</div>';
                                     $html.='</div>';
                                 $html.='</div>';
                             $html.='</fieldset>';
                         $html.='</form>';
                    $html.='</div>';
                     $html.='<div class="bwtanbtn">';
                        $html.=' <div>修改碑文参数设置</div>';
                        $html.=' <div>保存碑文参数设置</div>';
                        $html.=' <div>取消本次设置</div>';
                     $html.='</div>';
               $html.=' </div>';

                 $html.='<div class="inner" id="tab2">';
                     $html.='<div class="bwtana">';
                         $html.='<form>';
                            $html.=' <fieldset>';
                                $html.=' <legend>墓位信息</legend>';
                                 $html.='<div class="bwtanb">';
                                    $html.=' <p>您选择的是：天福园A区6排0030号 | 墓位样式：双人墓1</p>';
                                     $html.='<div class="bwtanc">';
                                        $html.=' <div>墓位长：0.87米</div>';
                                        $html.=' <div>墓位宽：0.78米</div>';
                                         $html.='<div>墓位面积：0.6786平方</div>';
                                         $html.='<div>墓位材质：花岗岩</div>';
                                         $html.='<div>墓位状态：已定购</div>';
                                     $html.='</div>';
                                $html.=' </div>';
                            $html.=' </fieldset>';
                        $html.=' </form>';
                     $html.='</div>';
                    $html.=' <div class="bwtantable">';
                         $html.='<table class="table table-bordered">';
                          $html.=' <thead>';
                            $html.=' <tr>';
                            $html.='  <th>墓位证编号</th>';
                             $html.='  <th>墓位全称</th>';
                              $html.=' <th>故者姓名</th>';
                              $html.=' <th>故者性别</th>';
                              $html.=' <th>出生日期（公历）</th>';
                               $html.='<th>出生日期（农历）</th>';
                              $html.=' <th>原籍</th>';
                              $html.=' <th>工作单位</th>';
                              $html.=' <th>逝世日期（公历）</th>';
                              $html.=' <th>逝世日期（农历）</th>';
                              $html.=' <th>下葬日期（公历）</th>';
                              $html.=' <th>下葬日期（公历）</th>';
                              $html.=' <th>操作员姓名</th>';
                              $html.=' <th>出生日期显示</th>';
                              $html.=' <th>逝世日期显示</th>';
                              $html.=' <th>下葬日期显示</th>';
                              $html.=' <th>备注</th>';
                              $html.=' <th>逝世日期（农历数字）</th>';
                              $html.=' <th>落葬状态</th>';
                             $html.='</tr>';
                           $html.='</thead>';
                           $html.='<tbody>';
                             $html.='<tr>';
                              $html.=' <td></td>';
                              $html.='<td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                              $html.=' <td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                               $html.='<td></td>';
                            $html.=' </tr>';
                          $html.=' </tbody>';
                         $html.='</table>';
                     $html.='</div>';
                     $html.='<div class="bwtannr">';
                         $html.='<form>';
                            $html.=' <fieldset>';
                                $html.=' <legend>碑文内容设置</legend>';
                                $html.=' <div class="bwnra">';
                                     $html.='<div class="bwnraa">';
                                         $html.='<div class="bwnrab">';
                                            $html.=' <p>母姓名：</p>';
                                             $html.='<input type="text" />';
                                        $html.=' </div>';
                                         $html.='<div class="bwnrac">';
                                            $html.=' <p>父姓名：</p>';
                                            $html.=' <input type="text" />';
                                         $html.='</div>';
                                     $html.='</div>';
                                     $html.='<div class="bwnrad">';
                                        $html.=' <p>原籍：</p>';
                                        $html.=' <input type="text" />';
                                     $html.='</div>';
                                     $html.='<div class="bwnrae">';
                                         $html.='<p class="bwnrp"></p>';
                                         $html.='<p>年</p>';
                                         $html.='<p>月</p>';
                                        $html.=' <p>日</p>';
                                     $html.='</div>';
                                     $html.='<div class="bwnraf">';
                                         $html.='<p>安葬日期：</p>';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                     $html.='</div>';
                                     $html.='<div class="bwnrag">';
                                        $html.=' <p>背面碑文内容：</p>';
                                        $html.=' <textarea></textarea>';
                                    $html.=' </div>';
                                $html.=' </div>';
                                 $html.='<div class="bwnrb">';
                                     $html.='<div class="bwnrba">';
                                         $html.='<p class="bwnrbap"></p>';
                                         $html.='<p>年</p>';
                                         $html.='<p>月</p>';
                                         $html.='<p>日</p>';
                                     $html.='</div>';
                                     $html.='<div class="bwnrbb">';
                                        $html.='<p>母生于：</p>';
                                        $html.=' <input type="text" />';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                     $html.='</div>';
                                    $html.=' <div class="bwnrbb">';
                                         $html.='<p>母故于：</p>';
                                        $html.=' <input type="text" />';
                                        $html.=' <input type="text" />';
                                        $html.='<input type="text" />';
                                     $html.='</div>';
                                     $html.='<div class="bwnrbb">';
                                         $html.='<p>父生于：</p>';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                     $html.='</div>';
                                     $html.='<div class="bwnrbb">';
                                         $html.='<p>父故于：</p>';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                         $html.='<input type="text" />';
                                     $html.='</div>';
                                     $html.='<div class="bwnrbc">';
                                        $html.='<div class="bwnrbcle">';
                                          $html.=' <p>叩立：</p>';
                                          $html.=' <textarea></textarea>';
                                        $html.='</div>';
                                        $html.='<div class="bwnrbcri">';
                                          $html.=' <p>备注：</p>';
                                          $html.=' <textarea></textarea>';
                                        $html.='</div>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="bwnrc">';
                                     $html.='<div class="bwnrca" style="display: inline-flex;margin-left: 155px;">';
                                        $html.=' <div style="margin-right: 10px;">打印传统碑文登记表（正）</div>';
                                        $html.=' <div>打印传统碑文登记表（反）</div>';
                                     $html.='</div>';
                                    $html.=' <div class="bwnrca" style="display: inline-flex;margin-left: 155px;">';
                                         $html.='<div style="margin-right: 10px;">打印现代碑文登记表（正）</div>';
                                         $html.='<div>打印现代碑文登记表（反）</div>';
                                     $html.='</div>';
                                     $html.='<div class="bwnrca" style="display: inline-flex;margin-left: 155px;">';
                                         $html.='<div style="margin-right: 10px;">保存碑文内容</div>';
                                        $html.=' <div onclick="setbeiwen()">填写碑文杂费单</div>';
                                    $html.=' </div>';
                                 $html.='</div>';
                             $html.='</fieldset>';
                        $html.=' </form>';
                     $html.='</div>';
                 $html.='</div>';
             $html.='</div>';
        $html.=' </div>';
        return $html;
    }
    static public function reserve_jsdtc($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->where(['a.id'=>$info['id']])->find();
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $cem_sty=_Tpl::tlist(2);//墓位样式 
        $html='';
        $html.='<div class="jsdtan" style="display:block;">';
                $html.='<div class="jsdtana">';
                    $html.='<form>';
                        $html.='<fieldset>';
                            $html.='<legend>墓位信息</legend>';
                            $html.='<div class="tanfsa">';
                                $html.='<p>您选择的是：'.$arr['long_title'].'|墓位样式：'.$cem_sty[$arr['style']]['title'].'</p>';
                                $html.='<div class="tanfsb">';
                                    $html.='<div>墓位长：'.$arr['width'].'米</div>';
                                    $html.='<div>墓位宽：'.$arr['length'].'米</div>';
                                    $html.='<div>墓位面积：'.$arr['acreage'].'平方米</div>';
                                    $html.='<div>墓位材质：'.$cem_mat[$arr['material']]['title'].'</div>';
                                    $html.='<div>墓位状态：'.$cem_status[$arr['status']]['title'].'</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="jsdtantable">';
                $html.='<table class="table table-bordered">';
                      $html.='<thead>';
                        $html.='<tr>';
                          $html.='<th>碑文计算单编号</th>';
                          $html.='<th>是否已付款</th>';
                          $html.='<th>刻字金额</th>';
                          $html.='<th>贴金箔金额</th>';
                          $html.='<th>瓷像数量</th>';
                          $html.='<th>瓷像费用</th>';
                          $html.='<th>封门立碑</th>';
                          $html.='<th>封门立碑费用</th>';
                          $html.='<th>家族台阶数</th>';
                          $html.='<th>家族台阶费用</th>';
                          $html.='<th>装饰材料费用</th>';
                          $html.='<th>不干胶费用</th>';
                          $html.='<th>费用总计</th>';
                          $html.='<th>杂费设置日期</th>';
                          $html.='<th>备注</th>';
                        $html.='</tr>';
                      $html.='</thead>';
                      $html.='<tbody>';
                        $html.='<tr>';
                          $html.='<td>2</td>';
                          $html.='<td>已付款</td>';
                          $html.='<td>367</td>';
                          $html.='<td>0</td>';
                          $html.='<td>单人</td>';
                          $html.='<td>0</td>';
                          $html.='<td>首次</td>';
                          $html.='<td>50</td>';
                          $html.='<td>0</td>';
                          $html.='<td>0</td>';
                          $html.='<td></td>';
                          $html.='<td></td>';
                          $html.='<td>417</td>';
                          $html.='<td>2010-01-21...</td>';
                          $html.='<td></td>';
                        $html.='</tr>';
                      $html.='</tbody>';
                    $html.='</table>';
                $html.='</div>';
                $html.='<div class="jsdtanf">';
                   $html.=' <div class="jsdtanfle">';
                        $html.='<form>';
                            $html.='<fieldset>';
                                $html.='<legend>碑文费用计算单</legend>';
                                $html.='<div class="jsdtans">';
                                    $html.='<div class="jsdsa">';
                                        $html.='<p>收费项目</p>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsb">';
                                        $html.='<p>数量</p>';
                                        $html.='<div class="jsdsbc">';
                                            $html.='<div class="jsdsba">';
                                                $html.='<p>特大字</p>';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                            $html.='<div class="jsdsba">';
                                                $html.='<p>大字</p>';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                            $html.='<div class="jsdsba">';
                                                $html.='<p>中字</p>';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                            $html.='<div class="jsdsba">';
                                                $html.='<p>小字</p>';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsc">';
                                        $html.='<p>单价</p>';
                                        $html.='<div class="jsdsca">';
                                            $html.='<div class="jsdscb">';
                                                $html.='<p>刻字单价（元/字）</p>';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                               $html.=' <input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                            $html.='<div class="jsdscd">';
                                                $html.='<p>贴金箔单价（元/字）</p>';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsd">';
                                        $html.='<p>金额</p>';
                                       $html.=' <div class="jsdsca">';
                                            $html.='<div class="jsdscb">';
                                                $html.='<p>刻字金额</p>';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                               $html.=' <input type="text" value="0">';
                                               $html.=' <input type="text" value="0">';
                                            $html.='</div>';
                                            $html.='<div class="jsdscd">';
                                               $html.=' <p>贴金箔金额</p>';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                                $html.='<input type="text" value="0">';
                                            $html.='</div>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="jsdse">';
                                        $html.='<p>备注</p>';
                                        $html.='<textarea></textarea>  ';                             
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="jsdxj">';
                                    $html.='<p>小计</p>';
                                    $html.='<input type="text" value="0">';
                                    $html.='<input type="text" value="0">';
                                $html.='</div>';
                                $html.='<div class="jsdtansn">';
                                    $html.='<div class="jsdsan">';
                                        $html.='<input type="checkbox"><label>瓷像</label>';
                                    $html.='</div>';
                                   $html.=' <div class="jsdsbn">';
                                        $html.='<div class="jsdsbnle">';
                                         $html.='   <p>单人</p>';
                                         $html.='   <p>双人</p>';
                                        $html.='</div>';
                                        $html.='<div class="jsdsbnri">';
                                          $html.='  <input type="radio">';
                                          $html.='  <input type="radio">';
                                        $html.='</div>';
                                        
                                    $html.='</div>';
                                    $html.='<div class="jsdscn">';
                                        $html.='<input type="text" value="0">';
                                        $html.='<input type="text" value="0"> ';                                  
                                    $html.='</div>';
                                    $html.='<div class="jsdsdn">';
                                        $html.='<input type="text" value="0">';
                                        $html.='<input type="text" value="0">';                                       
                                   $html.=' </div>';
                                    $html.='<div class="jsdsen">';
                                        $html.='<textarea></textarea> ';                  
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="jsdtansn">';
                                   $html.=' <div class="jsdsan">';
                                        $html.='<input type="checkbox"><label>封门立碑</label>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsbn">';
                                       $html.=' <div class="jsdsbnle">';
                                            $html.='<p>首次</p>';
                                            $html.='<p>二次</p>';
                                        $html.='</div>';
                                        $html.='<div class="jsdsbnri">';
                                            $html.='<input type="radio">';
                                            $html.='<input type="radio">';
                                        $html.='</div>';
                                        
                                    $html.='</div>';
                                    $html.='<div class="jsdscn">';
                                        $html.='<input type="text" value="0">';
                                        $html.='<input type="text" value="0"> ';                                  
                                    $html.='</div>';
                                    $html.='<div class="jsdsdn">';
                                       $html.=' <input type="text" value="0">';
                                        $html.='<input type="text" value="0">';                                       
                                    $html.='</div>';
                                    $html.='<div class="jsdsen">';
                                       $html.=' <textarea></textarea>  ';                 
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="jsdtansn">';
                                    $html.='<div class="jsdsan">';
                                        $html.='<input type="checkbox"><label>家族台阶</label>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsbn">';
                                       $html.=' <div class="jsdsbnle">';
                                        $html.='</div>';
                                       $html.=' <div class="jsdsbnri">';
                                          $html.='  <input type="text" value="0">  '; 
                                        $html.='</div>';
                                        
                                    $html.='</div>';
                                    $html.='<div class="jsdscn">';
                                        $html.='<input type="text" value="0"> ';                                                                          
                                    $html.='</div>';
                                    $html.='<div class="jsdsdn">';
                                       $html.=' <input type="text" value="0"> ';                                                                      
                                    $html.='</div>';
                                    $html.='<div class="jsdsen">';
                                        $html.='<textarea class="jztjtext"></textarea>   ';               
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="jsdtansn">';
                                    $html.='<div class="jsdsan">';
                                       $html.=' <input type="checkbox"><label>墓穴装饰</label>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsbn">';
                                        $html.='<div class="jsdsbnle">';
                                            $html.='<p>花岗岩</p>';
                                            $html.='<p>黑理石</p>';
                                       $html.=' </div>';
                                        $html.='<div class="jsdsbnri">';
                                           $html.=' <input type="radio">';
                                            $html.='<input type="radio">';
                                        $html.='</div>';
                                        
                                    $html.='</div>';
                                    $html.='<div class="jsdscn">';
                                        $html.='<input type="text" value="0">';
                                       $html.=' <input type="text" value="0"> ';                                  
                                    $html.='</div>';
                                    $html.='<div class="jsdsdn">';
                                        $html.='<input type="text" value="0">';
                                        $html.='<input type="text" value="0"> ';                                      
                                    $html.='</div>';
                                    $html.='<div class="jsdsen">';
                                        $html.='<textarea></textarea>   ';                
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="jsdtansn">';
                                    $html.='<div class="jsdsan">';
                                        $html.='<input type="checkbox"><label>不干胶</label>';
                                    $html.='</div>';
                                    $html.='<div class="jsdsbn">';
                                       $html.=' <div class="jsdsbnle">';
                                            $html.='<p>单人</p>';
                                           $html.=' <p>双人</p>';
                                        $html.='</div>';
                                        $html.='<div class="jsdsbnri">';
                                           $html.=' <input type="radio">';
                                            $html.='<input type="radio">';
                                        $html.='</div>';
                                        
                                    $html.='</div>';
                                    $html.='<div class="jsdscn">';
                                       $html.=' <input type="text" value="0">';
                                        $html.='<input type="text" value="0"> ';                                  
                                    $html.='</div>';
                                    $html.='<div class="jsdsdn">';
                                        $html.='<input type="text" value="0">';
                                        $html.='<input type="text" value="0"> ';                                      
                                    $html.='</div>';
                                    $html.='<div class="jsdsen">';
                                        $html.='<textarea></textarea>  ';                 
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="hjtan">';
                                    $html.='<div class="hjtana">合计金额</div>';
                                    $html.='<div class="hjtanb">';
                                        $html.='<p>小写：</p>';
                                       $html.=' <input type="text">';
                                    $html.='</div>';
                                    $html.='<div class="hjtanb">';
                                        $html.='<p>人民币大写：</p>';
                                        $html.='<input type="text">';
                                    $html.='</div>';
                               $html.=' </div>';
                            $html.='</fieldset>';
                        $html.='</form>';
                    $html.='</div>';
                    $html.='<div class="jsdtanfri">';
                        $html.='<div class="jsdanfria">保存碑文费用计算单</div>';
                        $html.='<div class="jsdanfria">打印碑文费用计算单</div>';
                    $html.='</div>';
                $html.='</div>';
           $html.='</div>';
        return $html;
    }
    static public  function select_buy_type_yu($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where(['a.id'=>$info['id']])->find();
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $cem_sty=_Tpl::tlist(2);//墓位样式 
        $html='';
        $html.='<div class="zftan" style="display: block;">';
                $html.='<div class="tanfq">';
                    $html.='<form>';
                        $html.='<fieldset>';
                            $html.='<legend>墓位信息</legend>';
                            $html.='<div class="tanfsa">';
                                $html.='<p>您选择的是：'.$arr['long_title'].'|墓位样式：'.$cem_sty[$arr['style']]['title'].'</p>';
                                $html.='<div class="tanfsb">';
                                    $html.='<div>墓位长：'.$arr['width'].'米</div>';
                                    $html.='<div>墓位宽：'.$arr['length'].'米</div>';
                                    $html.='<div>墓位面积：'.$arr['acreage'].'平方米</div>';
                                    $html.='<div>墓位材质：'.$cem_mat[$arr['material']]['title'].'</div>';
                                    $html.='<div>墓位状态：'.$cem_status[$arr['status']]['title'].'</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="zftant">';
                   $html.=' <div class="zftanle">';
                       $html.=' <form>';
                            $html.='<fieldset>';
                                $html.='<legend>墓位定购信息</legend>';
                               $html.=' <div class="zftanlea">';
                                   $html.=' <div>联系人：'.$arr['name'].'</div>';
                                   $html.=' <div>故者姓名：'.$arr['dead_name'].'</div>';
                                   $html.=' <div>联系电话：'.$arr['tel'].'</div>';
                                $html.='</div>';
                                $html.='<div class="zftanlea">';
                                   $html.=' <div>墓位原价：'.$arr['price'].'元</div>';
                                   $html.=' <div>成交价格：'.$arr['money'].'元</div>';
                                   $html.=' <div>应付（已付）款总额：'.$arr['pay_sum_money'].'元</div>';
                                   $html.=' <div>应付（已付）管理费总额：'.$arr['manage_sum_money'].'元</div>';
                                   $html.=' <div>是否已付费：已付款</div>';
                                $html.='</div>';
                                $html.='<div class="zftanlea">';
                                    $html.='<div>购墓日期：'.date('Y-m-d',$arr['settime']).'</div>';
                                    $html.='<div>使用开始：'.date('Y-m-d',$arr['starttime']).'</div>';
                                    $html.='<div>使用结束：'.date('Y-m-d',$arr['endtime']).'</div>';                             
                                $html.='</div>';
                            $html.='</fieldset>';
                        $html.='</form>';
                    $html.='</div>';
                    $html.='<div class="zftanri">';
                        $html.='<form>';
                            $html.='<fieldset>';
                                $html.='<legend>票据信息</legend>';
                                $html.='<div class="zftanria">';
                                    $html.='<div class="zftanrib">';
                                        $html.='<p>收费金额：</p>';
                                        $html.='<input type="text">';
                                        $html.='<button type="button" onclick="jsdtc()" class="zftank">查看以往碑文计算单</button>';
                                    $html.='</div>';
                                    $html.='<div class="zftanric">';
                                       $html.=' <p>开票日期：</p>';
                                        $html.='<div class="zftanrica" style="margin-left:9px;">';
                                            $html.='<input class="Wdate" name="settime" value="'.date('Y-m-d',time()).'" type="text" onClick="WdatePicker()" style="width: 141px;">';
                                            $html.='<input type="radio" name="chetime" value="1" checked style="margin-left:18px;">今天';
                                            $html.='<input type="radio" name="chetime" value="2">定购日期';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="zftanrid">';
                                        $html.='<div class="zftanrida">';
                                            $html.='<p>刻字：</p>';
                                            $html.='<select name="kezi" id="kezi">';
                                               $html.=' <option value="2">是</option>';
                                               $html.=' <option value="3">否</option>';
                                            $html.='</select>';
                                        $html.='</div>';
                                        $html.='<div class="zftanridb">';
                                            $html.='<p>立碑封门：</p>';
                                            $html.='<select name="fengmen" id="fengmen">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                            $html.='</select>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="zftanrid">';
                                        $html.='<div class="zftanrida">';
                                           $html.=' <p>贴金箔：</p>';
                                            $html.='<select name="jinbo" id="jinbo">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                            $html.='</select>';
                                        $html.='</div>';
                                        $html.='<div class="zftanridb">';
                                           $html.=' <p>家族台阶：</p>';
                                            $html.='<select name="taijie" id="taijie">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                           $html.=' </select>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="zftanrid">';
                                        $html.='<div class="zftanrida">';
                                            $html.='<p>瓷像：</p>';
                                            $html.='<select name="cixiang" id="cixiang">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                            $html.='</select>';
                                        $html.='</div>';
                                        $html.='<div class="zftanridb">';
                                           $html.=' <p>墓穴装饰：</p>';
                                            $html.='<select name="zhaungshi" id="zhaungshi">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                           $html.=' </select>';
                                       $html.=' </div>';
                                    $html.='</div>';
                                    $html.='<div class="zftanrid">';
                                        $html.='<div class="zftanrida">';
                                           $html.=' <p>不干胶：</p>';
                                           $html.=' <select name="bzj" id="bzj">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                           $html.=' </select>';
                                        $html.='</div>';
                                        $html.='<div class="zftanridb">';
                                            $html.='<p>礼仪服务：</p>';
                                            $html.='<select name="liyi" id="liyi">';
                                                $html.=' <option value="2">是</option>';
                                                $html.=' <option value="3">否</option>';
                                            $html.='</select>';
                                        $html.='</div>';
                                    $html.='</div>';
                                   $html.=' <div class="zftanbz">';
                                       $html.=' <p>备注：</p>';
                                        $html.='<div class="beizhu">';
                                           $html.=' <textarea></textarea>';
                                            $html.='<div class="bzmore">';
                                               $html.='<button type="button" onclick="subzf('.$info['id'].')" class="bzmorea">保存</button>';
                                               $html.='<button type="button" onclick="closezf()" class="bzmoreb">取消</button>';
                                            $html.='</div>';
                                        $html.='</div>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</fieldset>';
                        $html.='</form>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="zftancz">';
                   $html.=' <form>';
                       $html.=' <fieldset>';
                          $html.=' <legend>操作提示</legend>';
                       $html.=' </fieldset>';
                   $html.=' </form>';
                $html.='</div>';
            $html.='</div>';
        return $html;   
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
    //续交管理费
    static public function reserve_xjglf($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('dead d','a.id = d.cem_info_id')->where(['a.id'=>$info['id']])->find();
        $user = self::table('staff')->field('id,nickname')->where(['id'=>$arr['salesman']])->find();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $html='';
        $html.='<div class="xjglftan" style="display:block;height: 353px;margin-top: -176px;">';
            $html.=' <div class="gztana">';
                 $html.='<form>';
                     $html.='<fieldset>';
                         $html.='<legend>墓位定购信息</legend>';
                         $html.='<div class="gltana">';
                             $html.='<div class="gltanaa">';
                                 $html.='<p>墓位全称：</p>';
                                 $html.='<input type="text" value="'.$arr['long_title'].'" disabled/><input type="hidden" value="'.$info['id'].'" id="xujiaoid"/>';
                             $html.='</div>';
                             $html.='<div class="gltanab">';
                             $html.='    <p>墓位费：</p>';
                                $html.=' <input type="text" value="'.$arr['money'].'" disabled/>';
                             $html.='</div>';
                             $html.='<div class="gltanac">';
                                 $html.='<p>定购日期：</p>';
                                 $html.='<input value="'.date('Y-m-d',$arr['settime']).'" type="text" disabled>';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gltanb">';
                             $html.='<div class="gltanba">';
                                 $html.='<p>已付管理费总额：</p>';
                                 $html.='<input type="text" value="'.$arr['manage_sum_money'].'" disabled/>';
                             $html.='</div>';
                             $html.='<div class="gltanbb">';
                                $html.=' <p>已付款总额：</p>';
                                 $html.='<input type="text" value="'.$arr['pay_sum_money'].'" disabled/>';
                             $html.='</div>';
                             $html.='<div class="gltanbc">';
                                 $html.='<p>使用开始：</p>';
                                 $html.='<input class="Wdate" name="starttime" type="text" onClick="WdatePicker()">';
                             $html.='</div>';
                         $html.='</div>';
                         $html.='<div class="gltanc">';
                             $html.='<div class="gltanca">';
                                 $html.='<p>管理费到期时间：</p>';
                                 $html.='<input type="text" value="'.date('Y-m-d',$arr['manage_time']).'" disabled/>';
                             $html.='</div>';
                             $html.='<div class="gltancb">';
                                $html.='<p>本次续交：</p>';
                                $html.='<input type="text" class="gltancba" name="manage_money" id="manage_money" onblur="glmone()">';
                                $html.=' <em>X</em>';
                                $html.='<input type="text" class="gltancbb" name="manage_year" id="manage_year" onchange="glmtwo()">';
                                $html.='<b>年=</b>';
                                $html.='<input type="text" class="gltancbc" name="manage_sum_money" id="manage_sum_money" disabled>';
                             $html.='</div>';
                             $html.='<div class="gltancc">';
                                 $html.='<p>使用结束：</p>';
                                 $html.='<input class="Wdate" name="endtime" type="text" onClick="WdatePicker()">';
                             $html.='</div>';
                         $html.='</div>';
                     $html.='</fieldset>';
                $html.='</form>';
             $html.='</div>';
             $html.='<div class="gztanj" style="margin-top:20px;">';
                 $html.='<div class="gztanjle">';
                     $html.='<div class="gztanja">';
                         $html.='<form>';
                             $html.='<fieldset>';
                                 $html.='<legend>联系人信息</legend>';
                                 $html.='<div class="gztanjc">';
                                     $html.='<div class="gztanjca">';
                                         $html.='<p>联系人姓名：</p>';
                                         $html.='<input type="text" value="'.$arr['name'].'" disabled/>';
                                         $html.='<i>*</i>';
                                     $html.='</div>';
                                    $html.=' <div class="gztanjcb">';
                                         $html.='<p>故者关系：</p>';
                                         $html.='<select disabled>';
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
                                 $html.='</div>';
                                 $html.='<div class="gztanjd">';
                                     $html.='<div class="gztanjda">';
                                         $html.='<p>身份证号：</p>';
                                         $html.='<input type="text" value="'.$arr['idcard'].'" disabled/>';
                                        $html.=' <i>*</i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjdb">';
                                         $html.='<p>性别：</p>';
                                         $html.='<select disabled>';
                                         if($arr['sex']==1){
                                            $html.=' <option>男</option>';
                                         }else{
                                            $html.=' <option>女</option>';
                                         }
                                         $html.='</select>';
                                         $html.='<i>*</i>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanje">';
                                     $html.='<div class="gztanjea">';
                                         $html.='<p>联系电话：</p>';
                                         $html.='<input type="text" value="'.$arr['tel'].'" disabled/>';
                                         $html.='<i>*</i>';
                                     $html.='</div>';
                                     $html.='<div class="gztanjeb">';
                                         $html.='<p>手机：</p>';
                                         $html.='<input type="text" value="'.$arr['phone'].'" disabled/>';
                                        $html.=' <i></i>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjg">';
                                     $html.='<div class="gztanjga">';
                                         $html.='<p>工作单位：</p>';
                                         $html.='<input type="text" type="'.$arr['workplace'].'" disabled />';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjgs">';
                                     $html.='<div class="gztanjgas">';
                                         $html.='<p>电子邮件：</p>';
                                         $html.='<input type="text" type="'.$arr['email'].'"  disabled/>';
                                     $html.='</div>';
                                 $html.='</div>';
                                 $html.='<div class="gztanjh">';
                                     $html.='<div class="gztanjha">';
                                        $html.=' <p>家庭住址：</p>';
                                         $html.='<input type="text" value="'.$arr['address'].'" disabled/>';
                                     $html.='</div>';
                                 $html.='</div>';
                             $html.='</fieldset>';
                         $html.='</form>';
                     $html.='</div>';
                 $html.='</div>';
                 $html.='<div class="gztanjri">';
                     $html.='<form>';
                        $html.=' <fieldset>';
                             $html.='<legend>故者落葬操作信息</legend>';
                             $html.='<div class="gztanjria">';
                                  $html.='<p>业务员：</p>';
                                 $html.=' <input type="text" value="'.$user['nickname'].'" disabled/>';
                                 $html.=' <i>*</i>';
                             $html.='</div>';
                             $html.='<div class="gztanjric">';
                                  $html.=' <p>备注：</p>';
                                  $html.=' <textarea disabled>'.$arr['beizhu'].'</textarea>';
                             $html.='</div>';
                             $html.='<div class="gztanjrid">';
                                 $html.='<div class="gztanjrida" onclick="setxujiao()">保存</div>';
                                 $html.='<div class="gztanjridb" onclick="closexujiao()">取消</div>';
                            $html.=' </div>';
                        $html.='</fieldset>';
                    $html.=' </form>';
                 $html.='</div>';
             $html.='</div>';
             $html.='<div class="gztani">';
                 $html.='<form>';
                    $html.=' <fieldset>';
                        $html.=' <legend>操作提示</legend>';
                    $html.=' </fieldset>';
                 $html.='</form>';
             $html.='</div>';
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
                                      $html.=' <p>故者姓名：</p>';
                                      $html.=' <input type="text" name="dead_name" value="'.$arr['dead_name'].'" />';
                                       $html.='<i></i>';
                                    $html.='</div>';    
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
                                      $html.=' <p>故者姓名：</p>';
                                      $html.=' <input type="text" name="dead_name" />';
                                       $html.='<i></i>';
                                    $html.='</div>';  
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
    static public function set_huanyuan($info){
        if (self::where('id', $info['id'])->update(['pay_sum_money'=>'','manage_money'=>'','pay_status'=>0,'status'=>38,'update_by'=>'','update_time'=>'','contacts_id'=>0,'reserve_date'=>'','remind_date'=>'','reserve_money'=>'0.00','unpaid_money'=>'','salesman'=>'','remarks'=>'','sta'=>3,'money'=>'0.00','beizhu'=>'','manage_year'=>'','manage_sum_money'=>'0.00','settime'=>'','starttime'=>'','endtime'=>'','mwnum'=>'','lnum'=>'','hnum'=>'']) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function set_beizhu($info){
        if (self::where('id', $info['id'])->update(['beizhu'=>$info['beizhu']]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    //续交管理费
    static public function reserve_xujiao_set($info){
        $arr=self::field('manage_money,manage_year,starttime,endtime,manage_time,manage_sum_money')->where(['id'=>$info['eid']])->find();
        $today=$arr['manage_year']+$info['manage_year'];
        $data['manage_money']=$arr['manage_money']+$info['manage_money'];
        $data['manage_sum_money']=$info['manage_money']+$info['manage_money'];
        $data['manage_year']=$today;
        $data['starttime']=strtotime($info['starttime']);
        $data['endtime']=strtotime($info['endtime']);
        $data['manage_time']= time()+3600*8+3600*24*36*$today;//比如5天前的时间
        if (self::where('id', $info['eid'])->update($data) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function sselect_user_list_tab_one_time($arra){
        if($arra['type'] == 'one'){
            $html='';
            if($arra['starttime']!='' && $arra['endtime']!=''){
                $arr=self::field('id,long_title,settime,starttime,endtime,money,manage_sum_money')->where('salesman='.$arra['cem'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->select();
                $nickname=self::table('staff')->field('nickname')->where(['id'=>$arra['cem']])->find();
                foreach ($arr as $key => $v) {
                    $html.='<tr class="trtr">';
                        $html.='<td>1</td>';
                        $html.='<td>'.$v['long_title'].'</td>';
                        $html.='<td>'.date('Y-m-d',$v['settime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['starttime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['endtime']).'</td>';
                        $html.='<td>'.$v['money'].'</td>';
                        $html.='<td>'.$v['manage_sum_money'].'</td>';
                        $sum=$v['money']+$v['manage_sum_money'];
                        $html.='<td>'.$sum.'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']!='' && $arra['endtime']==''){
                $arr=self::field('id,long_title,settime,starttime,endtime,money,manage_sum_money')->where('salesman='.$arra['cem'].' and status=44 and settime>='.strtotime($arra['starttime']))->select();
                $nickname=self::table('staff')->field('nickname')->where(['id'=>$arra['cem']])->find();
                foreach ($arr as $key => $v) {
                    $html.='<tr class="trtr">';
                        $html.='<td>1</td>';
                        $html.='<td>'.$v['long_title'].'</td>';
                        $html.='<td>'.date('Y-m-d',$v['settime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['starttime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['endtime']).'</td>';
                        $html.='<td>'.$v['money'].'</td>';
                        $html.='<td>'.$v['manage_sum_money'].'</td>';
                        $sum=$v['money']+$v['manage_sum_money'];
                        $html.='<td>'.$sum.'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']=='' && $arra['endtime']!=''){
               $arr=self::field('id,long_title,settime,starttime,endtime,money,manage_sum_money')->where('salesman='.$arra['cem'].' and status=44 and settime<='.strtotime($arra['endtime']))->select();
                $nickname=self::table('staff')->field('nickname')->where(['id'=>$arra['cem']])->find();
                foreach ($arr as $key => $v) {
                    $html.='<tr class="trtr">';
                        $html.='<td>1</td>';
                        $html.='<td>'.$v['long_title'].'</td>';
                        $html.='<td>'.date('Y-m-d',$v['settime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['starttime']).'</td>';
                        $html.='<td>'.date('Y-m-d',$v['endtime']).'</td>';
                        $html.='<td>'.$v['money'].'</td>';
                        $html.='<td>'.$v['manage_sum_money'].'</td>';
                        $sum=$v['money']+$v['manage_sum_money'];
                        $html.='<td>'.$sum.'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                    $html.='</tr>';
                }     
            }
            return $html;
        }
    }
    //墓位销售员业绩统计-个人  没有时间
    static public function select_user_list_tab_one($arra){
        if($arra['type'] == 'one'){
            $html='';
            $arr=self::field('id,long_title,settime,starttime,endtime,money,manage_sum_money')->where(['salesman'=>$arra['cem'],'status'=>44])->select();
            $nickname=self::table('staff')->field('nickname')->where(['id'=>$arra['cem']])->find();
            foreach ($arr as $key => $v) {
                $html.='<tr class="trtr">';
                    $html.='<td>1</td>';
                    $html.='<td>'.$v['long_title'].'</td>';
                    $html.='<td>'.date('Y-m-d',$v['settime']).'</td>';
                    $html.='<td>'.date('Y-m-d',$v['starttime']).'</td>';
                    $html.='<td>'.date('Y-m-d',$v['endtime']).'</td>';
                    $html.='<td>'.$v['money'].'</td>';
                    $html.='<td>'.$v['manage_sum_money'].'</td>';
                    $sum=$v['money']+$v['manage_sum_money'];
                    $html.='<td>'.$sum.'</td>';
                    $html.='<td>'.$nickname['nickname'].'</td>';
                $html.='</tr>';
            }
            return $html;
        }
    }
    //墓位销售员业绩统计-全部 有时间
    static public function select_user_list_all_time($arra){
         if($arra['id'] == 'all'){
            $html='';
            if($arra['starttime']!='' && $arra['endtime']!=''){
                $arr=self::table('staff')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->count();
                    $money=self::field('sum(money)')->where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->select();
                    $manage_sum_money=self::field('sum(manage_sum_money)')->where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->select();
                    $nickname=self::table('staff')->field('nickname')->where(['id'=>$info['id']])->find();
                    if($money[0]['sum(money)'] != null){//墓位费 合计
                        $price=$money[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($manage_sum_money[0]['sum(manage_sum_money)'] != null){//管理费 合计
                        $money=$manage_sum_money[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;//收入
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']!='' && $arra['endtime']==''){
                $arr=self::table('staff')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->count();
                    $money=self::field('sum(money)')->where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->select();
                    $manage_sum_money=self::field('sum(manage_sum_money)')->where('salesman='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->select();
                    $nickname=self::table('staff')->field('nickname')->where(['id'=>$info['id']])->find();
                    if($money[0]['sum(money)'] != null){//墓位费 合计
                        $price=$money[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($manage_sum_money[0]['sum(manage_sum_money)'] != null){//管理费 合计
                        $money=$manage_sum_money[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;//收入
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']=='' && $arra['endtime']!=''){
                $arr=self::table('staff')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('salesman='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->count();
                    $money=self::field('sum(money)')->where('salesman='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->select();
                    $manage_sum_money=self::field('sum(manage_sum_money)')->where('salesman='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->select();
                    $nickname=self::table('staff')->field('nickname')->where(['id'=>$info['id']])->find();
                    if($money[0]['sum(money)'] != null){//墓位费 合计
                        $price=$money[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($manage_sum_money[0]['sum(manage_sum_money)'] != null){//管理费 合计
                        $money=$manage_sum_money[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;//收入
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$nickname['nickname'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }
           
            return $html;
        }
    }
    //墓位销售员业绩统计-全部 没有时间
    static public function select_user_list_all($arra){
         if($arra['id'] == 'all'){
            $html='';
            $arr=self::table('staff')->select();
            foreach ($arr as $key => $info) {
                $data['count']=self::where(['salesman'=>$info['id'],'status'=>44])->count();
                $money=self::field('sum(money)')->where(['salesman'=>$info['id'],'status'=>44])->select();
                $manage_sum_money=self::field('sum(manage_sum_money)')->where(['salesman'=>$info['id'],'status'=>44])->select();
                $nickname=self::table('staff')->field('nickname')->where(['id'=>$info['id']])->find();
                if($money[0]['sum(money)'] != null){//墓位费 合计
                    $price=$money[0]['sum(money)'];
                }else{
                    $price=0;
                }
                if($manage_sum_money[0]['sum(manage_sum_money)'] != null){//管理费 合计
                    $money=$manage_sum_money[0]['sum(manage_sum_money)'];
                }else{
                    $money=0;
                }
                $data['shouru']=$price+$money;//收入
                $html.='<tr class="trtr">';
                    $html.='<td>'.$nickname['nickname'].'</td>';
                    $html.='<td>'.$nickname['nickname'].'</td>';
                    $html.='<td>'.$data['count'].'</td>';
                    $html.='<td>'.$price.'</td>';
                    $html.='<td>'.$money.'</td>';
                    $html.='<td>'.$data['shouru'].'</td>';
                $html.='</tr>';
            }
            return $html;
        }
    }
    //墓位销售员业绩统计-个人
    static public function select_user_list($arra){
        $data['count']=self::where(['salesman'=>$arra['id'],'status'=>44])->count();
        $money=self::field('sum(money)')->where(['salesman'=>$arra['id'],'status'=>44])->select();
        $manage_sum_money=self::field('sum(manage_sum_money)')->where(['salesman'=>$arra['id'],'status'=>44])->select();
        $nickname=self::table('staff')->field('nickname')->where(['id'=>$arra['id']])->find();
        if($money[0]['sum(money)'] != null){//墓位费 合计
            $price=$money[0]['sum(money)'];
        }else{
            $price=0;
        }
        if($manage_sum_money[0]['sum(manage_sum_money)'] != null){//管理费 合计
            $money=$manage_sum_money[0]['sum(manage_sum_money)'];
        }else{
            $money=0;
        }
        $data['shouru']=$price+$money;//收入
        $data['nickname']=$nickname['nickname'];//姓命
        $data['price']=$price;//管理费 合计
        $data['money']=$money;//墓位费 合计
        return $data;
    }
    //墓位预订情况统计--全部 有时间
    static public function select_cem_yu_list_all_time($arra){
         if($arra['id'] == 'all'){
            $html='';
            if($arra['starttime']!='' && $arra['endtime']!=''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=39 and reserve_date>='.strtotime($arra['starttime']).' and reserve_date<='.strtotime($arra['endtime']))->count();
                    $reserve_money=self::field('sum(reserve_money)')->where('cem_id='.$info['id'].' and status=39 and reserve_date>='.strtotime($arra['starttime']).' and reserve_date<='.strtotime($arra['endtime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($reserve_money[0]['sum(reserve_money)'] != null){
                        $price=$reserve_money[0]['sum(reserve_money)'];
                    }else{
                        $price=0;
                    }
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']!='' && $arra['endtime'] == ''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=39 and reserve_date>='.strtotime($arra['starttime']))->count();
                    $reserve_money=self::field('sum(reserve_money)')->where('cem_id='.$info['id'].' and status=39 and reserve_date>='.strtotime($arra['starttime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($reserve_money[0]['sum(reserve_money)'] != null){
                        $price=$reserve_money[0]['sum(reserve_money)'];
                    }else{
                        $price=0;
                    }
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']=='' && $arra['endtime'] != ''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=39 and reserve_date<='.strtotime($arra['endtime']))->count();
                    $reserve_money=self::field('sum(reserve_money)')->where('cem_id='.$info['id'].' and status=39 and reserve_date<='.strtotime($arra['endtime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($reserve_money[0]['sum(reserve_money)'] != null){
                        $price=$reserve_money[0]['sum(reserve_money)'];
                    }else{
                        $price=0;
                    }
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                    $html.='</tr>';
                }
            }
            return $html;
        }
    }
    //墓位预订情况统计--全部 没有时间
    static public function select_cem_yu_list_all($arra){
        if($arra['id'] == 'all'){
            $html='';
            $arr=self::table('cem')->field('id,title')->select();
            foreach ($arr as $key => $info) {
                $data['count']=self::where(['cem_id'=>$info['id'],'status'=>39])->count();
                $reserve_money=self::field('sum(reserve_money)')->where(['cem_id'=>$info['id'],'status'=>39])->select();
                $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                if($reserve_money[0]['sum(reserve_money)'] != null){
                    $price=$reserve_money[0]['sum(reserve_money)'];
                }else{
                    $price=0;
                }
                $html.='<tr class="trtr">';
                    $html.='<td>'.$info['id'].'</td>';
                    $html.='<td>'.$title['title'].'</td>';
                    $html.='<td>'.$data['count'].'</td>';
                    $html.='<td>'.$price.'</td>';
                $html.='</tr>';
            }
            return $html;
        }
    }
    //墓位预订情况统计
    static public function select_cem_yu_list($info){
        $data['count']=self::where(['cem_id'=>$info['id'],'status'=>39])->count();
        $reserve_money=self::field('sum(reserve_money)')->where(['cem_id'=>$info['id'],'status'=>39])->select();
        $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
        if($reserve_money[0]['sum(reserve_money)'] != null){
            $price=$reserve_money[0]['sum(reserve_money)'];
        }else{
            $price=0;
        }
        $data['eid']=$info['id'];
        $data['title']=$title['title'];
        $data['money']=$price;
        return $data;
    }
    //墓位销售情况统计--总计 时间
    static public function select_cem_list_all_time($arra){
        if($arra['id'] == 'all'){
            $html='';
            if($arra['starttime']!='' && $arra['endtime']!=''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->count();
                    $muwei=self::field('sum(money)')->where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->select();
                    $guanli=self::field('sum(manage_sum_money)')->where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']).' and settime<='.strtotime($arra['endtime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($muwei[0]['sum(money)'] != null){
                        $price=$muwei[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($guanli[0]['sum(manage_sum_money)'] != null){
                        $money=$guanli[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']!='' && $arra['endtime'] == ''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->count();
                    $muwei=self::field('sum(money)')->where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->select();
                    $guanli=self::field('sum(manage_sum_money)')->where('cem_id='.$info['id'].' and status=44 and settime>='.strtotime($arra['starttime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($muwei[0]['sum(money)'] != null){
                        $price=$muwei[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($guanli[0]['sum(manage_sum_money)'] != null){
                        $money=$guanli[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }else if($arra['starttime']=='' && $arra['endtime'] != ''){
                $arr=self::table('cem')->field('id,title')->select();
                foreach ($arr as $key => $info) {
                    $data['count']=self::where('cem_id='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->count();
                    $muwei=self::field('sum(money)')->where('cem_id='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->select();
                    $guanli=self::field('sum(manage_sum_money)')->where('cem_id='.$info['id'].' and status=44 and settime<='.strtotime($arra['endtime']))->select();
                    $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                    if($muwei[0]['sum(money)'] != null){
                        $price=$muwei[0]['sum(money)'];
                    }else{
                        $price=0;
                    }
                    if($guanli[0]['sum(manage_sum_money)'] != null){
                        $money=$guanli[0]['sum(manage_sum_money)'];
                    }else{
                        $money=0;
                    }
                    $data['shouru']=$price+$money;
                    $html.='<tr class="trtr">';
                        $html.='<td>'.$info['id'].'</td>';
                        $html.='<td>'.$title['title'].'</td>';
                        $html.='<td>'.$data['count'].'</td>';
                        $html.='<td>'.$price.'</td>';
                        $html.='<td>'.$money.'</td>';
                        $html.='<td>'.$data['shouru'].'</td>';
                    $html.='</tr>';
                }
            }
            return $html;
        }
    }
    //墓位销售情况统计--总计
    static public function select_cem_list_all($arra){
        if($arra['id'] == 'all'){
            $html='';
            $arr=self::table('cem')->field('id,title')->select();
            foreach ($arr as $key => $info) {
                $data['count']=self::where(['cem_id'=>$info['id'],'status'=>44])->count();
                $muwei=self::field('sum(money)')->where(['cem_id'=>$info['id'],'status'=>44])->select();
                $guanli=self::field('sum(manage_sum_money)')->where(['cem_id'=>$info['id'],'status'=>44])->select();
                $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
                if($muwei[0]['sum(money)'] != null){
                    $price=$muwei[0]['sum(money)'];
                }else{
                    $price=0;
                }
                if($guanli[0]['sum(manage_sum_money)'] != null){
                    $money=$guanli[0]['sum(manage_sum_money)'];
                }else{
                    $money=0;
                }
                $data['shouru']=$price+$money;
                $html.='<tr class="trtr">';
                    $html.='<td>'.$info['id'].'</td>';
                    $html.='<td>'.$title['title'].'</td>';
                    $html.='<td>'.$data['count'].'</td>';
                    $html.='<td>'.$price.'</td>';
                    $html.='<td>'.$money.'</td>';
                    $html.='<td>'.$data['shouru'].'</td>';
                $html.='</tr>';
            }
            return $html;
        }
        
    }
    //墓位销售情况统计
    static public function select_cem_list($info){
        $data['count']=self::where(['cem_id'=>$info['id'],'status'=>44])->count();
        $muwei=self::field('sum(money)')->where(['cem_id'=>$info['id'],'status'=>44])->select();
        $guanli=self::field('sum(manage_sum_money)')->where(['cem_id'=>$info['id'],'status'=>44])->select();
        $title=self::table('cem')->field('title')->where(['id'=>$info['id']])->find();
        if($muwei[0]['sum(money)'] != null){
            $price=$muwei[0]['sum(money)'];
        }else{
            $price=0;
        }
        if($guanli[0]['sum(manage_sum_money)'] != null){
            $money=$guanli[0]['sum(manage_sum_money)'];
        }else{
            $money=0;
        }
        $data['shouru']=$price+$money;
        $data['eid']=$info['id'];
        $data['title']=$title['title'];
        $data['muwei']=$price;
        $data['guanli']=$money;
        return $data;
    }
    //墓位状态统计数量
    static public function select_cem($info){
        $data['kong']=self::where(['cem_id'=>$info['id'],'status'=>38])->count();
        $data['yuding']=self::where(['cem_id'=>$info['id'],'status'=>39])->count();
        $data['dinggou']=self::where(['cem_id'=>$info['id'],'status'=>44])->count();
        $data['xiazang']=self::where(['cem_id'=>$info['id'],'status'=>41])->count();
        return $data;
    }
    //墓位状态统计总数量
    static public function select_show_all($info){
        if($info['id'] == 'all'){
            $data['kong']=self::where(['status'=>38])->count();
            $data['yuding']=self::where(['status'=>39])->count();
            $data['dinggou']=self::where(['status'=>44])->count();
            $data['xiazang']=self::where(['status'=>41])->count();
            return $data;
        }
    }
    //修改业务员信息
    static public function set_subuser($info){
        if (self::where('id', $info['id'])->update(['salesman'=>$info['sale']]) !== false) {
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
    //已购墓位 退订
    static public function tuiding($info){
        if (self::where('id', $info['id'])->update(['sta'=>4]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    //确认墓位预订收费
    static public function finan_set_muweis($info){
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::where('id', $info['id'])->update(['pay_status'=>1]) !== false) {
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
