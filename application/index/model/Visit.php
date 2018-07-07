<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Contacts;
use app\index\model\Tpl as _Tpl;
use app\index\model\ComeChannel as _Channel;
use app\index\model\Staff as _Staff;
use app\index\model\Cem as _Cem;
use think\Db;
class Visit extends Root {

    protected $table = 'visit_log';

    static public function wlist ($map = []) {
        return self::alias('a')->join('contacts b','a.contacts_id = b.id')->where($map)->select();
    }

    static public function plist ($map = []) {
        return self::alias('a')->join('contacts b','a.contacts_id = b.id')->where($map)->paginate(20);
    }
    static public function open_visit_log($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->join('cem_info c','a.contacts_id = c.contacts_id')->where(['a.contacts_id'=>$info])->select();
        $staff=_Staff::wlistf();
        $cem_model=_Tpl::tlist(8);//墓位类型
        $cem_status=_Tpl::tlist(9);//墓位状态
        $cem_sty=_Tpl::tlist(2);//墓位样式
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $cem_list= _Cem::wlist();
        $html='';
        $html.='<div class="yjtan" style="display: block;">';
                $html.='<div class="yjtana">';
                    $html.='<p>已关联的墓位信息</p>';
                    $html.='<div class="yjtantable">';
                       $html.=' <table class="table table-bordered">';
                            $html.='<thead>';
                               $html.=' <tr>';
                                   $html.=' <th>来访者姓名</th>';
                                    $html.='<th>接待员</th>';
                                    $html.='<th>墓位全称</th>';
                                    $html.='<th>墓位长</th>';
                                    $html.='<th>墓位宽</th>';
                                    $html.='<th>墓位面积</th>';
                                    $html.='<th>墓位价格</th>';
                                    $html.='<th>墓位类型</th>';
                                    $html.='<th>墓位状态</th>';
                                    $html.='<th>墓位材质</th>';
                                    $html.='<th>墓位样式</th>';
                                $html.='</tr>';
                            $html.='</thead>';
                            $html.='<tbody>';
                            foreach ($arr as $key => $v) {
                                $html.='<tr>';
                                    $html.='<td>'.$v['name'].'</td>';
                                    $html.='<td>'.$staff[$v['receiver']]['nickname'].'</td>';
                                    $html.='<td>'.$v['long_title'].'</td>';
                                    $html.='<td>'.$v['width'].'</td>';
                                    $html.='<td>'.$v['length'].'</td>';
                                    $html.='<td>'.$v['acreage'].'</td>';
                                    $html.='<td>'.$v['price'].'</td>';
                                    $html.='<td>'.$cem_model[$v['model']]['title'].'</td>';
                                    $html.='<td>'.$cem_status[$v['status']]['title'].'</td>';
                                    $html.=' <td>'.$cem_mat[$v['material']]['title'].'</td>';
                                    $html.='<td>'.$cem_sty[$v['style']]['title'].'</td>';
                                $html.='</tr>';
                            }
                            $html.='</tbody>';
                        $html.='</table>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="yjtanb">';
                    $html.='<form>';
                        $html.='<fieldset>';
                            $html.='<legend>选择墓位</legend>';
                            $html.='<div class="yjtanba">';
                              $html.='<p>选择墓园</p>';
                              $html.='<p>选择墓区</p>';
                             $html.=' <p>选择墓排</p>';
                              $html.='<p>墓位样式</p>';
                            $html.='</div>';
                            $html.='<div class="yjtanbb">';
                                $html.='<select name="cem_id" class="cem_id_row">';
                                   $html.='<option value="">请选择</option>';
                                   foreach ($cem_list as $key => $vo) {
                                       $html.='<option value="'.$vo['id'].'">'.$vo['title'].'</option>';
                                   }
                                $html.='</select>';
                                $html.='<select name="cem_area_id" class="cem_area_id_row">';
                                    $html.='<option value="0">请选择</option>';
                                $html.='</select>';
                                $html.='<select name="cem_row_id" class="cem_row_id_row">';
                                    $html.='<option value="0">请选择</option>';
                                $html.='</select>';
                                $html.='<select name = "style" class="row_style">';
                                    $html.='<option value="0">请选择</option>';
                                    foreach ($cem_sty as $key => $vo) {
                                        $html.='<option value="'.$vo['id'].'">'.$vo['title'].'</option>';
                                    }
                                $html.='</select>';
                                $html.='<div class="yjtanbc" onclick="setopen('.$info.')" style="cursor:pointer">显示墓位</div>';
                                $html.='<div class="yjtanbc" onclick="setreload()" style="cursor:pointer">刷新</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="yjtanc" id="xianshi">';
                               
                $html.='</div>';
                $html.='<div class="yjtand">';
                    $html.='<div class="yjtanda">墓位当前销售数量总览：空墓：3476</div>';
                    $html.='<div class="yjtanda">已预订：15</div>';
                    $html.='<div class="yjtanda">已定购：2110</div>';
                    $html.='<div class="yjtanda">已下葬：9532</div>';
               $html.=' </div>';
           $html.=' </div>';
        return $html;
    }
    static public function setopen_visit_log($map,$id){
        $arr=self::table('cem_info')->field('id,long_title,status')->where($map)->order('cem_id', 'asc')->column('*', 'id');
        foreach ($arr as $key => $value) {
            if($value['status'] != '38'){
                $html.='<div class="yjtanca" onclick="set_img('.$value['id'].','.$id.')" style="cursor:pointer">';
            }else{
                $html.='<div class="yjtanca">';
            }
                $html.='<div class="yjtancb">';
                if($value['status'] == '38'){
                    $html.='<img src="/index/images/kong.png">';
                }else if($value['status'] == '40'){
                    $html.='<img src="/index/images/ding_03.png">';
                }else if($value['status'] == '39'){
                    $html.='<img src="/index/images/yu_03.png">';
                }else if($value['status'] == '44'){
                    $html.='<img src="/index/images/zang_03.png">';
                }
                $html.='</div>';
                $html.='<p>'.$value['long_title'].'</p>';
            $html.='</div>';
        }
        return $html;
    }
    static public function set_visit_img_mw($info){
        if (Db::table('cem_info')->where('id', $info['id'])->update(['contacts_id'=>$info['cid']]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function set_visit_img($info){
        $cem_sty=_Tpl::tlist(2);//墓位样式
        $cem_mat=_Tpl::tlist(3);//墓位材料
        $arr=self::table('cem_info')->where(['id'=>$info['id']])->find();
        $contacts=self::table('contacts')->where(['id'=>$info['cid']])->find();
            $html='';
            $html.='<div class="ydjtan" style="display:block;">';
                $html.='<div class="tanf">';
                   $html.=' <form>';
                        $html.='<fieldset>';
                            $html.='<legend>墓位信息</legend>';
                            $html.='<div class="tanfa">';
                                $html.='<p>您选择的是：'.$arr['long_title'].' | 墓位样式：'.$cem_sty[$arr['style']]['title'].'</p>';
                                $html.='<div class="tanfb">';
                                    $html.='<div>墓位长：'.$arr['width'].'米</div>';
                                    $html.='<div>墓位宽：'.$arr['length'].'米</div>';
                                    $html.='<div>墓位面积：'.$arr['acreage'].'平方</div>';
                                    $html.='<div>墓位材质：'.$cem_mat[$arr['material']]['title'].'</div>';
                                    $html.='<div>墓位状态：已定购</div>';
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
                                $html.='<div class="tangb">';
                                    $html.='<div>墓位费：111元</div>';
                                    $html.='<div>应付（已付）管理费总额：0.00元</div>';
                                    $html.='<div>应付（已付）款总额：8,900.00元</div>';
                                    $html.='<div>是否已交费：已付款</div>';
                                    $html.='<div>使用开始日期：2009-03-28</div>';
                                $html.='</div>';
                                $html.='<div class="tangc">';
                                    $html.='<div>联系人：'.$contacts['name'].'</div>';
                                    $html.='<div>身份证：'.$contacts['idcard'].'</div>';
                                    $html.='<div>联系电话：'.$contacts['tel'].'</div>';
                                    $html.='<div>购墓日期：</div>';
                                    $html.='<div>使用结束日期：2029-03-28</div>';
                                $html.='</div>';
                                $html.='<div class="tangd">';
                                    $html.='<div class="tanfgda">';
                                        $html.='<p>备注：</p>';
                                        
                                    $html.='</div>';
                                    $html.='<textarea></textarea>';
                                $html.='</div>  ';                            
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="ydjtanbot">';
                    $html.='<div class="ydjtand">';
                        $html.='<div class="ydjtanbota" onclick="setmw('.$info['id'].','.$info['cid'].')" style="cursor:pointer">选定此墓位信息</div>';
                   $html.=' </div>';
                $html.='</div>';
           $html.=' </div>';
       return $html;
    }
    static public function set_visit_log($info){
        $arr=self::alias('a')->join('contacts b','a.contacts_id = b.id')->where(['a.contacts_id'=>$info])->find();
        $relationship=self::table('tpl')->field('id,title')->where(['type'=>4])->select();
        $t1=_Channel::t1();
        $come_num=_Tpl::tlist(13);
        $come_fun=_Tpl::tlist(5);
        $tel=_Tpl::tlist(14);
        $staff=_Staff::id2tit();
        $no_transaction_ps=_Tpl::tlist(6);
        if($arr){
            $html='';
            $html.='<form method="post" class="row_visit_edit">';
              $html.='<div class="djtan">';
                $html.='<div class="djtana">';
                        $html.='<fieldset>';
                           $html.=' <legend>客户信息</legend>   ';
                            $html.='<div class="djtanb">';
                                $html.='<div class="djtanba">';
                                    $html.='<p>来访者姓名：</p>';
                                    $html.='<input type="text" value="'.$arr['name'].'" name="name">';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtanbb">';
                                    $html.='<p>与墓位使用人关系：</p>';
                                    $html.='<select name="relationship">';
                                        foreach ($relationship as $key => $value) {
                                            if($value['id'] == $arr['relationship']){
                                                $html.='<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';    
                                            }else{
                                                $html.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
                                            }
                                        }
                                    $html.='</select>';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtanc">';
                                $html.='<div class="djtanca">';
                                    $html.='<p>联系电话：</p>';
                                    $html.='<input type="text" value="'.$arr['tel'].'" name="tel">';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtancb">';
                                    $html.='<p>家庭住址：</p>';
                                    $html.='<input type="text" name="address" value="'.$arr['address'].'">';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                $html.='</div>';
                $html.='<div class="djtand">';
                        $html.='<fieldset>';
                            $html.='<legend>来访信息</legend>';
                            $html.='<div class="djtanda">';
                                $html.='<div class="djtandq">';
                                    $html.='<p>渠道1：</p>';
                                    $html.='<select class="row_pid" id="row_pid"  name="channel_t1">';
                                       $html.=' <option value="0">请选择</option>';
                                       foreach ($t1 as $key => $vo) {
                                           $html.='<option value="'.$vo['id'].'">'.$vo['title'].'</option>';
                                       }
                                   $html.=' </select>';
                                    $html.='<i></i>';
                                $html.='</div>';
                                $html.='<div class="djtandq">';
                                   $html.=' <p>渠道2：</p>';
                                   $html.=' <select class="row_ppid"  id="row_ppid" name="channel_t2">';
                                   $html.=' </select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtandq">';
                                    $html.='<p>渠道3：</p>';
                                    $html.='<select class="row_pppid" name="channel_t3">';
                                    $html.='</select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtandb">';
                               $html.=' <div class="djtandbt">';
                                    $html.='<p>来访日期：</p>';
                                    $html.='<input class="Wdate" name="come_date" type="text" value="'.date('Y-m-d',$arr['come_date']).'" onClick="WdatePicker()">';
                                $html.='</div>';
                                $html.='<div class="djtandbta">';
                                    $html.='<div class="djtanbtle">';
                                       $html.=' <p>来访次数：</p>';
                                       $html.=' <select name="come_num">';
                                              foreach ($come_num as $key => $v) {
                                                if($v['id'] == $arr['come_num']){
                                                    $html.='<option value="'.$v['id'].'" selected>'.$v['title'].'</option>';
                                                }else{
                                                    $html.='<option value="'.$v['id'].'">'.$v['title'].'</option>';
                                                }
                                              }
                                        $html.='</select>';
                                    $html.='</div>';
                                    $html.='<div class="djtanbtri">';
                                        $html.='<p>来访人数：</p>';
                                       $html.=' <input type="number" min = "1" name="people_num" value="'.$arr['people_num'].'">';
                                       $html.=' <i>*</i>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="djtandbtb"> ';                                
                                   $html.=' <p>来访方式：</p>';
                                    $html.='<select name="come_fun">';
                                       $html.=' <option>自驾</option>';
                                       foreach ($come_fun as $key => $value) {
                                            if($value['id'] == $arr['come_fun']){
                                                $html.='<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                            }else{
                                                $html.='<option value="'.$value['id'].'">'.$value['title'].'</option>';    
                                            }
                                       }
                                    $html.='</select>';
                                $html.='</div>';
                           $html.=' </div>';
                           $html.=' <div class="djtandc">';
                                $html.='<div class="djtandca">';
                                    $html.='<p>咨询电话：</p>';
                                    $html.='<select name="tel_id">';
                                    foreach ($tel as $key => $value) {
                                        if($value['id'] == $arr['tel_id']){
                                            $html.='<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                        }else{
                                            $html.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
                                        }
                                    }
                                    $html.='</select>';
                                $html.='</div>';
                                $html.='<div class="djtandca">';
                                   $html.=' <p>接待员：</p>';
                                    $html.='<select name="receiver">';
                                        foreach ($staff as $key => $value) {
                                            if($key == $arr['receiver']){
                                                $html.='<option value="'.$key.'" selected>'.$value.'</option>';
                                            }else{
                                                $html.='<option value="'.$key.'">'.$value.'</option>';
                                            }
                                        }
                                    $html.='</select>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                $html.='</div>';
                $html.='<div class="djtancj">';
                        $html.='<fieldset>';
                            $html.='<legend>成交情况：</legend>';
                            $html.='<div class="djtancja">';
                                $html.='<div class="djtancjale">';
                                    $html.='<p>成交情况：</p>';
                                    $html.='<select name="transaction_status">';
                                        $html.='<option value="1">成交</option>';
                                        $html.='<option value="0">未成交</option>';
                                    $html.='</select>';
                                $html.='</div>';
                                $html.='<div class="djtancjari">';
                                    $html.='<p>成交(未成交)原因：</p>';
                                    $html.='<select name="no_transaction_ps">';
                                    foreach ($no_transaction_ps as $key => $value) {
                                        if($value['id'] == $arr['no_transaction_ps']){
                                            $html.='<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                                        }else{
                                            $html.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
                                        }
                                    }
                                    $html.='</select>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtancjb">';
                                $html.='<p>成交日期：</p>';
                                if($arr['transaction_status'] == 1){
                                    $html.='<input class="Wdate" name="transaction_suc_date" value="'.date('Y-m-d',$arr['transaction_suc_date']).'" type="text" onClick="WdatePicker()">';
                                }else{
                                    $html.='<input class="Wdate" name="transaction_suc_date" type="text" onClick="WdatePicker()">';
                                }
                            $html.='</div>';
                            $html.='<div class="djtancjc">';
                                $html.='<div class="djtancjcle">';
                                    $html.='<p>接待记录：</p>';
                                    $html.='<textarea  name="reception_log">'.$arr['reception_log'].'</textarea>';
                                $html.='</div>';
                                $html.='<div class="djtancjcri">';
                                    $html.='<p>备注：</p>';
                                    $html.='<textarea name="remarks">'.$arr['remarks'].'</textarea>';
                                $html.='</div>';
                            $html.='</div>   ';                       
                        $html.='</fieldset>';
                $html.='</div>';
                $html.='<div class="djtancz">';
                    $html.='<div class="djtancza">';
                            $html.='<fieldset>';
                               $html.=' <legend>操作提示</legend>';
                            $html.='</fieldset>';
                    $html.='</div>';
                    $html.='<input name="eid" type="hidden" value="'.$arr['id'].'">';
                    $html.='<div class="djtanczb" onclick="jcwdg()" style="cursor:pointer">保存客户来访信息</div>';
                $html.='</div>';
            $html.='</div>';
            $html.='</form>';
        }else{
            $html='2';
        }
       return $html;
    }
    static public function cnt  ($map = []) {
        return self::alias('a')->join('contacts b','a.Contacts_id = b.id')->where($map)->count();
    }

    static public function t1 () {
        return self::wlist(['pid' => 0]);
    }

    static public function t2 () {
        return self::wlist(['pid' => ['gt', 0], 'ppid' => 0]);
    }

    static public function t3 () {
        return self::wlist(['ppid' => ['gt', 0]]);
    }

    static public function del ($id) {

        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($id, $info) {
        if (self::where('id', $id)->update($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function set_status ($id, $val) {

        if (self::where('id', $id)->update(['status' => $val]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function add ($info) {

        $info['contacts_id'] = Contacts::vlog_add();
        if($info['transaction_status'] == 1){
            $info['no_transaction_ps'] = null;
        }else{
            $info['no_transaction_ps'] = $info['no_transaction_ps'];
        }
        if($info['transaction_suc_date']){
            $info['transaction_suc_date'] = strtotime($info['transaction_suc_date']);
        }
        if($info['come_date']){
            $info['come_date'] = strtotime($info['come_date']);
        }
        if (self::strict(false)->insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function visit_edit($info){
        if($info['transaction_suc_date']){  
            $info['transaction_suc_date'] = strtotime($info['transaction_suc_date']);
        }
        if($info['come_date']){
            $info['come_date'] = strtotime($info['come_date']);
        }
        Db::startTrans();
        try{
            $ss=Db::table('visit_log')->field('channel_t1,channel_t2,channel_t3')->where(['contacts_id'=>$info['eid']])->find();
            if($info['channel_t1']){
                $info['channel_t1']=$info['channel_t1'];
            }else{
                $info['channel_t1']=$ss['channel_t1'];
            }
            if($info['channel_t2']){
                $info['channel_t2']=$info['channel_t2'];
            }else{
                $info['channel_t2']=$ss['channel_t2'];
            }
            if($info['channel_t3']){
                $info['channel_t3']=$info['channel_t3'];
            }else{
                $info['channel_t3']=$ss['channel_t3'];
            }
            Db::table('visit_log')->where(['contacts_id'=>$info['eid']])->update(['channel_t1'=>$info['channel_t1'],'channel_t2'=>$info['channel_t2'],'channel_t3'=>$info['channel_t3'],'relationship'=>$info['relationship'],'receiver'=>$info['receiver'],'come_num'=>$info['come_num'],'come_fun'=>$info['come_fun'],'come_date'=>$info['come_date'],'transaction_status'=>$info['transaction_status'],'no_transaction_ps'=>$info['no_transaction_ps'],'transaction_suc_date'=>$info['transaction_suc_date'],'reception_log'=>$info['reception_log'],'remarks'=>$info['remarks'],'people_num'=>$info['people_num'],'tel_id'=>$info['tel_id']]);
            Db::table('contacts')->where(['id'=>$info['eid']])->update(['name'=>$info['name'],'relationship'=>$info['relationship'],'tel'=>$info['tel'],'address'=>$info['address']]);
            // 提交事务
            Db::commit();
            return RE_SUCCESS;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return RE_ERROR;
        }
    }
}
