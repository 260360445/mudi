<?php
namespace app\index\model;

use app\index\model\Root;

class Systemt extends Root {

    protected $table = 'sys_list_s';


    static public function wlist () {
        return self::order('sysid', 'asc')->column('id, sysid, title ,num', 'id');
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
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写编号'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        if ($info['type'] == 'one'  && self::insert(['title' => $info['title'], 'sysid' => $info['sysid'], 'num' => $info['num']]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['num']; $i++) {
                $data_list[] = ['title' => $i . '区', 'sysid' => $info['sysid']];
            }
            if (count($data_list) && self::insertAll($data_list) !== false) {
                return RE_SUCCESS;
            }

        }
        return RE_ERROR;
    }

}
