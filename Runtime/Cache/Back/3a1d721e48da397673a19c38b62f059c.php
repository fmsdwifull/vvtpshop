<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>Js/jquery-1.11.3.min.js"></script> 
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：<?php echo ($bread["first"]); ?>-》<?php echo ($bread["second"]); ?></span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo ($bread["linkTo"]["1"]); ?>"><?php echo ($bread["linkTo"]["0"]); ?></a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px; margin: 10px 5px;">
    <table class="table_a" border="1" width="100%">
        <tbody><tr style="font-weight: bold;">
                <td>序号</td><td>名称</td>
                <td>上级id</td>
                <td>全路径</td><td>等级</td>
                <td align="center" colspan='2'>操作</td>
            </tr>
            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                <td><?php echo ($v["cat_id"]); ?></td>
                <td><?php echo str_repeat('***/',$v['cat_level']); echo ($v["cat_name"]); ?></td>
                <td><?php echo ($v["cat_pid"]); ?></td>
                <td><?php echo ($v["cat_path"]); ?></td>
                <td><?php echo ($v["cat_level"]); ?></td>
                <td><a href="" >修改</a></td>
                <td><a href="javascript:;" >删除</a></td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>


        </body>
</html>