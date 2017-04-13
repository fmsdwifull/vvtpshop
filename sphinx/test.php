<?php
// --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------
header("content-type:text/html;charset=utf-8");
require ( "sphinxapi.php" );

$cl = new SphinxClient ();
$cl->SetServer ( '127.0.0.1', 9312);

$key = "前进学校";
$indexName = "dizhi";

$cl->SetArrayResult ( true );
//$cl->SetMatchMode ( SPH_MATCH_PHRASE); //"完整"关键字匹配(一条记录里边至少有一个完整的)
$cl->SetMatchMode ( SPH_MATCH_ANY);    //进行"分词"查询
//$res = $cl->Query ( 关键字, 索引名称 );
$cl -> setLimits(0,100); //根据页码方式获得信息
$res = $cl->Query ( $key, $indexName );

if(!empty($res['matches'])){
    printf("<div>查询了%d条信息，耗费<span style='color:blue;font-size:25px;'>%s</span>秒，被查询的关键字：%s</div>",$res['total'],$res['time'],$key);
    //连接数据库，根据返回的id获得具体信息
    $link = mysql_connect('localhost','root','123456');
    mysql_select_db('shop0911',$link);
    mysql_query('set names utf8');

    $ids = array();
    foreach($res['matches'] as $k => $v){
        $ids[] = $v['id'];
    }
    $ids = implode(',',$ids); //array-->String

    $sql = "select id,comname,comaddress from address where id in ($ids)";
    $qry = mysql_query($sql);
    $i = 1;
    while($z = mysql_fetch_assoc($qry)){
        //$row = $cl->buildExcerpts(被处理信息，索引名称，关键字，高亮标签)
        $row = $cl->buildExcerpts($z,$indexName,$key,array(
            'before_match'=>"<span style='color:red;'>",   
            'after_match' =>"</span>",   
            ));
        //最后$row是“索引数组”形式返回结果
        echo "<p>".$i++.":".$row[1]."------".$row[2]."</p>";
    }
}else {
    echo "<div>没有符合要求的结果</div>";
}

