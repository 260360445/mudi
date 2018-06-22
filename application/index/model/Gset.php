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
}
