<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Tpl as _Tpl;
use app\index\model\ComeChannel as _Channel;
use app\index\model\Contacts as _Contacts;
use app\index\model\Staff as _Staff;
use app\index\model\Visit as _Visit;
use app\index\model\Cem as _Cem;
use app\index\model\CemInfo as _Info;
use app\index\model\Dead as _Dead;

class Tomb  extends Root {

    public function _initialize() {
        parent::_initialize();
        $this->assign('t1', _Channel::t1());
        $this->assign('t2', _Channel::t2());
        $this->assign('t3', _Channel::t3());
        $this->assign('cem_list', _Cem::wlist());
        $Tpl = new _Tpl(2);
        $this->assign('cem_style', $Tpl->tlist(2));
        $this->assign('cem_material', $Tpl->tlist(3));
        $this->assign('cem_status', $Tpl->tlist(9));
        $this->assign('come_num', $Tpl->tlist(13));
        $this->assign('come_fun', $Tpl->tlist(5));
        $this->assign('no_transaction_ps', $Tpl->tlist(6));
        $this->assign('staff', _Staff::id2tit());
    }

    public function www_list ($wh = '') {
        $map = [];
        if ($wh) {

            $map['name']         =  ['like', '%' .$wh. '%'];
            $map['email']        =  ['like', '%' .$wh. '%'];
            $map['address']      =  ['like', '%' .$wh. '%'];
            $map['workplace']    =  ['like', '%' .$wh. '%'];
            // $map['_logic'] = 'or';
            $this->assign('list', _Contacts::wlist($map));
        } else {
            $this->assign('list', _Contacts::plist($map));
        }
        $this->assign('wh', $wh);
        $this->assign('count', _Contacts::cnt($map));


    }

    public function sale ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function sale_info ($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function sale_sling_words ($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function tending ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }


    public function  tending_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  tending_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }


    public function buyed ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function  buyed_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  buyed_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function used ($wh = '') {
        $this->www_list($wh);
        return $this->fetch();
    }

    public function  used_tc1($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function  used_tc2($id = '') {
        $data = _Info::get($id);
        if ($data['contacts_id']) {
            $contacts = Contacts::get($data['contacts_id']);
        }

        $this->assign('contacts', $contacts ?? []);
        $this->assign('dead', _Dead::where('cem_info_id', $id)->select());
        $this->assign('data', $data);
        $this->assign('pay_status', _Info::pay_status());
        $this->view->engine->layout(false);
        return $this->fetch();
    }


    public function visit_push () {
        if ($_POST) {
            $e = _Visit::add($_POST);
            if ($e['status']) {
                return $this->success($e['msg']);
            }
            return $this->error($e['msg']);
        }

        return $this->fetch();
    }

    public function visit_log ($wh = '') {
        $map = [];
        if ($wh) {

            $map['b.name']         =  ['like', '%' .$wh. '%'];
            $map['b.email']        =  ['like', '%' .$wh. '%'];
            $map['b.address']      =  ['like', '%' .$wh. '%'];
            $map['b.workplace']    =  ['like', '%' .$wh. '%'];
            // $map['_logic'] = 'or';
            $this->assign('list', _Visit::wlist($map));
        } else {
            $this->assign('list', _Visit::plist($map));
        }
        $this->assign('count', _Visit::cnt($map));
        $this->assign('wh', $wh);
        return $this->fetch();
    }
    public function t1 () {
        return $this->fetch();
    }

    public function t2 () {
        error_reporting(0);
        return $this->fetch();
    }

    public function t3 () {
        error_reporting(0);
        return $this->fetch();
    }

    public function tlist ($pid = 0, $ppid = 0) {
        $map = ['ppid' => 0];
        $pid &&  $map['pid'] = $pid;
        $ppid &&  $map['ppid'] = $ppid;
        return _Channel::wlist($map);
    }

    public function edit () {
        $e = _Channel::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function add () {
        // wcc($_POST);
        $e = _Channel::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function del ($id) {
        return _Channel::del($id);
    }

    public function set_status ($id, $val) {
        return _Channel::set_status($id, $val);
    }

}
