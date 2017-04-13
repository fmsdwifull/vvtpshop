<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>header.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>index.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>footer.css" type="text/css">

    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>header.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>index.js"></script>
    <meta property="qc:admins" content="2666047133605411516633" />
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
                <li>您好，欢迎来到京西！[<a href="<?php echo U('User/login');?>">登录</a>] [<a href="<?php echo U('User/regist');?>">免费注册</a>] </li>
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

    <!-- 头部 start -->
    <div class="header w1210 bc mt15">
        <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
        <div class="logo w1210">
            <h1 class="fl"><a href="index.html"><img src="<?php echo (C("IMG_URL")); ?>logo.png" alt="京西商城"></a></h1>
            <!-- 头部搜索 start -->
            <div class="search fl">
                <div class="search_form">
                    <div class="form_left fl"></div>
                    <form action="" name="serarch" method="get" class="fl">
                        <input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
                    </form>
                    <div class="form_right fl"></div>
                </div>
                
                <div style="clear:both;"></div>

                <div class="hot_search">
                    <strong>热门搜索:</strong>
                    <a href="">D-Link无线路由</a>
                    <a href="">休闲男鞋</a>
                    <a href="">TCL空调</a>
                    <a href="">耐克篮球鞋</a>
                </div>
            </div>
            <!-- 头部搜索 end -->

            <!-- 用户中心 start-->
            <div class="user fl">
                <dl>
                    <dt>
                        <em></em>
                        <a href="">用户中心</a>
                        <b></b>
                    </dt>
                    <dd>
                        <div class="prompt">
                            您好，请<a href="">登录</a>
                        </div>
                        <div class="uclist mt10">
                            <ul class="list1 fl">
                                <li><a href="">用户信息></a></li>
                                <li><a href="">我的订单></a></li>
                                <li><a href="">收货地址></a></li>
                                <li><a href="">我的收藏></a></li>
                            </ul>

                            <ul class="fl">
                                <li><a href="">我的留言></a></li>
                                <li><a href="">我的红包></a></li>
                                <li><a href="">我的评论></a></li>
                                <li><a href="">资金管理></a></li>
                            </ul>

                        </div>
                        <div style="clear:both;"></div>
                        <div class="viewlist mt10">
                            <h3>最近浏览的商品：</h3>
                            <ul>
                                <li><a href=""><img src="<?php echo (C("IMG_URL")); ?>view_list1.jpg" alt="" /></a></li>
                                <li><a href=""><img src="<?php echo (C("IMG_URL")); ?>view_list2.jpg" alt="" /></a></li>
                                <li><a href=""><img src="<?php echo (C("IMG_URL")); ?>view_list3.jpg" alt="" /></a></li>
                            </ul>
                        </div>
                    </dd>
                </dl>
            </div>
            <!-- 用户中心 end-->

            <!-- 购物车 start -->
            <div class="cart fl">
                <dl>
                    <dt>
                        <a href="<?php echo U('Shop/showlist');?>">去购物车结算</a>
                        <b></b>
                    </dt>
                    <dd>
                        <div class="prompt">
                            购物车中还没有商品，赶紧选购吧！
                        </div>
                    </dd>
                </dl>
            </div>
            <!-- 购物车 end -->
        </div>
        <!-- 头部上半部分 end -->
        
        <div style="clear:both;"></div>

        <!-- 导航条部分 start -->
        <div class="nav w1210 bc mt10">
<?php if(CONTROLLER_NAME== 'Index' and ACTION_NAME== 'index'): ?><!--  商品分类部分 start-->
    <div class="category fl"> <!-- 非首页，需要添加cat1类 -->
        <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
            <h2>全部商品分类</h2>
            <em></em>
        </div>
        <div class="cat_bd">
<?php else: ?>
    <!--  商品分类部分 start-->
    <div class="category fl cat1"> <!-- 非首页，需要添加cat1类 -->
        <div class="cat_hd off">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
            <h2>全部商品分类</h2>
            <em></em>
        </div>
        <div class="cat_bd none"><?php endif; ?>

<?php if(is_array($cat_infoA)): foreach($cat_infoA as $key=>$v): ?><div class="cat item1">
    <h3><a href="<?php echo U('Goods/showlist',array('cat_id'=>$v['cat_id']));?>"><?php echo ($v["cat_name"]); ?></a> <b></b></h3>
        <div class="cat_detail">
    <?php if(is_array($cat_infoB)): foreach($cat_infoB as $key=>$vv): if(($vv['cat_pid']) == $v['cat_id']): ?><dl class="dl_1st">
            <dt><a href="<?php echo U('Goods/showlist',array('cat_id'=>$vv['cat_id']));?>"><?php echo ($vv["cat_name"]); ?></a></dt>
            <dd>
                <?php if(is_array($cat_infoC)): foreach($cat_infoC as $key=>$vvv): if(($vvv['cat_pid']) == $vv['cat_id']): ?><a href="<?php echo U('Goods/showlist',array('cat_id'=>$vvv['cat_id']));?>"><?php echo ($vvv["cat_name"]); ?></a><?php endif; endforeach; endif; ?>
            </dd>
        </dl><?php endif; endforeach; endif; ?>
        </div>
</div><?php endforeach; endif; ?>

                </div>

            </div>
            <!--  商品分类部分 end--> 

            <div class="navitems fl">
                <ul class="fl">
                    <li class="current"><a href="<?php echo U('Index/index');?>">首页</a></li>
                    <li><a href="">电脑频道</a></li>
                    <li><a href="">家用电器</a></li>
                    <li><a href="">品牌大全</a></li>
                    <li><a href="">团购</a></li>
                    <li><a href="">积分商城</a></li>
                    <li><a href="">夺宝奇兵</a></li>
                </ul>
                <div class="right_corner fl"></div>
            </div>
        </div>
        <!-- 导航条部分 end -->
    </div>
    <!-- 头部 end-->
    
    


<link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>goods.css" type="text/css">
<link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>common.css" type="text/css">
<!--引入jqzoom css -->
<link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>jqzoom.css" type="text/css">
<script type="text/javascript" src="<?php echo (C("JS_URL")); ?>goods.js"></script>
<script type="text/javascript" src="<?php echo (C("JS_URL")); ?>jqzoom-core.js"></script>
<!-- jqzoom 效果 -->
<script type="text/javascript">
    $(function(){
        $('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false,
            title:false,
            zoomWidth:400,
            zoomHeight:400
        });
    })
</script>


<div style="clear:both;"></div>


<!-- 商品页面主体 start -->
<div class="main w1210 mt10 bc">
    <!-- 面包屑导航 start -->
    <div class="breadcrumb">
        <h2>当前位置：<a href="">首页</a> >  
        <?php if(is_array($catinfo)): foreach($catinfo as $key=>$v): ?><a href="">&nbsp;<?php echo ($v["cat_name"]); ?>&nbsp;</a> ><?php endforeach; endif; ?>
        <?php echo ($info["goods_name"]); ?></h2>
    </div>
    <!-- 面包屑导航 end -->
    
    <!-- 主体页面左侧内容 start -->
    <div class="goods_left fl">
        <!-- 相关分类 start -->
        <div class="related_cat leftbar mt10">
            <h2><strong>相关分类</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <?php if(is_array($other_catinfo)): foreach($other_catinfo as $key=>$v): ?><li><a href=""><?php echo ($v["cat_name"]); ?></a></li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <!-- 相关分类 end -->

        <!-- 相关品牌 start -->
        <div class="related_cat leftbar mt10">
            <h2><strong>同类品牌</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li><a href="">D-Link</a></li>
                    <li><a href="">戴尔</a></li>
                    <li><a href="">惠普</a></li>
                    <li><a href="">苹果</a></li>
                    <li><a href="">华硕</a></li>
                    <li><a href="">宏基</a></li>
                    <li><a href="">神舟</a></li>
                </ul>
            </div>
        </div>
        <!-- 相关品牌 end -->

        <!-- 热销排行 start -->
        <div class="hotgoods leftbar mt10">
            <h2><strong>热销排行榜</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
        <!-- 热销排行 end -->


        <!-- 浏览过该商品的人还浏览了  start 注：因为和list页面newgoods样式相同，故加入了该class -->
        <div class="related_view newgoods leftbar mt10">
            <h2><strong>浏览了该商品的用户还浏览了</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>relate_view1.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad E431(62771A7) 14英寸笔记本电脑 (i5-3230 4G 1TB 2G独显 蓝牙 win8)</a></dd>
                            <dd><strong>￥5199.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>relate_view2.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad X230i(2306-3V9） 12.5英寸笔记本电脑 （i3-3120M 4GB 500GB 7200转 蓝牙 摄像头 Win8）</a></dd>
                            <dd><strong>￥5199.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>relate_view3.jpg" alt="" /></a></dt>
                            <dd><a href="">T联想（Lenovo） Yoga13 II-Pro 13.3英寸超极本 （i5-4200U 4G 128G固态硬盘 摄像头 蓝牙 Win8）晧月银</a></dd>
                            <dd><strong>￥7999.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>relate_view4.jpg" alt="" /></a></dt>
                            <dd><a href="">联想（Lenovo） Y510p 15.6英寸笔记本电脑（i5-4200M 4G 1T 2G独显 摄像头 DVD刻录 Win8）黑色</a></dd>
                            <dd><strong>￥6199.00</strong></dd>
                        </dl>
                    </li>

                    <li class="last">
                        <dl>
                            <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>relate_view5.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad E530c(33662D0) 15.6英寸笔记本电脑 （i5-3210M 4G 500G NV610M 1G独显 摄像头 Win8）</a></dd>
                            <dd><strong>￥4399.00</strong></dd>
                        </dl>
                    </li>                   
                </ul>
            </div>
        </div>
        <!-- 浏览过该商品的人还浏览了  end -->

        <!-- 最近浏览 start -->
        <div class="viewd leftbar mt10">
            <h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
            <div class="leftbar_wrap">
                <dl>
                    <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>hpG4.jpg" alt="" /></a></dt>
                    <dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
                </dl>

                <dl class="last">
                    <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>crazy4.jpg" alt="" /></a></dt>
                    <dd><a href="">直降200元！TCL正1.5匹空调</a></dd>
                </dl>
            </div>
        </div>
        <!-- 最近浏览 end -->

    </div>
    <!-- 主体页面左侧内容 end -->
    
    <!-- 商品信息内容 start -->
    <div class="goods_content fl mt10 ml10">
        <!-- 商品概要信息 start -->
        <div class="summary">
            <h3><strong><?php echo ($info["goods_name"]); ?></strong></h3>
            
<!-- 图片预览区域 start -->
<div class="preview fl">
    <div class="midpic">
        <a href="<?php echo (C("SITE_URL")); echo ($goodspics[0]['pics_big']); ?>" class="jqzoom" rel="gal1">   <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
            <img src="<?php echo (C("SITE_URL")); echo ($goodspics[0]['pics_mid']); ?>" alt="" />               <!-- 第一幅图片的中图 -->
        </a>
    </div>

    <!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

    <div class="smallpic">
        <a href="javascript:;" id="backward" class="off"></a>
        <a href="javascript:;" id="forward" class="on"></a>
        <div class="smallpic_wrap">
            <ul>
                <?php if(is_array($goodspics)): foreach($goodspics as $kkk=>$vvv): if(($kkk) == "0"): ?><li class='cur'>
                        <a class="zoomThumbActive" href="javascript:void(0);" 
                        rel="{gallery: 'gal1', smallimage: '<?php echo (C("SITE_URL")); echo ($vvv["pics_mid"]); ?>',largeimage: '<?php echo (C("SITE_URL")); echo ($vvv["pics_big"]); ?>'}">  
                    <?php else: ?>
                    <li>
                        <a href="javascript:void(0);" 
                        rel="{gallery: 'gal1', smallimage: '<?php echo (C("SITE_URL")); echo ($vvv["pics_mid"]); ?>',largeimage: '<?php echo (C("SITE_URL")); echo ($vvv["pics_big"]); ?>'}"><?php endif; ?>
                    <img src="<?php echo (C("SITE_URL")); echo ($vvv["pics_small"]); ?>"></a>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>
        
    </div>
</div>
<!-- 图片预览区域 end -->

            <!-- 商品基本信息区域 start -->
            <div class="goodsinfo fl ml10">
                <ul>
                    <li><span>商品编号： </span>971344</li>
                    <li class="market_price"><span>定价：</span><em>￥<?php echo ($info["goods_price"]); ?></em></li>
                    <li class="shop_price"><span>本店价：</span> <strong>￥<?php echo ($info["goods_shop_price"]); ?></strong> <a href="">(降价通知)</a></li>
                    <li><span>上架时间：</span><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></li>
                    <li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->
                </ul>
                <form action="" method="post" class="choose">
                    <ul>
    <?php if(is_array($attrinfoT)): foreach($attrinfoT as $key=>$v): ?><li class="product">
        <dl>
            <dt><?php echo ($v["attr_name"]); ?>：</dt>
            <dd>
                <?php if(is_array($v['attr_value'])): foreach($v['attr_value'] as $kk=>$vv): if(($kk) == "0"): ?><a href="javascript:;" class='selected'>
                <?php else: ?>
                <a href="javascript:;"><?php endif; ?>
                <?php echo ($vv); ?> 
                <input type="radio" name="color" value="<?php echo ($vv); ?>"  /></a><?php endforeach; endif; ?>
            </dd>
        </dl>
    </li><?php endforeach; endif; ?>

                        
                        <li>
                            <dl>
                                <dt>购买数量：</dt>
                                <dd>
                                    <a href="javascript:;" id="reduce_num"></a>
                                    <input type="text" name="amount" value="1" class="amount"/>
                                    <a href="javascript:;" id="add_num"></a>
                                </dd>
                            </dl>
                        </li>

<li>
    <dl>
        <dt>&nbsp;</dt>
        <dd>
            <input type="button" value="" class="add_btn" onclick='add_cart(<?php echo ($info["goods_id"]); ?>)' />
        </dd>
    </dl>
</li>
                    </ul>
                </form>
            </div>
            <!-- 商品基本信息区域 end -->
        </div>
        <!-- 商品概要信息 end -->
        <script type='text/javascript'>
        //购物车添加商品
        function add_cart(goods_id){
            //ajax无刷新方式向服务器端做请求
            $.ajax({
                url:"<?php echo U('Shop/addCart');?>",
                data:{'goods_id':goods_id},
                dataType:'json',
                type:'get',
                success:function(msg){
                    //把返回的总数量、总价格显示到购物车弹框里边
                    $('#goods_number').html(msg.number);
                    $('#goods_totalprice').html(msg.price);
                    //alert(msg);
                    //给购物车弹出框设置显示位置
                    $('#cartBox').css('top',590);
                    $('#cartBox').css('left',720);
                    //显示购物车弹框
                    $('#cartBox').show();
                }
            });
        }
        </script>
        
        <div style="clear:both;"></div>

        <!-- 商品详情 start -->
        <div class="detail">
            <div class="detail_hd">
                <ul>
                    <li class="first on"><span>商品介绍</span></li>
                    <li><span>商品评价</span></li>
                    <li><span>售后保障</span></li>
                </ul>
            </div>
            <div class="detail_bd">
                <!-- 商品介绍 start -->
                <div class="introduce detail_div">
                    <div class="attr mt15">
                        <ul>
                            <li><span>商品名称：</span><?php echo ($info["goods_name"]); ?></li>
                            <li><span>商品编号：</span>979631</li>
                            <li><span>品牌：</span>联想（Thinkpad）</li>
                            <li><span>上架时间：</span><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></li>
                            <li><span>商品毛重：</span><?php echo ($info["goods_weight"]); ?>kg</li>
                            <li><span>商品产地：</span>中国大陆</li>
                            
                            <?php if(is_array($attrinfoS)): foreach($attrinfoS as $key=>$v): ?><li><span><?php echo ($v["attr_name"]); ?>：</span><?php echo ($v["attr_value"]); ?></li><?php endforeach; endif; ?>
                        </ul>
                    </div>

                    <div class="desc mt10">
                        <!-- 此处的内容 一般是通过在线编辑器添加保存到数据库，然后直接从数据库中读出 -->
                        <?php echo ($info["goods_introduce"]); ?>
                    </div>
                </div>
                <!-- 商品介绍 end -->
                
<script type="text/javascript" src="<?php echo (C("PLUGIN_URL")); ?>page/jquery-page.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo (C("PLUGIN_URL")); ?>page/page.css">
<script type="text/javascript">
$(function(){
    //这是一个非常简单的demo实例，让列表元素分页显示
    //回调函数的作用是显示对应分页的列表项内容
    //回调函数在用户每次点击分页链接的时候执行
    //参数page_index{int整型}表示当前的索引页
    var initPagination = function() {
        var num_entries = <?php echo ($commentcnt); ?>; //总的记录条数
        // 创建分页
        $("#Pagination").pagination(num_entries, {
            num_edge_entries: 1, //边缘页数
            num_display_entries: 4, //主体页数
            callback: pageselectCallback,
            items_per_page:4 //每页显示1项
        });
     }();
     
    function pageselectCallback(page_index, jq){
        //console.log(page_index);
        show_comment_back(<?php echo ($_GET['goods_id']); ?>,page_index)
    }
});
</script>


                <!-- 商品评论 start -->
                <div class="comment detail_div mt10 none">
                    <div class="comment_summary">
                        <div class="rate fl">
                            <strong><em>90</em>%</strong> <br />
                            <span>好评度</span>
                        </div>
                        <div class="percent fl">
                            <dl>
                                <dt>好评（90%）</dt>
                                <dd><div style="width:90px;"></div></dd>
                            </dl>
                            <dl>
                                <dt>中评（5%）</dt>
                                <dd><div style="width:5px;"></div></dd>
                            </dl>
                            <dl>
                                <dt>差评（5%）</dt>
                                <dd><div style="width:5px;" ></div></dd>
                            </dl>
                        </div>
                        <div class="buyer fl">
                            <dl>
                                <dt>买家印象：</dt>
                                <dd><span>屏幕大</span><em>(1953)</em></dd>
                                <dd><span>外观漂亮</span><em>(786)</em></dd>
                                <dd><span>系统流畅</span><em>(1091)</em></dd>
                                <dd><span>功能齐全</span><em>(1109)</em></dd>
                                <dd><span>反应快</span><em>(659)</em></dd>
                                <dd><span>分辨率高</span><em>(824)</em></dd>
                            </dl>
                        </div>
                    </div>
                    <!--
                    <div class="comment_items mt10">
                        <div class="user_pic">
                            <dl>
                                <dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>user1.gif" alt="" /></a></dt>
                                <dd><a href="">乖乖</a></dd>
                            </dl>
                        </div>
                        <div class="item">
                            <div class="title">
                                <span>2013-03-11 22:18</span>
                                <strong class="star star5"></strong> 
                            </div>
                            <div class="comment_content">
                                <dl>
                                    <dt>内容：</dt>
                                    <dd>东西挺好，挺满意的！</dd>
                                </dl>
                            </div>
                            <div class="btns">
                                <a href="" class="reply">回复(0)</a>
                                <a href="" class="useful">有用(0)</a>
                            </div>
                            <div style='margin-left:405px;margin-top:45px;'>
                                <textarea cols='50' rows='4'></textarea>
                                <input type='button' value='提交回复' />
                            </div>                          
                            <div class="btns" style='margin-left:30px;margin-top:40px;margin-right:30px;'>
                                <ul>
            <li style='margin-top:5px'>
            <div style='float:right'>2016-01-05 15:50</div>
            <div style='float:left'>回复人：aobama</div>
            <div style='clear:both;'>回复内容：斯柯达抗衰老的卡洛斯的抗衰老</div>
            </li>   
            <li style='margin-top:5px'>
            <div style='float:right'>2016-01-05 15:50</div>
            <div style='float:left'>回复人：aobama</div>
            <div style='clear:both;'>回复内容：斯柯达抗衰老的卡洛斯的抗衰老</div>
            </li>  
                                </ul>
                            </div>
                        </div>
                        <div class="cornor"></div>
                    </div>
                    -->

                    <!-- 分页信息 start -->
<div class="pagination" id="Pagination" style='margin:5px 10px 10px 600px;'>

                    </div>
                    <!-- 分页信息 end -->


                    <!--  评论表单 start-->
                    <div class="comment_form mt20">
<?php if(!empty($_SESSION['user_id'])): ?><form action="">
    <ul>
        <li>
            <label for=""> 评分：</label>
            <input type="radio" name="cmt_star" value='5' checked='checked' /> <strong class="star star5"></strong>
            <input type="radio" name="cmt_star" value='4' /> <strong class="star star4"></strong>
            <input type="radio" name="cmt_star" value='3' /> <strong class="star star3"></strong>
            <input type="radio" name="cmt_star" value='2' /> <strong class="star star2"></strong>
            <input type="radio" name="cmt_star" value='1' /> <strong class="star star1"></strong>
        </li>


    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.config.js"></script>
    <script type='text/javascript'>
    UEDITOR_CONFIG.toolbars = [[
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor','customstyle', 'paragraph', 'fontfamily', 'fontsize', '|','simpleupload', 'insertimage'
    ]];    

    </script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
    <li>
        <label for="">评论内容：</label>
        <textarea name="cmt_msg" id="cmt_msg" cols="" rows=""></textarea>
    </li>
    <script type='text/javascript'>
    var ue = UE.getEditor('cmt_msg');
    </script>
    <li>
        <label for="">&nbsp;</label>
        <input type="button" value="提交评论" onclick="send_comment(<?php echo ($_GET['goods_id']); ?>)"  class="comment_btn"/>
        <span id="comment_result"></span>                       
    </li>
    </ul>
</form>
<?php else: ?>
    <?php session('back_url','Home/Goods/detail/goods_id/'.I('get.goods_id')); ?>
    <p style='font-size:20px;'><a href="<?php echo U('User/login');?>" style='color:blue;'>登录</a>系统后，才可以进行评论</p><?php endif; ?>
<input type='hidden' id="goods_id" value='<?php echo ($_GET['goods_id']); ?>' />
<script type="text/javascript">
//发表评论
function send_comment(goods_id){
    var star = $('[name=cmt_star]:checked').val();
    var msg = ue.getContent();
    //ajax把获得的表单内容提交给服务器
    $.ajax({
        url:"<?php echo U('Comment/sendComment');?>",
        data:{'cmt_star':star,'cmt_msg':msg,'goods_id':goods_id},
        dataType:'json',
        type:'post',
        success:function(msg){
            if(msg.status==1){
                $('#comment_result').html(msg.notice);
                //评论完成后内容复位
                setTimeout('back_result()',2000);
                //内容归位
                $('[name=cmt_star]').val([5]);
                ue.setContent("");

                //滚动条滚动到评论的顶部
                $(document).scrollTop(700); //设置浏览器滚动条卷起的高度
                //把新添加的好的评论显示出来
                $('.comment_summary').after('<div id="comment_show_101" class="comment_items mt10" style="display:none;"><div class="user_pic"><dl><dt><a href=""><img src="<?php echo (C("IMG_URL")); ?>user1.gif" alt="" /></a></dt><dd><a href="">'+msg.commentinfo.user_name+'</a></dd></dl></div><div class="item"><div class="title"><span>'+msg.commentinfo.time+'</span><strong class="star star'+msg.commentinfo.cmt_star+'"></strong> </div><div class="comment_content"><dl><dt>内容：</dt><dd>'+msg.commentinfo.cmt_msg+'</dd></dl></div><div class="btns"><a href="" class="reply">回复(0)</a><a href="" class="useful">有用(0)</a></div></div><div class="cornor"></div></div>').animate({},2000,function(){
                        $('#comment_show_101').fadeIn(2000);
                    });
            }
        }
    });
}

//提示信息复位
function back_result(){
    $('#comment_result').hide();
}
</script>

                    </div>
                    <!--  评论表单 end-->
                    
                </div>
                <!-- 商品评论 end -->

                <!-- 售后保障 start -->
                <div class="after_sale mt15 none detail_div">
                    <div>
                        <p>本产品全国联保，享受三包服务，质保期为：一年质保 <br />如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！</p>
                        <p>售后服务电话：800-898-9006 <br />品牌官方网站：http://www.lenovo.com.cn/</p>

                    </div>

                    <div>
                        <h3>服务承诺：</h3>
                        <p>本商城向您保证所售商品均为正品行货，京东自营商品自带机打发票，与商品一起寄送。凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由本商城联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。本商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！</p> 
                        
                        <p>注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>

                    </div>
                    
                    <div>
                        <h3>权利声明：</h3>
                        <p>本商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是京东商城重要的经营资源，未经许可，禁止非法转载使用。</p>
                        <p>注：本站商品信息均来自于厂商，其真实性、准确性和合法性由信息拥有者（厂商）负责。本站不提供任何保证，并不承担任何法律责任。</p>

                    </div>
                </div>
                <!-- 售后保障 end -->

            </div>
        </div>
        <!-- 商品详情 end -->

        
    </div>
    <!-- 商品信息内容 end -->
    

</div>
<!-- 商品页面主体 end -->


<div style="clear:both;"></div>

<script type="text/javascript">
    $(function(){
    document.execCommand("BackgroundImageCache", false, true);
    });
</script>
<style type="text/css">
/*购物车弹出框*/
.orange{color: #CC0000;}
a.bt_orange:link,a.bt_orange:visited{color:#FFFFFF;width:107px; height:27px; line-height:27px;background:url(<?php echo (C("IMG_URL")); ?>cart/chakanBtn.jpg) no-repeat; text-align:center; font-weight:bold;cursor:pointer; display:block; _display:inline; float:left; margin-left:60px;}
a.bt_blue:link,a.bt_blue:visited{color:#FFFFFF;width:107px; height:27px; line-height:27px;background:url(<?php echo (C("IMG_URL")); ?>cart/tiaoxuannBtn.jpg) no-repeat; text-align:center; font-weight:bold;cursor:pointer;display:block;_display:inline; float:right; margin-right:60px;}
.buy_blank{ width:350px; height:115px; border:3px solid #AAAAAA; position:absolute; background-color:#FFFFFF;}
.buy_blank p{ line-height:30px;}
.buy_blank h4{ border-bottom:2px solid #D0D0D0; font-weight:normal; height:30px; line-height:30px;background:url(<?php echo (C("IMG_URL")); ?>cart/buyicon.jpg) no-repeat 10px center; text-indent:28px; margin-bottom:10px; padding-left:20px;}
.buy_blank h4 span{ float:right; margin:10px 10px 0 0}
img, fieldset {border:0 none;}
</style>

<div class="buy_blank" id="cartBox" style="display:none;z-index:99;">
    <h4>
        <span><a href="javascript:;" onclick="$('#cartBox').hide()"><img src="<?php echo (C("IMG_URL")); ?>cart/close.jpg" title="点击关闭"/></a></span>
        该商品已成功添加到购物车
    </h4>
    <p style="padding-left:60px;">
        购物车共计 <span class="orange"><strong id="goods_number"></strong></span> 个商品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        合计：<span class="orange"><strong id="goods_totalprice"></strong></span> 元
    </p>
    <p>
        <a href="<?php echo U('Shop/showlist');?>" onclick="javascript:$('#cartBox').hide()" class="bt_orange" target="_black"></a>
        <a href="javascript:;" onclick="$('#cartBox').hide()" class="bt_blue"></a>
    </p>
</div>

    <!-- 底部导航 start -->
    <div class="bottomnav w1210 bc mt10">
        <div class="bnav1">
            <h3><b></b> <em>购物指南</em></h3>
            <ul>
                <li><a href="">购物流程</a></li>
                <li><a href="">会员介绍</a></li>
                <li><a href="">团购/机票/充值/点卡</a></li>
                <li><a href="">常见问题</a></li>
                <li><a href="">大家电</a></li>
                <li><a href="">联系客服</a></li>
            </ul>
        </div>
        
        <div class="bnav2">
            <h3><b></b> <em>配送方式</em></h3>
            <ul>
                <li><a href="">上门自提</a></li>
                <li><a href="">快速运输</a></li>
                <li><a href="">特快专递（EMS）</a></li>
                <li><a href="">如何送礼</a></li>
                <li><a href="">海外购物</a></li>
            </ul>
        </div>

        
        <div class="bnav3">
            <h3><b></b> <em>支付方式</em></h3>
            <ul>
                <li><a href="">货到付款</a></li>
                <li><a href="">在线支付</a></li>
                <li><a href="">分期付款</a></li>
                <li><a href="">邮局汇款</a></li>
                <li><a href="">公司转账</a></li>
            </ul>
        </div>

        <div class="bnav4">
            <h3><b></b> <em>售后服务</em></h3>
            <ul>
                <li><a href="">退换货政策</a></li>
                <li><a href="">退换货流程</a></li>
                <li><a href="">价格保护</a></li>
                <li><a href="">退款说明</a></li>
                <li><a href="">返修/退换货</a></li>
                <li><a href="">退款申请</a></li>
            </ul>
        </div>

        <div class="bnav5">
            <h3><b></b> <em>特色服务</em></h3>
            <ul>
                <li><a href="">夺宝岛</a></li>
                <li><a href="">DIY装机</a></li>
                <li><a href="">延保服务</a></li>
                <li><a href="">家电下乡</a></li>
                <li><a href="">京东礼品卡</a></li>
                <li><a href="">能效补贴</a></li>
            </ul>
        </div>
    </div>
    <!-- 底部导航 end -->

    <div style="clear:both;"></div>
    <!-- 底部版权 start -->
    <div class="footer w1210 bc mt10">
        <p class="links">
            <a href="">关于我们</a> |
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