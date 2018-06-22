<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Tpl as _Tpl;
use app\index\model\ComeChannel as _Channel;
use app\index\model\Contacts as _Contacts;
use app\index\model\Staff as _Staff;
use app\index\model\Visit as _Visit;

class Contacts  extends Root {

    public function _initialize() {
        parent::_initialize();
        $this->assign('t1', _Channel::t1());
        $this->assign('t2', _Channel::t2());
        $this->assign('t3', _Channel::t3());

        $Tpl = new _Tpl(4);
        $this->assign('relationship', $Tpl->wlist());
        $this->assign('tel', $Tpl->tlist(14));
        $this->assign('come_num', $Tpl->tlist(13));
        $this->assign('come_fun', $Tpl->tlist(5));
        $this->assign('no_transaction_ps', $Tpl->tlist(6));
        $this->assign('staff', _Staff::id2tit());
    }

    public function wlist ($wh = '') {
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
