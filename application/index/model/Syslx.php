<?php
namespace app\index\model;

use app\index\model\Root;

class Syslx extends Root {

    protected $table = 'sys_list_l';
    
    static public function wlist () {
        return self::order('time', 'asc')->column('*', 'id');
    }
     static public function wlists ($sysid) {
        return self::order('id', 'asc')->where($sysid)->select();
    }
    static public function del ($id) {

        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($id, $info) {
        if (!(int)$info['sysysid']) {
            return ['status' => false, 'msg' => '请选择材质'];
        }
        if (empty($info['cd'])) {
            return ['status' => false, 'msg' => '请填写长度'];
        }
        if (empty($info['wd'])) {
            return ['status' => false, 'msg' => '请填写宽度'];
        }
        if (empty($info['hd'])) {
            return ['status' => false, 'msg' => '请填写高度'];
        }
        if (empty($info['price'])) {
            return ['status' => false, 'msg' => '请填写价格'];
        }
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }
        $info['time']=time();
        if (self::where('id', $id)->update($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }


    static public function add ($info) {
        if (!(int)$info['sysysid']) {
            return ['status' => false, 'msg' => '请选择材质'];
        }
        if (empty($info['cd'])) {
            return ['status' => false, 'msg' => '请填写长度'];
        }
        if (empty($info['wd'])) {
            return ['status' => false, 'msg' => '请填写宽度'];
        }
        if (empty($info['hd'])) {
            return ['status' => false, 'msg' => '请填写高度'];
        }
        if (empty($info['price'])) {
            return ['status' => false, 'msg' => '请填写价格'];
        }
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }
        $info['time']=time();
        if (self::insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

}
