<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Otm extends Root {

    protected $table = 'otm';
    protected $_type;

    public function __construct ($type) {
        parent::__construct();
        $this->_type = $type;
    }

    public function adds ($one_id, $many_ids = []) {
        if (!$many_ids) {
            return true;
        }
        $data_list = [];
        foreach ($many_ids as $many) {
            $data_list[] = [
                'ok'  => $one_id,
                'mk' => $many,
                'type' => $this->_type,
            ];
        }
        if ($data_list &&  $this->insertAll($data_list)) {
            return true;
        }
        return false;
    }

    public function del_by_one ($one) {
        return $this->where('ok', $one)->where('type', $this->_type)->delete() !== false;
    }
}
