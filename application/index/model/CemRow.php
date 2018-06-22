<?php
namespace app\index\model;

use app\index\model\Root;

class CemRow extends Root {

    protected $table = 'cem_row';
    
    static public function wlist ($map = []) {
        return self::where($map)->order('cem_id', 'asc')->column('id, cem_id, cem_area_id, title ', 'id');
    }

    static public function del ($id) {

        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($id, $info) {
        if (!(int)$info['cem_id']) {
            return ['status' => false, 'msg' => '请选择墓园'];
        }
        if (!(int)$info['cem_area_id']) {
            return ['status' => false, 'msg' => '请选择墓区'];
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
        if (!(int)$info['cem_id']) {
            return ['status' => false, 'msg' => '请选择墓园'];
        }
        if (!(int)$info['cem_area_id']) {
            return ['status' => false, 'msg' => '请选择墓区'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['many_num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        if ($info['type'] == 'one'  && self::insert(['title' => $info['title'], 'cem_id' => $info['cem_id'], 'cem_area_id' => $info['cem_area_id']]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['many_num']; $i++) {
                $data_list[] = ['title' => $i . '排', 'cem_id' => $info['cem_id'], 'cem_area_id' => $info['cem_area_id']];
            }
            if (count($data_list) && self::insertAll($data_list) !== false) {
                return RE_SUCCESS;
            }

        }
        return RE_ERROR;
    }

}
