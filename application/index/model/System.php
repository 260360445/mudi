<?php
namespace app\index\model;

use app\index\model\Root;

class System extends Root {

    protected $table = 'sys_list';



    static public function wlist () {
        return self::column('id, title, cont,img', 'id');
    }

    static public function del ($id) {

        if (self::where('id', $id)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($id, $info) {
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写寄存厅名称'];
        }
        if (empty($info['cont'])) {
            return ['status' => false, 'msg' => '请填写简介'];
        }
        if (empty($info['img'])) {
            return ['status' => false, 'msg' => '请上传图片'];
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
        if (empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写寄存厅名称'];
        }
        if (empty($info['cont'])) {
            return ['status' => false, 'msg' => '请填写简介'];
        }
        if (empty($info['img'])) {
            return ['status' => false, 'msg' => '请上传图片'];
        }
        if (self::insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
