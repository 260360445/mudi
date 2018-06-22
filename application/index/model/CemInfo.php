<?php
namespace app\index\model;

use app\index\model\Root;

class CemInfo extends Root {

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    // protected $autoWriteTimestamp = 'datetime';

    protected $table = 'cem_info';

    static public function wlist ($map = []) {
        return self::where($map)->order('cem_id', 'asc')->column('*', 'id');
    }

    static public function del ($ids) {
        if (empty($ids) || !count($ids) ) {
            return ['status' => false, 'msg' => '请选择要删除的墓位'];
        }
        if (self::where('id', 'in', $ids)->delete() !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function edit ($info) {
        if (empty($info['ids']) || !count($info['ids']) ) {
            return ['status' => false, 'msg' => '请选择要修改的墓位'];
        }

        $feild = [
            // 'cem_id',
            // 'cem_area_id',
            // 'cem_row_id',
            'price',
            'material',
            'style',
            'model',
            'status',
            'length',
            'width',
            'acreage',
        ];
        $update = [];
        // $long_title = self::long_title($info['cem_id'], $info['cem_area_id'], $info['cem_row_id']);
        if (!empty($info['e_all']) && $info['e_all'] ) {
            foreach ($feild as $v) {

                $update[$v] = $info[$v];
            }
        } else {
            foreach ($feild as $v) {
                if (!empty($info['e_' . $v]) && $info['e_' . $v] ) {
                    $update[$v] = $info[$v];
                }
            }
        }
        // wcc($update);
        foreach ($info['ids'] as $id) {
            if (self::where('id', $id)->update($update) === false) {
                return RE_ERROR;
            }
        }

        return RE_SUCCESS;
    }

    static public function set_status ($id, $val) {

        if (self::where('id', $id)->update(['status' => $val]) !== false) {
            return RE_SUCCESS;
        }
        return RE_ERROR;
    }

    static public function long_title ($cem_id, $area_id, $row_id) {
        $e = '';
        $e .= self::table('cem')->where('id', $cem_id)->value('title');
        $e .= '-';
        $e .= self::table('cem_area')->where('id', $area_id)->value('title');
        $e .= '-';
        $e .= self::table('cem_row')->where('id', $area_id)->value('title');
        $e .= '-';
        return $e;
    }

    static public function add ($info) {
        if (!(int)$info['cem_id']) {
            return ['status' => false, 'msg' => '请选择墓园'];
        }
        if (!(int)$info['cem_area_id']) {
            return ['status' => false, 'msg' => '请选择墓区'];
        }
        if (!(int)$info['cem_row_id']) {
            return ['status' => false, 'msg' => '请选择墓排'];
        }
        if ($info['type'] == 'one' && empty($info['title'])) {
            return ['status' => false, 'msg' => '请填写名称'];
        }

        if ($info['type'] == 'many' && (empty($info['many_start']) ||  empty($info['many_num']))) {
            return ['status' => false, 'msg' => '请填写开始编号和数量'];
        }
        $long_title = self::long_title($info['cem_id'], $info['cem_area_id'], $info['cem_row_id']);
        if ($info['type'] == 'one'  && self::insert([
                'title'          => $info['title'],
                'long_title'     => $long_title . $info['title'],
                'cem_id'         => $info['cem_id'],
                'cem_area_id'    => $info['cem_area_id'],
                'cem_row_id'     => $info['cem_row_id'],
                'style'          => $info['style'],
                'material'       => $info['material'],
                'model'          => $info['model'],
                'status'         => $info['status'],
                'length'         => $info['length'],
                'width'          => $info['width'],
                'acreage'        => $info['acreage'],
                'price'        => $info['price'],
                'create_time'    => dttm(),
                'create_by'    => session('id'),
            ]) !== false) {
            return RE_SUCCESS;
        }
        if ($info['type'] == 'many') {
            $data_list = [];
            for ($i = (int)$info['many_start']; $i <= (int)$info['many_num']; $i++) {
                $data_list[] = [
                        'long_title'     => $long_title . $i . '号',
                        'title'          => $i . '号',
                        'cem_id'         => $info['cem_id'],
                        'cem_area_id'    => $info['cem_area_id'],
                        'cem_row_id'     => $info['cem_row_id'],
                        'style'          => $info['style'],
                        'material'       => $info['material'],
                        'model'          => $info['model'],
                        'status'         => $info['status'],
                        'length'         => $info['length'],
                        'width'          => $info['width'],
                        'acreage'        => $info['acreage'],
                        'price'        => $info['price'],
                        'create_time'    => dttm(),
                        'create_by'    => session('id'),
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
