<?php
    $ch = curl_init();

    $url  = 'http://db.cc/index.php/index/Game/sbqgm';
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch , CURLOPT_URL , $url);  // 执行HTTP请求
    $res = curl_exec($ch);
