<?php
namespace app\index\model;

use app\index\model\Root;

class ComeChannel extends Root {

    protected $table = 'come_channel';

    static public function wlist ($map = []) {
        return self::where($map)->column('id, sn, desc, title, pid, ppid', 'id');
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
        if (self::insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
