<?php
$link = mysql_connect('localhost','root','123456');
mysql_select_db('shop0911',$link);
mysql_query('set names utf8');
//mysql_query("LOCK TABLES `product` WRITE");
$fp = fopen('./lock.txt','r');//lock.txt文件，存在即可，其他不要求
flock($fp,LOCK_EX);
    //每个人可以购买3个小米
    //查询数量，判断是否支持下单
    $sql = "select number from product";
    $qry = mysql_query($sql);
    $z = mysql_fetch_assoc($qry);
    $num = $z['number'];

    //判断库存是否支持下单，并更新库存
    //支持下单的情况
    $num = $num-3;
    $sql = "update product set number=$num";
    $qry = mysql_query($sql);
flock($fp,LOCK_UN);
fclose($fp);
//mysql_query("UNLOCK TABLES");