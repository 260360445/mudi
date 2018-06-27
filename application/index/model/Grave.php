<?php
namespace app\index\model;

use app\index\model\Root;

class Grave extends Root {

    // protected $autoWriteTimestamp = 'datetime';

    protected $table = 'grave';

    static public function wlist ($map = []) {
        return self::where($map)->order('time', 'asc')->column('*', 'id');
    }
    static public function del ($ids) {
        if (empty($ids) || !count($ids) ) {
            return ['status' => false, 'msg' => '请选择要删除的寄存位'];
        }
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
        if (!(int)$info['sysid_c']) {
            return ['status' => false, 'msg' => '请选择寄存层'];
        }
        if (!(int)$info['sysysid']) {
            return ['status' => false, 'msg' => '请寄存位样式'];
        }
       if (empty($info['money'])) {
            return ['status' => false, 'msg' => '请填写价格'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if (self::where('id', $id)->update($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function add ($info) {
        if (empty($info['settime'])) {
            return ['status' => false, 'msg' => '请填选择来访时间'];
        }
        if (empty($info['num'])) {
            return ['status' => false, 'msg' => '请填写来访份数'];
        }
        if (empty($info['prop'])) {
            return ['status' => false, 'msg' => '请填写来访人数'];
        }
        if($info['djlx'] == '3'){
            $info['status']=$info['setsta'];
        }
        $info['time']=time();
        $info['time']=strtotime($info['settime']);
        if (self::insert($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
