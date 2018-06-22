<?php
namespace app\index\model;

use app\index\model\Root;
use think\Cache;

class Auth extends Root {

    protected $table = 'auth';

    static public function get_key ($s) {
        return '';
    }

    static public function get_meun () {
        $key = 'auth_all_meun';
        if (CACHE_OPEN && $list = Cache::get($key)) {
            return $list;
        }
        $list = self::where('is_munu', 1)->order('id', 'asc')->column('pid, name, client_path');
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
