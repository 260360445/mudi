<?php
namespace app\index\controller;

use app\index\controller\Root;
use app\index\model\Auth as _Auth;
use app\index\model\System as _System;
use app\index\model\Systemt as _Systemt;
use app\index\model\Systemc as _Systemc;
use app\index\model\Systems as _Systems;
use app\index\model\Syslx as _Syslx;
use app\index\model\Sysjcw as _Sysjcw;
use app\index\model\Tpl as _Tpl;
use think\Request;
class System  extends Root {
	//寄存厅
    public function sysjc () {
    	$this->assign('sys_list', _System::wlist());
        return $this->fetch();
    }

    
     public function sysjc_edit () {
     	// 获取上传文件信息
        if(!empty($_FILES['img']['name'])){//处理上传的文件
            foreach($_FILES as $key => $files){
                if(!empty($_FILES[$key]['name'])){
                    $_POST[$key] = $this->uploads($key);
                }   
            }
        }
        $e = _System::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function sysjc_add () {
	 	// 获取上传文件信息
        if(!empty($_FILES['img']['name'])){//处理上传的文件
            foreach($_FILES as $key => $files){
                if(!empty($_FILES[$key]['name'])){
                    $_POST[$key] = $this->uploads($key);
                }   
            }
        }
        $e = _System::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysjc_del ($id) {
        return _System::del($id);
    }
    //寄存室
    public function sysjct () {
    	$this->assign('sys_list', _System::wlist());
    	$this->assign('sys_list_s', _Systemt::wlist());
        return $this->fetch();
    }
     public function sysjct_edit () {
        $e = _Systemt::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }

    public function sysjct_add () {
        $e = _Systemt::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysjct_del ($id) {
        return _Systemt::del($id);
    }
    //寄存层
    public function sysjcc () {
    	$this->assign('sys_list', _System::wlist());
    	$this->assign('sys_list_s', _Systemt::wlist());
    	$this->assign('sysjcc', _Systemc::wlist());
        return $this->fetch();
    }
     public function sysjcc_edit () {
        $e = _Systemc::edit($_POST['id'], $_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysjcc_add () {
        $e = _Systemc::add($_POST);
        if ($e['status']) {
            return $this->success($e['msg']);
        }
        return $this->error($e['msg']);
    }
    public function sysjcc_wlist ($cem_id) {
        return _Systemt::wlists(['sysid' => $cem_id]);
    }
    public function sysjcc_del ($id) {
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
    





    /*public function  upload ()
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
    }*/
    

}
