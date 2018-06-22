<?php
namespace app\index\model;

use app\index\model\Root;
use app\index\model\Auth;
use think\Cache;

class Staff extends Root {

    protected $table = 'staff';

    static public function login ($account, $pwd) {
        if (!$data = self::where('account', $account)->find()) {
            return ['status' => false, 'msg' => '用户不存在!'];
        }

        if ($data['pwd'] != encrypt($pwd, $data['salt'])) {
            return ['status' => false, 'msg' => '密码错误!'];
        }

        if (!$data['status']) {
            return ['status' => false, 'msg' => '该用户已被禁用!无法登录!'];
        }
        $auth = Auth::auth_push_in_cache($data['role_id']);
        $passport = get_passport();
        Cache::set($passport, $data);
        return ['status' => true, 'msg' => '登录成功!', 'passport' => $passport, 'auth' => $auth];
    }
}
