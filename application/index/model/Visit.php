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
