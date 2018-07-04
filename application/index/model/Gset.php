<?php
namespace app\index\model;

use app\index\model\Root;

class Gset extends Root {

    protected $table = 'gset';
    
    static public function wlist () {
        return self::order('time', 'asc')->column('id, title, price, type ,cont,sn', 'id');
    }
    static public function wlists ($sysid) {
        return self::order('sysid', 'asc')->where($sysid)->select();
    }
    static public function wlist_hlist ($sysid) {
        return self::table('gset_hlist')->order('id', 'desc')->select();
    }
    static public function del ($id) {

        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($id, $info) {
         if (!(int)$info['sn']) {
            return ['status' => false, 'msg' => '请填写物品编号'];
        }
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写物品名称'];
        }
        if (empty($info['price'])) {
            return ['status' => false, 'msg' => '请填写物品单价'];
        }
        if (empty($info['type'])) {
            return ['status' => false, 'msg' => '请填写物品单位名称'];
        }
        if (empty($info['cont'])) {
            return ['status' => false, 'msg' => '请填写物品简介'];
        }
        if (self::where('id', $id)->update($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function add ($info) {
        if (!(int)$info['sn']) {
            return ['status' => false, 'msg' => '请填写物品编号'];
        }
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写物品名称'];
        }
        if (empty($info['price'])) {
            return ['status' => false, 'msg' => '请填写物品单价'];
        }
        if (empty($info['type'])) {
            return ['status' => false, 'msg' => '请填写物品单位名称'];
        }
        if (empty($info['cont'])) {
            return ['status' => false, 'msg' => '请填写物品简介'];
        }
        if (self::insert(['title' => $info['title'], 'sn' => $info['sn'], 'price' => $info['price'], 'type' => $info['type'], 'cont' => $info['cont']]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function gset_set_hlist($info){
        $sys_list_l = self::table('sys_list_l')->where(['id'=>$info['id']])->find();
        if (self::table('gset_hlist')->insert(['title' => $sys_list_l['title'], 'cd' => $sys_list_l['cd'], 'wd' => $sys_list_l['wd'], 'hd' => $sys_list_l['hd'], 'price' => $sys_list_l['price'], 'sysysid' => $sys_list_l['sysysid'], 'time' => time(), 'staffid' => $info['staffid'], 'sta' =>3]) !== false) {
            return RE_SUCCESS;
        }
       return RE_ERROR;
    }
    static function finan_set_hlist($info){
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::table('gset_hlist')->where('id', $info['id'])->update(['sta'=>2]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    
}
