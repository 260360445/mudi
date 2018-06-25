<?php
namespace app\index\model;

use app\index\model\Root;

class Dead extends Root {

    protected $table = 'dead';

    static public function wlist ($map = []) {
        return self::whereOr($map)->column('*', 'id');
    }

    static public function plist ($map = []) {
        return self::where($map)->paginate(20);
    }
    static public function cnt ($map = []) {
        return self::where($map)->count();
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


    static public function vlog_add () {
        $_POST['create_time'] = date('Y-m-d H:i:s');
        // wcc($_POST);
        return self::strict(false)->insertGetId($_POST);
    }


}
