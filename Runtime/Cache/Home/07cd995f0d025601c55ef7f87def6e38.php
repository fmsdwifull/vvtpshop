<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title>登录商城</title>
            <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>base.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>global.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>header.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>footer.css" type="text/css" />
            <meta property="qc:admins" content="2666047133605411516633" />
            
            <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>jquery-1.8.3.min.js"></script>
    </head>
    <body>
        <!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">
            
        </div>
        <div class="topnav_right fr">
            <?php if(!empty($_SESSION['user_name'])): ?><ul>
                <li>您好，【<?php echo (session('user_name')); ?>】欢迎来到京西！[<a href="<?php echo U('User/logout');?>">退出系统</a>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>
            </ul>
            <?php else: ?>
            <ul>
                <li>您好，欢迎来到京西！<?php session_start(); $_SESSION['username'] ?>[<a href="<?php echo U('User/login');?>">登录</a>] [<a href="<?php echo U('User/regist');?>">免费注册</a>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>
            </ul><?php endif; ?>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<!--引入公共的jquery-->
<!--<script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>Js/jquery-1.11.3.min.js"></script> -->
<!--引入公共的jquery-->


        <div style="clear:both;"></div>

        <!-- 页面头部 start -->
        <div class="header w990 bc mt15">
            <div class="logo w990">
                <h2 class="fl"><a href="index.html"><img src="<?php echo (C("IMG_URL")); ?>logo.png" alt="京西商城"></a></h2>

                <?php if((CONTROLLER_NAME) == "Shop"): if((ACTION_NAME) == "showlist"): ?><div class="flow fr">
                    <ul>
                        <li class="cur">1.我的购物车</li>
                        <li>2.填写核对订单信息</li>
                        <li>3.成功提交订单</li><?php endif; ?>
                <?php if((ACTION_NAME) == "showorder"): ?><div class="flow fr flow2">
                    <ul>
                        <li>1.我的购物车</li>
                        <li class="cur">2.填写核对订单信息</li>
                        <li>3.成功提交订单</li><?php endif; ?>                

                    </ul>
                </div><?php endif; ?>

            </div>
        </div>
        <!-- 页面头部 end -->

        
        <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>cart.css" type="text/css">

<div style="clear:both;"></div>
<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
	<h2><span>我的购物车</span></h2>
	<table>
		<thead>
			<tr>
				<th class="col1">商品名称</th>
				<th class="col3">单价</th>
				<th class="col4">数量</th>	
				<th class="col5">小计</th>
				<th class="col6">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($cartinfo)): foreach($cartinfo as $key=>$v): ?><tr id="goods_cart_<?php echo ($v["goods_id"]); ?>">
				<td class="col1" style='text-align:center;'><strong><a href=""><?php echo ($v["goods_name"]); ?></a></strong></td>
				<td class="col3">￥<span><?php echo ($v["goods_price"]); ?></span></td>
	<td class="col4"> 
		<a href="javascript:;" onclick="modify_num(<?php echo ($v["goods_id"]); ?>,'reduce')" class="reduce_num"></a>
		<input type="text" id='goods_number_<?php echo ($v["goods_id"]); ?>' name="amount" value="<?php echo ($v["goods_number"]); ?>" class="amount" onchange="modify_num(<?php echo ($v["goods_id"]); ?>,'mod')"/>
		<a href="javascript:;" onclick="modify_num(<?php echo ($v["goods_id"]); ?>,'add')" class="add_num"></a>
	</td>
				<td class="col5">￥<span id='xiaoji_<?php echo ($v["goods_id"]); ?>'><?php echo ($v["goods_total_price"]); ?></span></td>
				<td class="col6"><a href="javascript:if(confirm('确认要删除此购物车商品么？')){del_cart(<?php echo ($v["goods_id"]); ?>)}">删除</a></td>
			</tr><?php endforeach; endif; ?>
<script type="text/javascript">
//购物车商品数量变化
//参数：flag=add/reduce/mod
function modify_num(goods_id,flag){
	//获得商品目前的数量
	var now_num = parseInt($('#goods_number_'+goods_id).val());
	if(flag == 'add'){
		var after_num = now_num+1;
	}else if(flag == 'reduce'){
		var after_num = now_num-1;
	}else if(flag == 'mod'){
		var after_num = now_num;
	}else{
		return false;
	}

	if(after_num < 1){
		alert('数量必须大于1个');
		return false;
	}

	//触发ajax，走服务器端，使得购物车数量做递减
	$.ajax({
		url:"<?php echo U('Shop/modifyNum');?>",
		data:{'goods_id':goods_id,'after_num':after_num},
		dataType:'json',
		type:'get',
		success:function(msg){
			//显示增加后数量
			$('#goods_number_'+goods_id).val(after_num);
			//显示小计价格
			$('#xiaoji_'+goods_id).html(msg.ji_price);
			//显示总计价格
			$('#total').html(msg.zong_price);			
			//显示购物车商品总数量
			$('#totalnum').html(msg.zong_number);
		}
	});
}


//删除购物车商品
function del_cart(goods_id){
	//通过ajax无刷新方式删除购物车商品
	$.ajax({
		url:"<?php echo U('Shop/delCart');?>",
		data:{'goods_id':goods_id},
		dataType:'json',
		type:'get',
		success:function(msg){
			//删除页面对应的信息
			$('#goods_cart_'+goods_id).remove();

			//把最新的购物车商品总价格显示出来
			$('#total').html(msg.price);//price在Cart.class.php的getNumberPrice过来的
		}
	});
}
</script>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6">商品总数量：<span id='totalnum'><?php echo ($number_price["number"]); ?></span>&nbsp;&nbsp;&nbsp;购物金额总计： <strong>￥ <span id="total"><?php echo ($number_price["price"]); ?></span></strong></td>
			</tr>
		</tfoot>
	</table>
	<div class="cart_btn w990 bc mt10">
		<a href="" class="continue">继续购物</a>
		<a href="<?php echo U('showorder');?>" class="checkout">结 算</a>
	</div>
</div>
<!-- 主体部分 end -->

<div style="clear:both;"></div>


        <div style="clear:both;"></div>
        <!-- 底部版权 start -->
        <div class="footer w1210 bc mt15">
            <p class="links">
                <a href="">关于ta们</a> |
                <a href="">联系我们</a> |
                <a href="">人才招聘</a> |
                <a href="">商家入驻</a> |
                <a href="">千寻网</a> |
                <a href="">奢侈品网</a> |
                <a href="">广告服务</a> |
                <a href="">移动终端</a> |
                <a href="">友情链接</a> |
                <a href="">销售联盟</a> |
                <a href="">京西论坛</a>
            </p>
            <p class="copyright">
                © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
            </p>
            <p class="auth">
                <a href=""><img src="<?php echo (C("IMG_URL")); ?>xin.png" alt="" /></a>
                <a href=""><img src="<?php echo (C("IMG_URL")); ?>kexin.jpg" alt="" /></a>
                <a href=""><img src="<?php echo (C("IMG_URL")); ?>police.jpg" alt="" /></a>
                <a href=""><img src="<?php echo (C("IMG_URL")); ?>beian.gif" alt="" /></a>
            </p>
        </div>
        <!-- 底部版权 end -->
    </body>
</html>