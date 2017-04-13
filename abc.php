<?php

//通过curl实现向 http://web.0911.com/curl/a.php 做请求，
//同时传递post参数
echo "this is abc<br />";

$url = "http://web.0911.com/curl/a.php";
$arr = array(
    'host'=>'localhost',
    'user'=>'root'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); //设置请求地址
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回请求的信息
// 我们在POST数据哦！
curl_setopt($ch, CURLOPT_POST, 1);
// 把post的变量加上
curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
$output = curl_exec($ch);
curl_close($ch);
echo $output;