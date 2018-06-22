<?php
namespace app\index\model;

use app\index\model\Root;

class Systemc extends Root {

    protected $table = 'sys_list_c';
    
    static public function wlist ($map = []) {
        return self::order('sysid', 'asc')->column('id, sysid, sysid_s, title ,num', 'id');
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
        if (!(int)$info['sysid']) {
            return ['status' => false, 'msg' => '请选择寄存厅'];
        }
        if (!(int)$info['sysid_s']) {
            return ['status' => false, 'msg' => '请选择寄存室'];
        }
        if (empty($info['title'])) {
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

    static public function add ($info) {
        if (!(int)$info['sysid']) {
            return ['status' => false, 'msg' => '请选择寄存厅'];
        }
        if (!(int)$info['sysid_s']) {
            return ['status' => false, 'msg' => '请选择寄存室'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        if ($info['type'] == 'one'  && self::insert(['title' => $info['title'], 'sysid' => $info['sysid'], 'sysid_s' => $info['sysid_s'], 'num' => $info['num']]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['num']; $i++) {
                $data_list[] = ['title' => $i . '排', 'sysid' => $info['sysid'], 'sysid_s' => $info['sysid_s'], 'num' => $info['num']];
            }
            if (count($data_list) && self::insertAll($data_list) !== false) {
                return RE_SUCCESS;
            }

        }
        return RE_ERROR;
    }

}
