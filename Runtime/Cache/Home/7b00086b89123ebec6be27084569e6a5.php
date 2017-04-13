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

        
        <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>login.css" type="text/css" />
<!-- 登录主体部分start -->
<div class="login w990 bc mt10">
    <div class="login_hd">
        <h2>用户登录</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
            <form action="/vvtpshop/index.php/Home/User/login.html" method="post">
                <ul>
                    <li>
                        <label for="">用户名：</label>
                        <input type="text" class="txt" name="user_name" />
                    </li>
                    <li>
                        <label for="">密码：</label>
                        <input type="password" class="txt" name="user_pwd" />
                        <a href="">忘记密码?</a>
                    </li>

                    <li>
                        <label for="">&nbsp;</label>
                        <input type="checkbox" class="chb"  /> 保存登录信息
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <input type="submit" value="" class="login_btn" />
                    </li>
                </ul>
            </form>
<script type="text/javascript">
function open_qq(){
    window.open("/Plugin/qq/oauth/qq_login.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
</script>
            <div class="coagent mt15">
                <dl>
                    <dt>使用合作网站登录商城：</dt>
                    <dd class="qq"><a href="javascript:open_qq()"><span></span>QQ</a></dd>
                    <dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
                    <dd class="yi"><a href=""><span></span>网易</a></dd>
                    <dd class="renren"><a href=""><span></span>人人</a></dd>
                    <dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
                    <dd class=""><a href=""><span></span>百度</a></dd>
                    <dd class="douban"><a href=""><span></span>豆瓣</a></dd>
                </dl>
            </div>
        </div>

        <div class="guide fl">
            <h3>还不是商城用户</h3>
            <p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

            <a href="regist.html" class="reg_btn">免费注册 >></a>
        </div>
    </div>
</div>
<!-- 登录主体部分end -->



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