<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\Gset as _Gset;
use app\index\model\Glist as _Glist;
use app\index\model\Role as _Role;
use think\Request;
class Finan  extends Root {
	//墓位预订收费确认
    public function muwei () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //墓位预订退订确认
    public function muweit () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //墓位定购收费确认
    public function muweis () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //墓位定购退购确认
    public function muweist () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
    //碑文杂费收费确认
    public function muweiz () {
        $this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }

    //寄存位收费确认
    public function syslist () {
    	$this->assign('glist', _Gset::wlist());
        return $this->fetch();
    }
     public function gset_edit () {
        $e = _Gset::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function gset_add () {
        $e = _Gset::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function gset_del ($id) {
        return _Gset::del($id);
    }


    //物品销售
    public function glist () {
    	$this->assign('glist', _Glist::wlist());
        $this->assign('role', _Role::id2sm());
        return $this->fetch();
    }
    //物品销售确认 
    public function finan_set_glist () {
        
        $e = _Glist::set($_POST);
        if ($e['status']) {
            return '2';
        }
        return '3';
    }

    //骨灰盒销售
    public function hlist () {
    	
        return $this->fetch();
    }
     public function hlist_edit () {
        $e = _Systemc::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function hlist_add () {
        $e = _Systemc::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function hlist_del ($id) {
        return _Systemc::del($id);
    }

   //寄存样式
    public function sysys() {
        $this->assign('sysys', _Systems::wlist());
        return $this->fetch();
    }
    public function sysys_edit () {
        $e = _Systems::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysys_add () {
        $e = _Systems::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysys_del ($id) {
        return _Systems::del($id);
    }
    //寄存类型
    public function syslx() {
        $this->assign('sysys', _Tpl::tlist(3));
        $this->assign('sysyst', _Tpl::wlists());
        $this->assign('sysls', _Syslx::wlist());
        return $this->fetch();
    }
    public function syslx_add () {
        $e = _Syslx::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function syslx_edit () {
        $e = _Syslx::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function syslx_del ($id) {
        return _Syslx::del($id);
    }
    //寄存位
     public function sysjcw () {
    	$this->assign('sys_list', _System::wlist());
    	$this->assign('sys_list_s', _Systemt::wlist());
    	$this->assign('sysjcc', _Systemc::wlist());
    	$this->assign('sysys', _Systems::wlist());
        $this->assign('sysls', _Syslx::wlist());
        $request = Request::instance();
        $cem_id = $request->only(['cem_id']);
        $cem_area_id = $request->only(['cem_area_id']);
        $cem_row_id = $request->only(['cem_row_id']);
        $map = [];
        if ($cem_id['cem_id']) {
            $map['sysid'] = $cem_id['cem_id'];
        }
        if ($cem_area_id['cem_area_id']) {
            $map['sysid_s'] = $cem_area_id['cem_area_id'];
        }
        if ($cem_row_id['cem_row_id']) {
            $map['sysid_c'] = $cem_row_id['cem_row_id'];
        }
        $this->assign('sysjcw', _Sysjcw::wlist($map));
        return $this->fetch();
    }
     public function sysjcw_edit () {
        $e = _Sysjcw::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function sysjcw_add () {
        $e = _Sysjcw::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysjcw_del ($id) {
        return _Sysjcw::del($id);
    }
    public function sysjcw_wlist ($cem_id) {
        return _Systemc::wlists(['sysid_s' => $cem_id]);
    }
    public function sysjcw_wlist_l ($cem_id) {
        return _Syslx::wlists(['sysysid' => $cem_id]);
    }





    public function  upload ()
    {

        $src = '';
        if ($_POST) {

            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                $src =  $info->getSaveName();
            }
        }
        $this->assign('src', $src);
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    

}
