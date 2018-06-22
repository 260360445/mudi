<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Tpl extends Root
{

    protected $table = 'tpl';
    protected $type;

    public function __construct ($type) {
        $this->type = $type;
    }

    public function wlist () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->field('id, title, ' . ORDER)->select();
    }

    // id => title
    public function id2tit () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->column('id, title');
    }

    //[id => title]
    public function id8tit () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->field('id, title')->select();
    }

    public function add ($title, $order) {
        if ($this->insert([ 'title' => $title, 'type'  => $this->type, ORDER => $order]) ) {
            return $this->tpl_return_true();
        }
        return $this->tpl_return_false();
    }

    public function edit ($id, $title, $order) {
        $update = [ 'title' => $title];
        $order !== null && $update[ORDER] = (int)$order;
        if ($this->where('id', (int)$id)->where('type', $this->type)->update($update) ) {
            return $this->tpl_return_true();
        }
        return $this->tpl_return_false();
    }

    public function del (int $id) {
        if ($this->where('id', $id)->where('type', $this->type)->delete()) {
            return $this->tpl_return_true();
        }
        return $this->tpl_return_false();
    }

}
