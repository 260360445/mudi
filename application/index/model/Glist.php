<?php
namespace app\index\model;

use app\index\model\Root;

class Glist extends Root {

    protected $table = 'glist';
    
    static public function wlist () {
        return self::order('time', 'asc')->column('id,title,price,sta,staffid,time', 'id');
    }
    static public function wlistf ($map) {
        return self::where($map)->where(['sta'=>2])->order('time', 'asc')->column('*', 'id');
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
    static public function set ($info) {
        if (empty($info['id'])) {
            return ['status' => false, 'msg' => '请选择信息'];
        }
        if (self::where('id', $info['id'])->update(['sta'=>2]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
    static public function add ($info) {
        $data_list = [];
        foreach ($info['item'] as $key => $value) {
            $e = self::table('gset')->where('id', $value['id'])->find();
            $data_list[] = ['gsetid'=>$value['id'],'title' => $e['title'], 'price' => $e['price'], 'sn' => $e['sn'], 'num' => $value['num'], 'staffid' => $info['staffid'],'sta'=>3,'time'=>time()];
        }
        if (count($data_list) && self::insertAll($data_list) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
