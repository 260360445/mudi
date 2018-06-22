<?php
namespace app\index\model;

use app\index\model\Root;

class Sysjcw extends Root {

    // protected $autoWriteTimestamp = 'datetime';

    protected $table = 'sys_mw';

    static public function wlist ($map = []) {
        return self::where($map)->order('sysid', 'asc')->column('*', 'id');
    }
    static public function wlists ($sysid) {
        return self::order('sysid', 'asc')->where($sysid)->select();
    }
    static public function wlisty ($map = []) {
        return self::where($map)->where(['syszt'=>2])->order('sysid', 'asc')->column('*', 'id');
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

    static public function set_status ($id, $val) {

        if (self::where('id', $id)->update(['status' => $val]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function long_title ($cem_id, $area_id, $row_id) {
        $e = '';
        $e .= self::table('sys_list')->where('id', $cem_id)->value('title');
        $e .= '-';
        $e .= self::table('sys_list_s')->where('id', $area_id)->value('title');
        $e .= '-';
        $e .= self::table('sys_list_c')->where('id', $row_id)->value('title');
        $e .= '-';
        return $e;
    }

    static public function add ($info) {
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

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['many_num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        $long_title = self::long_title($info['sysid'], $info['sysid_s'], $info['sysid_c']);
        if ($info['type'] == 'one'  && self::insert([
                'title'          => $info['title'],
                'long_title'     => $long_title . $info['title'],
                'sysid'         => $info['sysid'],
                'sysid_s'    => $info['sysid_s'],
                'sysid_c'     => $info['sysid_c'],
                'syszt'     => $info['syszt'],
                'money'     => $info['money'],
                'sysysid'       => $info['sysysid'],
                'time'          => time(),
            ]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['many_num']; $i++) {
                $data_list[] = [
                        'long_title'     => $long_title . $i . '号',
                        'title'          => $i . '号',
                        'sysid'         => $info['sysid'],
                        'sysid_s'    => $info['sysid_s'],
                        'sysid_c'     => $info['sysid_c'],
                        'money'          => $info['money'],
                        'syszt'     => $info['syszt'],
                        'sysysid'       => $info['sysysid'],
                        'time'          => time(),
                    ];
            }
            if (count($data_list) && self::insertAll($data_list) !== false) {
                return RE_SUCCESS;
            }

        }
        return RE_ERROR;
    }


    public function long_name ($id) {
        $e =  self::alias('a')
            ->join('contacts b','a.contacts_id = b.id')
            ->where('a.id', $id)->find();
    }

}
