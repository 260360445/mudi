<?php
namespace app\index\controller;

use app\index\model\Tpl as _Tpl;
use app\index\model\Cem as _Cem;
use app\index\model\CemArea as _Area;
use app\index\model\CemRow as _Row;
use app\index\model\CemInfo as _Info;
use app\index\model\Staff as _Staff;
use app\index\controller\Root;

class Cem  extends Root {

    public function wlist ($type = 0, $pid = 0) {
        $tab = [
            '墓园设置',
            '墓区设置',
            '墓排设置',
            '墓位设置',
        ];
        $this->assign('tab', $tab);
        $this->assign('type', $type);

        $this->assign('cem_list', _Cem::wlist());

        switch ($type) {
            case 0:
                return $this->cem();
                break;
            case 1:
                return $this->area();
                break;

            case 2:
                return $this->row();
                break;

            case 3:
                return $this->info();
                break;

            default:
                return $this->cem();
                break;
        }
        return $this->fetch();
    }

    public function cem () {
        return $this->fetch('cem/cem');
    }

    public function cem_edit () {
        $e = _Cem::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function cem_add () {
        $e = _Cem::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function cem_del ($id) {
        return _Cem::del($id);
    }

    public function area () {
        $this->assign('area_list', _Area::wlist());
        return $this->fetch('cem/area');
    }

    public function area_wlist ($cem_id) {
        return _Area::wlist(['cem_id' => $cem_id]);
    }

    public function area_add () {
        // wcc($_POST);
        $e = _Area::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function area_del ($id) {
        return _Area::del($id);
    }

    public function area_edit () {
        $e = _Area::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function row () {
        $this->assign('area_list', _Area::wlist());
        $this->assign('row_list', _Row::wlist());
        return $this->fetch('cem/row');
    }

    public function row_wlist ($cem_area_id) {
        return _Row::wlist(['cem_area_id' => $cem_area_id]);
    }

    public function row_add () {
        $e = _Row::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function row_del ($id) {
        return _Row::del($id);
    }

    public function row_edit () {
        $e = _Row::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function info () {
        $Tpl = new _Tpl(1);
        $this->assign('cem_model', $Tpl->tlist(8));
        $this->assign('cem_mat', $Tpl->tlist(3));
        $this->assign('cem_sty', $Tpl->tlist(2));
        $this->assign('cem_status', $Tpl->tlist(9));
        return $this->fetch('cem/info');
    }

    public function info_add () {
        // wcc($_POST);
        $e = _Info::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function info_del ($ids) {
        return   _Info::del($ids);
    }

    public function info_edit () {
        // wcc($_POST);
        $e = _Info::edit($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function info_wlist_html ($cem_id = null, $cem_area_id = null, $cem_row_id = null, $style_id = null, $status = null, $status_id = null, $mb = 0 ) {
        error_reporting(0);
        $this->view->engine->layout(false);
        $Tpl = new _Tpl(1);
        $this->assign('cem_model', $Tpl->tlist(8));
        $this->assign('cem_mat', $Tpl->tlist(3));
        $this->assign('cem_sty', $Tpl->tlist(2));
        $this->assign('cem_status', $Tpl->tlist(9));
        $this->assign('cem_list', _Cem::wlist());
        $this->assign('area_list', _Area::wlist());
        $this->assign('row_list', _Row::wlist());
        $this->assign('staff_list', _Staff::id2tit());

        $map = [];
        if ($cem_id) {
            $map['cem_id'] = $cem_id;
        }
        if ($cem_area_id) {
            $map['cem_area_id'] = $cem_area_id;
        }
        if ($cem_row_id) {
            $map['cem_row_id'] = $cem_row_id;
        }

        if ($style_id) {
            $map['style'] = $style_id;
        }

        if ($status) {
            $map['status'] = $status;
        }
        if ($status_id) {
            $map['status'] = $status_id;
        }
        $list =  _Info::wlist($map);
        $this->assign('list', $list);

        $_mb = [
            'cem/info_html_list',
            'tomb/info_sale_html_list',
            'tomb/info_tending_html_list',

        ];
        return $this->fetch($_mb[$mb]);
    }

}
