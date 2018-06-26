<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Contacts;

class Visit extends Root {

    protected $table = 'visit_log';

    static public function wlist ($map = []) {
        return self::alias('a')->join('contacts b','a.Contacts_id = b.id')->where($map)->select();
    }

    static public function plist ($map = []) {
        return self::alias('a')->join('contacts b','a.Contacts_id = b.id')->where($map)->paginate(20);
    }
    static public function open_visit_log($info){

    }
    static public function set_visit_log($info){
        $arr=self::alias('a')->join('contacts b','a.Contacts_id = b.id')->where(['a.Contacts_id'=>$info])->find();
        if($arr){
            $html='';
              $html.='<div class="djtan">';
                $html.='<div class="djtana">';
                    $html.='<form>';
                        $html.='<fieldset>';
                           $html.=' <legend>客户信息</legend>   ';
                            $html.='<div class="djtanb">';
                                $html.='<div class="djtanba">';
                                    $html.='<p>来访者姓名：</p>';
                                    $html.='<input type="text" value="杨先生">';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtanbb">';
                                    $html.='<p>与墓位使用人关系：</p>';
                                    $html.='<select>';
                                        $html.='<option>其他</option>';
                                    $html.='</select>';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtanc">';
                                $html.='<div class="djtanca">';
                                    $html.='<p>联系电话：</p>';
                                    $html.='<input type="text" value="*">';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtancb">';
                                    $html.='<p>家庭住址：</p>';
                                    $html.='<input type="text">';
                                    $html.='<i></i>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="djtand">';
                   $html.=' <form>';
                        $html.='<fieldset>';
                            $html.='<legend>来访信息</legend>';
                            $html.='<div class="djtanda">';
                                $html.='<div class="djtandq">';
                                    $html.='<p>渠道1：</p>';
                                    $html.='<select>';
                                       $html.=' <option>自然客</option>';
                                   $html.=' </select>';
                                    $html.='<i></i>';
                                $html.='</div>';
                                $html.='<div class="djtandq">';
                                   $html.=' <p>渠道2：</p>';
                                   $html.=' <select>';
                                        $html.='<option>转介绍</option>';
                                   $html.=' </select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                                $html.='<div class="djtandq">';
                                    $html.='<p>渠道3：</p>';
                                    $html.='<select>';
                                        $html.='<option>购墓家属介绍</option>';
                                    $html.='</select>';
                                    $html.='<i>*</i>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtandb">';
                               $html.=' <div class="djtandbt">';
                                    $html.='<p>来访日期：</p>';
                                    $html.='<select>';
                                        $html.='<option>2018年06月20日 09:35:28</option>';
                                    $html.='</select>';
                                $html.='</div>';
                                $html.='<div class="djtandbta">';
                                    $html.='<div class="djtanbtle">';
                                       $html.=' <p>来访次数：</p>';
                                       $html.=' <select>';
                                           $html.=' <option>首次</option>';
                                        $html.='</select>';
                                    $html.='</div>';
                                    $html.='<div class="djtanbtri">';
                                        $html.='<p>来访人数：</p>';
                                       $html.=' <input type="text" value="3">';
                                       $html.=' <i>*</i>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="djtandbtb"> ';                                
                                   $html.=' <p>来访方式：</p>';
                                    $html.='<select>';
                                       $html.=' <option>自驾</option>';
                                    $html.='</select>';
                                $html.='</div>';
                           $html.=' </div>';
                           $html.=' <div class="djtandc">';
                                $html.='<div class="djtandca">';
                                    $html.='<p>咨询电话：</p>';
                                    $html.='<select>';
                                        $html.='<option>无</option>';
                                    $html.='</select>';
                                $html.='</div>';
                                $html.='<div class="djtandca">';
                                   $html.=' <p>接待员：</p>';
                                    $html.='<select>';
                                        $html.='<option>陈丽波</option>';
                                    $html.='</select>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="djtancj">';
                    $html.='<form>';
                        $html.='<fieldset>';
                            $html.='<legend>成交情况：</legend>';
                            $html.='<div class="djtancja">';
                                $html.='<div class="djtancjale">';
                                    $html.='<p>成交情况：</p>';
                                    $html.='<select>';
                                        $html.='<option>成交</option>';
                                    $html.='</select>';
                                $html.='</div>';
                                $html.='<div class="djtancjari">';
                                    $html.='<p>成交(未成交)原因：</p>';
                                    $html.='<select>';
                                        $html.='<option>无</option>';
                                    $html.='</select>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="djtancjb">';
                                $html.='<p>成交日期：</p>';
                                $html.='<select>';
                                    $html.='<option>2018年06月20日 09:35:28</option>';
                                $html.='</select>';
                            $html.='</div>';
                            $html.='<div class="djtancjc">';
                                $html.='<div class="djtancjcle">';
                                    $html.='<p>接待记录：</p>';
                                    $html.='<textarea>迁移夫妻</textarea>';
                                $html.='</div>';
                                $html.='<div class="djtancjcri">';
                                    $html.='<p>备注：</p>';
                                    $html.='<textarea>成交一份两座</textarea>';
                                $html.='</div>';
                            $html.='</div>   ';                       
                        $html.='</fieldset>';
                    $html.='</form>';
                $html.='</div>';
                $html.='<div class="djtancz">';
                    $html.='<div class="djtancza">';
                       $html.=' <form>';
                            $html.='<fieldset>';
                               $html.=' <legend>操作提示</legend>';
                            $html.='</fieldset>';
                        $html.='</form>';
                    $html.='</div>';
                    $html.='<div class="djtanczb" onclick="jcwdg('.$arr['id'].')" style="cursor:pointer">保存客户来访信息</div>';
                $html.='</div>';
            $html.='</div>';
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
        if (self::strict(false)->insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
