<?php
namespace app\index\model;

use app\index\model\Root;

class Sysjcw extends Root {

    // protected $autoWriteTimestamp = 'datetime';

    protected $table = 'sys_mw';

    static public function wlist ($map = []) {
        return self::where($map)->order('sysid', 'asc')->column('*', 'id');
    }
    static public function wlists ($sysid) {
        return self::order('sysid', 'asc')->where($sysid)->select();
    }
    static public function wlisty ($map = []) {
        return self::where($map)->where(['syszt'=>2])->order('sysid', 'asc')->column('*', 'id');
    }
    static public function del ($ids) {
        if (empty($ids) || !count($ids) ) {
            return ['status' => false, 'msg' => '请选择要删除的寄存位'];
        }
        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function deposit_set_sell ($id){
        $arr=self::field('id,sysysid,money,syszt,long_title')->where(['id'=>$id['id']])->find();
        if($arr['syszt'] == '1'){
            $html='';
            $html.='<div class="jcwtan">';
              $html.='<div class="jcwtana">';
                $html.='<p>您选择的是：'.$arr['long_title'].'</p>';
              $html.='</div>';
              $html.='<div class="jcwtanb">';
                $html.='<div>价格：'.$arr['money'].'元</div>';
                if($arr['syszt'] == '1'){//
                    $html.='<div>寄存位状态：空闲</div>';
                }else if($arr['syszt'] == '2'){//
                    $html.='<div>寄存位状态：已订购</div>';
                }else if($arr['syszt'] == '3'){//
                    $html.='<div>寄存位状态：已安葬</div>';
                }
                $e = self::table('sys_list_y')->where('id', $arr['sysysid'])->field('title')->find();
                $html.='<div>寄存位样式：'.$e['title'].'</div>';
              $html.='</div>';
              $html.='<div class="jcwtanc">';
                $html.='<div class="jcwtanca" onclick="jcwdg('.$arr['id'].')">寄存位定购</div>';
                $html.='<div class="jcwtancb" onclick="closelayer()">取消本次操作</div>';
             $html.=' </div>';
           $html.=' </div>';
        }else{
            $html='2';
        }
       return $html;
    }
    static public function deposit_set_sell_y ($id){
        $arr=self::field('id,sysid,sysid_s,sysid_c,sysysid,money,long_title')->where(['id'=>$id['id']])->find();
        $user = self::table('role')->field('id,title')->select();
        $tpl = self::table('tpl')->where(['type'=>4])->field('id,title')->select();
        $html='';
        $html.='<form class="add_row" method="post">';
        $html.='<div class="dgtan" style="display:block;">';
                $html.='<div class="dgtana">';
                        $html.='<fieldset>';
                            $html.='<legend>寄存位定购信息</legend>';
                            $html.='<div class="dgtanb">';
                                $html.='<div class="dgtanba">';
                                    $html.='<p>寄存位全称：</p>';
                                    $html.='<input type="hidden" name="eid" value="'.$arr['id'].'" />';
                                    $html.='<input type="hidden" name="sysid" value="'.$arr['sysid'].'" />';
                                    $html.='<input type="hidden" name="sysid_s" value="'.$arr['sysid_s'].'" />';
                                    $html.='<input type="hidden" name="sysid_c" value="'.$arr['sysid_c'].'" />';
                                    $html.='<input type="hidden" name="sysysid" value="'.$arr['sysysid'].'" />';
                                    $html.='<input type="text" value="'.$arr['long_title'].'" name="long_title" readonly="readonly"/>';
                                $html.='</div>';
                                $html.='<div class="dgtanbb">';
                                    $html.='<p>原始价格：</p>';
                                    $html.='<input type="text" value="'.$arr['money'].'" name="price" readonly="readonly"/>';
                                $html.='</div>';
                                $html.='<div class="dgtanbc">';
                                    $html.='<p>定购日期：</p>';
                                    $html.='<input class="Wdate" name="settime" type="text" onClick="WdatePicker()">';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="dgtanc">';
                                $html.='<div class="dgtanca">';
                                    $html.='<p>寄存位费：</p>';
                                    $html.='<input type="text" name="jcm" id="jcm" onblur="jcwf()"/>';
                                $html.='</div>';
                                $html.='<div class="dgtancb">';
                                    $html.='<p>管理费：</p>';
                                    $html.='<input type="text" class="dgtancba" name="glmo" id="glmo" onblur="glmone()">';
                                    $html.='<em>X</em>';
                                    $html.='<input type="text" class="dgtancbb" name="glmt" id="glmt" onchange="glmtwo()">';
                                    $html.='<b>年=</b>';
                                    $html.='<input type="text" class="dgtancbc" id="glms" name="glms" disabled>';
                                $html.='</div>';
                                $html.='<div class="dgtancc">';
                                    $html.='<p>使用开始：</p>';
                                    $html.='<input class="Wdate" name="starttime" type="text" onClick="WdatePicker()">';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="dgtand">';
                                $html.='<div class="dgtanda">';
                                    $html.='<p>应付总额：</p>';
                                    $html.='<input type="text" name="summoney" id="summoney" disabled/>';
                                $html.='</div>';
                                $html.='<div class="dgtandb">';
                                    $html.='<p>价格单位：（元）</p>';
                                $html.='</div>';
                                $html.='<div class="dgtandc">';
                                    $html.='<p>使用结束：</p>';
                                    $html.='<input class="Wdate" name="endtime" type="text" onClick="WdatePicker()">';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                $html.='</div>';
                $html.='<div class="gztanj" style="margin: 30px auto;">';
                    $html.='<div class="gztanjle">';
                        $html.='<div class="gztanja">';
                                $html.='<fieldset>';
                                   $html.=' <legend>联系人信息</legend>';
                                    $html.='<div class="gztanjc">';
                                        $html.='<div class="gztanjca">';
                                           $html.=' <p>联系人姓名：</p>';
                                            $html.='<input type="text" name="uname" id="uname">';
                                           $html.=' <i>*</i>';
                                       $html.=' </div>';
                                       $html.=' <div class="gztanjcb">';
                                           $html.=' <p>故者关系：</p>';
                                           $html.=' <select name="gzgx" id="gzgx">';
                                               foreach ($tpl as $key => $value) {
                                                    $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                                }
                                           $html.=' </select>';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                    $html.='</div>';
                                    $html.='<div class="gztanjd">';
                                        $html.='<div class="gztanjda">';
                                           $html.=' <p>身份证号：</p>';
                                            $html.='<input type="text" name="ucode" id="ucode" maxlength="18">';
                                           $html.=' <i>*</i>';
                                       $html.=' </div>';
                                       $html.=' <div class="gztanjdb">';
                                            $html.='<p>性别：</p>';
                                            $html.='<select name="sex" id="sex">';
                                               $html.=' <option value="2">男</option>';
                                               $html.=' <option value="3">女</option>';
                                            $html.='</select>';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                   $html.=' </div>';
                                    $html.='<div class="gztanje">';
                                       $html.=' <div class="gztanjea">';
                                           $html.=' <p>联系电话：</p>';
                                           $html.='<input type="text" name="phone" id="phone">';
                                            $html.='<i>*</i>';
                                        $html.='</div>';
                                        $html.='<div class="gztanjeb">';
                                            $html.='<p>手机：</p>';
                                            $html.='<input type="text" name="mobile" id="mobile" onblur="gmobile()" maxlength="11">'; 
                                            $html.='<i></i>';
                                        $html.='</div>';
                                    $html.='</div>     ';                         
                                    $html.='<div class="gztanjg">';
                                        $html.='<div class="gztanjga">';
                                           $html.=' <p>工作单位：</p>';
                                           $html.=' <input type="text" name="gzdw" id="gzdw"> ';                                        
                                      $html.=' </div>  ';                                    
                                    $html.='</div>';
                                    $html.='<div class="gztanjg">';
                                       $html.=' <div class="gztanjga">';
                                            $html.='<p>电子邮件：</p>';
                                            $html.='<input type="text" name="email" id="email"> ';                                        
                                        $html.='</div>  ';                                    
                                    $html.='</div>';
                                    $html.='<div class="gztanjh">';
                                       $html.=' <div class="gztanjha">';
                                            $html.='<p>家庭住址：</p>';
                                           $html.=' <input type="text" name="home" id="home"> ';                                        
                                        $html.='</div> ';                                     
                                    $html.='</div>';
                                $html.='</fieldset>';
                        $html.='</div>';
                        $html.='<div class="gztanjb">';
                                $html.='<fieldset>';
                                  $html.='  <legend>操作提示</legend>';
                               $html.=' </fieldset>';
                        $html.='</div>';
                   $html.=' </div>';
                   $html.=' <div class="gztanjri">';
                          $html.='  <fieldset>';
                               $html.=' <legend>故者落葬操作信息</legend>';
                               $html.=' <div class="gztanjria">';
                                 $html.='    <p>业务员：</p>';
                                    $html.='<select name="roleid" id="roleid">';
                                        foreach ($user as $key => $value) {
                                            $html.=' <option value="'.$value['id'].'">'.$value['title'].'</option>';
                                        }
                                    $html.='</select>';
                                  $html.='   <i>*</i>';
                                $html.='</div>      ';                        
                                $html.='<div class="gztanjric">';
                                     $html.=' <p>备注：</p>';
                                     $html.=' <textarea name="beizhu" id="beizhu"></textarea>';
                                $html.='</div>';
                                $html.='<div class="gztanjrid">';
                                   $html.=' <button type="button" class="gztanjrida" onclick="subform()">保存</button>';
                                   $html.=' <button type="button" class="gztanjrida" onclick="closeghtml">取消</button>';
                               $html.='</div>';
                               $html.=' <div class="gztanjrie">打印寄存位定购合同</div>';
                               $html.=' <div class="gztanjrif">打印购墓合同（反）</div>';
                           $html.='</fieldset>';
                   $html.=' </div>';
               $html.=' </div>';
             $html.='</div>';
             $html.=' </form>';
       return $html;
    }
    static public function edit ($id, $info) {
        if (!(int)$info['sysid']) {
            return ['status' => false, 'msg' => '请选择寄存厅'];
        }
        if (!(int)$info['sysid_s']) {
            return ['status' => false, 'msg' => '请选择寄存室'];
        }
        if (!(int)$info['sysid_c']) {
            return ['status' => false, 'msg' => '请选择寄存层'];
        }
        if (!(int)$info['sysysid']) {
            return ['status' => false, 'msg' => '请寄存位样式'];
        }
       if (empty($info['money'])) {
            return ['status' => false, 'msg' => '请填写价格'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

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

    static public function long_title ($cem_id, $area_id, $row_id) {
        $e = '';
        $e .= self::table('sys_list')->where('id', $cem_id)->value('title');
        $e .= '-';
        $e .= self::table('sys_list_s')->where('id', $area_id)->value('title');
        $e .= '-';
        $e .= self::table('sys_list_c')->where('id', $row_id)->value('title');
        $e .= '-';
        return $e;
    }

    static public function add ($info) {
        if (!(int)$info['sysid']) {
            return ['status' => false, 'msg' => '请选择寄存厅'];
        }
        if (!(int)$info['sysid_s']) {
            return ['status' => false, 'msg' => '请选择寄存室'];
        }
        if (!(int)$info['sysid_c']) {
            return ['status' => false, 'msg' => '请选择寄存层'];
        }
        if (!(int)$info['sysysid']) {
            return ['status' => false, 'msg' => '请寄存位样式'];
        }
        if (empty($info['money'])) {
            return ['status' => false, 'msg' => '请填写价格'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['many_num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        $long_title = self::long_title($info['sysid'], $info['sysid_s'], $info['sysid_c']);
        if ($info['type'] == 'one'  && self::insert([
                'title'          => $info['title'],
                'long_title'     => $long_title . $info['title'],
                'sysid'         => $info['sysid'],
                'sysid_s'    => $info['sysid_s'],
                'sysid_c'     => $info['sysid_c'],
                'syszt'     => $info['syszt'],
                'money'     => $info['money'],
                'sysysid'       => $info['sysysid'],
                'time'          => time(),
            ]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['many_num']; $i++) {
                $data_list[] = [
                        'long_title'     => $long_title . $i . '号',
                        'title'          => $i . '号',
                        'sysid'         => $info['sysid'],
                        'sysid_s'    => $info['sysid_s'],
                        'sysid_c'     => $info['sysid_c'],
                        'money'          => $info['money'],
                        'syszt'     => $info['syszt'],
                        'sysysid'       => $info['sysysid'],
                        'time'          => time(),
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

}
