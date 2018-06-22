<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function cem_status($k) {
    return [
        0 => 38, // 空墓
        1 => 39, // 已预定
        2 => 44, // 已购买
    ][$k];
}
function t($v) {
    return empty($v) && $v;
}
function dttm () {
    return date('Y-m-d H:i:s');
}

function get_url () {
    return 'http://' . $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}

function  numtozm($n) {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $arr = str_split(string($n));
    $e = '';
    // for ($)
}

// 随机生成 salt
function salt () {
    $str = 'QWERTYUIOPASDFGHJKLZXCVBNMmnbvczlkjhgfdsapoiuytrewq';
    $r   = '';
    $n   = strlen($str) - 1;
    for ($i = 0; $i < 4; $i++) {
        $r .= $str[rand(0, $n)];
    }
    return $r;
}

function getDaysByMonth($unix){
    $month = date('m', $unix);
    $year = date('Y', $unix);
    $nextMonth = (($month+1)>12) ? 1 : ($month+1);
    $year      = ($nextMonth>12) ? ($year+1) : $year;
    $days   = date('d',mktime(0,0,0,$nextMonth,0,$year));
    return $days;
}

function format_sn ($v) {
    return $v;
}
function is_ajax() {
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest") return true;
}

// 密码加密
function encrypt($pwd, $salt) {
    return md5(md5($pwd.$salt));
}

function wcc ($v) {
    dump($v);exit;
}

function get_client_ip($type = 0) {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($_SERVER['HTTP_X_REAL_IP']){//nginx 代理模式下，获取客户端真实IP
        $ip=$_SERVER['HTTP_X_REAL_IP'];
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}


// 生成,, 登陆密钥 随机字符-md5(ip)-时间戳
function get_passport () {
    return random(32) . md5(get_client_ip()) . random(32);
}

/**
 * 随机字符
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string
 */
function random($length=6, $type='string', $convert=0){
    $config = array(
        'number'=>'1234567890',
        'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if(!isset($config[$type])) $type = 'string';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) -1;
    for($i = 0; $i < $length; $i++){
        $code .= $string{mt_rand(0, $strlen)};
    }
    if(!empty($convert)){
        $code = ($convert > 0)? strtoupper($code) : strtolower($code);
    }
    return $code;
}
