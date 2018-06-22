<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Auth extends Root {

    protected $table = 'auth';

    public function aa () {
        wcc($this->where('id', 1)->where('name', '22')->select());
    }

    static public function wlist () {
        return self::select();
    }
    static public function get_key ($s) {
        return '';
    }

    static public function get_top_meun () {

        return self::get_meun(0);
    }

    static public function get_left_meun ($pid) {

        return self::get_meun($pid);
    }

    static public function path_info ($path) {
        return  self::where('client_path', $path)->find();
    }

    static public function get_left_meun_by_path ($path) {
        $e = self::where('client_path', $path)->find();
        if ($e['pid']) {
            return self::get_meun($e['pid']);
        }
        return self::get_meun($e['id']);
    }

    static public function get_first_son_by_path ($path) {
        $pid = self::where('client_path', $path)->value('id');
        return self::where('pid', $pid)->order(ORDER, 'desc')->value('client_path');
    }

    static public function get_meun ($pid = 0) {
        $key = 'get_meun_' . session('role_id') . '_' . $pid;
        if (CACHE_OPEN && $list = Cache::get($key)) {
            return $list;
        }
        $list = self::alias('a')
            ->join('otm b', 'a.id = b.mk', 'RIGHT')
            ->where('a.is_menu', 1)
            ->where('a.pid', $pid)
            ->where('b.ok', session('role_id'))
            ->where('b.type', 1)
            ->order('a.' . ORDER, 'desc')
            ->order('a.id', 'asc')
            ->column('a.id, a.pid, a.name, a.client_path');
        Cache::set($key, $list);
        return $list;
    }

    // 将 权限放进缓存
    static public function auth_push_in_cache ($id) {
        $key = 'role_' . $id;
        if (CACHE_OPEN && $data = Cache::get($key)) {
            return $data;
        }
        $data = self::alias('a')
        ->join('otm b', 'a.id = b.mk', 'RIGHT')
        ->where('b.ok', $id)
        ->column('a.id');
        Cache::set($key, $data);
        return $data;
    }
}
