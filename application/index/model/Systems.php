<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Systems extends Root
{

    protected $table = 'sys_list_y';

    public function wlist () {
        return self::order('time', 'asc')->column('*', 'id');
    }

    public function tlist($type) {
        return $this->where('type', $type)->order(ORDER, 'DESC')->field('id, title, sn, ' . ORDER)->column('*', 'id');
    }

    // id => title
    public function id2tit () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->column('id, title');
    }

    //[id => title]
    public function id8tit ($id) {
        return $this->where(['id'=>$id['id']])->field('id, title,')->select();
    }

    public function add ($title) {
        $data['time']=time();
        $data['title']=$title;
        if (self::insert($data) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }
       
    // public function edit ($data) {
    //     if ($this->where('id', $data['id'])->update([ 'title' => $data['title'], 'sn'  => $data['sn'] ?? '' ]) !== false) {
    //         return $this->tpl_return_true();
    //     }
    //     return $this->tpl_return_false();
    // }

    static public function edit ($id, $info) {
        if (self::where('id', $id)->update($info) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    public function del (int $id) {
        if (self::where('id', $id)->delete()) {
             return RE_SUCCESS;
        }
        return RE_ERROR;
    }
}
