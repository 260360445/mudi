<?php
namespace app\index\model;

use app\index\model\Root;

class Glist extends Root {

    protected $table = 'glist';
    
    static public function wlist () {
        return self::order('time', 'asc')->column('id, title, price, type ,cont,sn', 'id');
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

    static public function add ($info) {
        $data_list = [];
        foreach ($info['item'] as $key => $value) {
            $e = self::table('gset')->where('id', $value['id'])->find();
            $data_list[] = ['title' => $e['title'], 'price' => $e['price'], 'sn' => $e['sn'], 'num' => $value['num'], 'roleid' => $info['roleid']];
        }
        if (count($data_list) && self::insertAll($data_list) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
