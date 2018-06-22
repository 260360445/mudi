<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Otm;
use think\Cache;


class Deposit extends Root {

    protected $table = 'role';


    static public function wlist () {
        return self::select();
    }


    static public function id2sm () {
        return self::column('id, title, discount, sn', 'id');
    }
    static public function edit ($id, $title, $sn = '', $discount, $auth) {

        try {
            self::startTrans();
            $Otm = new Otm(1);
            $update = ['title' => $title, 'sn' => $sn, 'discount' => $discount];
            self::where('id', (int)$id)->update($update);
            $Otm->del_by_one($id);
            $Otm->adds($id, $auth);
            self::commit();
            return RE_SUCCESS;
        } catch (\Exception $e) {
            self::rollback();
            return RE_ERROR;
        }
    }

    static public function add ($title, $discount) {
        if (self::insert([ 'title' => $title, 'discount'  => $discount]) ) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

}
