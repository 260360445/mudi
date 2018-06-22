<?php
define('ORDER', 'order_by_id');
define('DOSUCCESS', '操作成功');
define('DOERROR', '操作失败');
define('CACHE_OPEN', false);
define('RE_ERROR', ['status' => false, 'msg' => DOERROR]);
define('RE_SUCCESS', ['status' => true, 'msg' => DOSUCCESS]);
define('_STATUS', ['已禁用', '已启用']);


return [
    'view_replace_str' => [
        '__CSS__' => '/index/css',
        '__JS__' => '/index/js',
        '__IMG__' => '/index/images',
        '__IMGG__' => '/index/img',
        '__UPLAD__' => '/uploads/',
    ],



    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'home',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',

        'layout_on'     =>  true,

        'layout_name'   =>  'layout',

    ],

];
