<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Tpl extends Root
{

    protected $table = 'tpl';
    protected $type;

    public function __construct ($type) {
        // parent::__construct();
        $this->type = $type;
    }

    public function wlist () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->field('id, title, sn, ' . ORDER)->select();
    }
    public function wlists () {
        return self::order(ORDER, 'DESC')->column('*', 'id');
    }
    public function tlist($type) {
        return self::where('type', $type)->order(ORDER, 'DESC')->field('id, title, sn, ' . ORDER)->column('*', 'id');
    }

    // id => title
    public function id2tit () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->column('id, title');
    }

    //[id => title]
    public function id8tit () {
        return $this->where('type', $this->type)->order(ORDER, 'DESC')->field('id, title')->select();
    }

    public function add ($title) {
        if ($this->insert([ 'title' => $title, 'type'  => $this->type]) ) {
            return $this->tpl_return_true();
        }
        return $this->tpl_return_false();
    }

    // public function edit ($data) {
    //     if ($this->where('id', $data['id'])->update([ 'title' => $data['title'], 'sn'  => $data['sn'] ?? '' ]) !== false) {
    //         return $this->tpl_return_true();
    //     }
    //     return $this->tpl_return_false();
    // }

    public function edit ($id, $title, $sn = '') {
        $update = [ 'title' => $title, 'sn' => $sn];
        // $order !== null && $update[ORDER] = (int)$order;
        if ($this->where('id', (int)$id)->where('type', $this->type)->update($update) !== false) {
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

    public function tname () {
        $arr = [
            '2' => '墓位样式',
            '8' => '墓位型号',
            '3' => '墓位材料',
            '9' => '墓位状态',
            '4' => '与故者关系',
            '5' => '来访方式',
            '6' => '未成交原因',
            '7' => '交易情况',
            '10' => '墓位安葬类型',
            '11' => '成交情况',
            '12' => '来访渠道',
            '13' => '来访次数',
            '14' => '咨询电话',
        ];
        return $arr[$this->type];
    }
}
