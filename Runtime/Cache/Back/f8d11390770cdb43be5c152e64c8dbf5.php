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

        
            <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.config.js"></script>
            
            <script type='text/javascript'>
            UEDITOR_CONFIG.toolbars = [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', '|',
            ]];    
            
            </script>
            
            <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"></script>
            <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>

          
            <script type="text/javascript" src="<?php echo (C("COMMON_URL")); ?>Js/uploadPreview.js"></script>
   
        <script type="text/javascript">
        //加载事件里边定义click事件
        $(function(){
            $('#tabbar-div span').click(function(){
                $('#tabbar-div span').attr('class','tab-back');//全部标签 变暗
                $(this).attr('class','tab-front');//当前被点击标签 高亮

                $('.table_a').hide();//全部table 变暗
                var idflag = $(this).attr('id');//当前被点击标签对应的table 高亮
                $('#'+idflag+"-tb").show();
            });
        });
        </script>
        <style type="text/css">
        #tabbar-div {
            background: none repeat scroll 0 0 #80BDCB;
            height: 27px;
            padding-left: 10px;
            padding-top: 1px;
        }
        #tabbar-div p {
            margin: 2px 0 0;
        }
        .tab-front {
            background: none repeat scroll 0 0 #BBDDE5;
            border-right: 2px solid #278296;
            cursor: pointer;
            font-weight: bold;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
        }
        .tab-back {
            border-right: 1px solid #FFFFFF;
            color: #FFFFFF;
            cursor: pointer;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
        }
        .tab-hover {
            background: none repeat scroll 0 0 #94C9D3;
            border-right: 1px solid #FFFFFF;
            color: #FFFFFF;
            cursor: pointer;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
        }
        </style>
        <div id="tabbar-div">
            <p>
                <span id="general-tab" class="tab-front">通用信息</span>
                <span id="detail-tab" class="tab-back">详细描述</span>
                <span id="mix-tab" class="tab-back">其他信息</span>
                <span id="properties-tab" class="tab-back">商品属性</span>
                <span id="gallery-tab" class="tab-back">商品相册</span>
                <span id="linkgoods-tab" class="tab-back">关联商品</span>
                <span id="groupgoods-tab" class="tab-back">配件</span>
                <span id="article-tab" class="tab-back">关联文章</span>
            </p>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/vvtpshop/index.php/Back/Goods/tianjia" method="post" enctype="multipart/form-data">
                <table border="1" width="100%" class="table_a" id="general-tab-tb">
                    <tr>
                        <td>商品名称</td>
                        <td><input type="text" name="goods_name" /></td>
                    </tr>
                    <tr>
                        <td>商品价格</td>
                        <td><input type="text" name="goods_price" /></td>
                    </tr>                     
<tr>
    <td>商品分类</td>
    <td>
    <select name='cat_id' id="cat_id_0">
        <option value='0'>-请选择-</option>
        <?php if(is_array($catinfo)): foreach($catinfo as $key=>$v): ?><option value='<?php echo ($v["cat_id"]); ?>'><?php echo str_repeat('***/',$v['cat_level']); echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
    </select>
    </td>
</tr>              
<tr>
    <td>扩展分类</td>
    <td><input type="button" value="添加" onclick="add_sel(this)" /></td>
</tr>
<script type="text/javascript">
var select_num = 1;//计数器，给创建出来的多个下拉列表进行id计数
function add_sel(obj){
    var fu_sel = $('#cat_id_0').clone();  //克隆下拉列表
    fu_sel.attr('id','cat_id_'+select_num);  //区别不同的id属性值
    fu_sel.attr('name','cat_ext_info[]');  //修改name属性值
    $(obj).after(fu_sel);//追加
    select_num++;//计数器累加
}
</script>
                    <tr>
                        <td>商品logo图片</td>
                        <td><input type="file" name="goods_logo" id="goods_logo"/>
                            <div id="goods_logo_dv"><img src="" alt="" id="goods_logo_im" width="160" height="160" /></div>
                        </td>
                    </tr>
                </table>
                <script type="text/javascript">
                $(function(){
                    new uploadPreview({ UpBtn: "goods_logo", DivShow: "goods_logo_dv", ImgShow: "goods_logo_im" });
                });
                </script>
                <table border="1" width="100%" class="table_a" id="detail-tab-tb"
                    style="display:none;"
                >
                    <tr>
                        <td>商品详细描述</td>
                        <td>
                            <textarea name="goods_introduce" id='goods_introduce' style="width:730px;height:320px;"></textarea>
                        </td>
                    </tr>
                    <script type='text/javascript'>
                    var ue = UE.getEditor('goods_introduce');
                    </script>
                </table>                
<table border="1" width="100%" class="table_a" id="mix-tab-tb"
    style="display:none;"
>
    <tr>
        <td>商品重量</td>
        <td><input type="text" name="goods_weight" /></td>
    </tr>                    
    <tr>
        <td>加入推荐</td>
        <td>
            <input type="checkbox" name="is_qiang" value='抢' />抢购
            <input type="checkbox" name="is_hot" value='热销' />热销
            <input type="checkbox" name="is_rec" value='推荐' />推荐
            <input type="checkbox" name="is_new" value='新品' />新品
        </td>
    </tr>
</table>

<table border="1" width="100%" class="table_a" id="properties-tab-tb"
    style="display:none;"
>
    <tr style='background-color:lightgreen;'>
        <td style="text-align:right" width="25%">商品类型：</td>
        <td>
            <select name='type_id' onchange="show_attribute()">
                <option value="0">-请选择-</option>
                <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value='<?php echo ($v["type_id"]); ?>'><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
    </tr>
</table>
<script type="text/javascript">
function show_attribute(){
    var type_id = $('select[name=type_id] option:selected').val();
    $.ajax({
        url:"<?php echo U('getAttributeByType');?>",
        data:{'type_id':type_id},
        dataType:'json',
        type:'get',
        success:function(msg){
            //遍历msg，显示
            var s = "";
            $.each(msg,function(k,v){
                //输入框/下拉列表
                if(v.attr_is_sel==1){
                    s += "<tr>";
                    s += "<td style='text-align:right;'><em><span onclick='add_item_tr($(this).parent().parent().parent())'>[+]</span></em>"+v.attr_name+"：</td>";
                    s += "<td>";
                    //下拉列表
                    var opt_val = v.attr_sel_opt.split(','); //字符串变为数组
                    s += "<select name='attr_info["+v.attr_id+"][]'>";
                    s += "<option value='0'>-请选择-</option>";
                    $.each(opt_val,function(kk,vv){
                        s += "<option value='"+vv+"'>"+vv+"</option>";
                    });
                    s += "</select>";
                    s += "</td>";
                    s += "</tr>";
                }else{
                    s += "<tr>";
                    s += "<td style='text-align:right;'>"+v.attr_name+"：</td>";
                    s += "<td>";
                    //输入框
                    s += "<input text='text' name='attr_info["+v.attr_id+"][]' />";
                    s += "</td>";
                    s += "</tr>";
                }

            });
            $('#properties-tab-tb tr:not(:first)').remove(); //删除旧的tr属性
            $('#properties-tab-tb').append(s);//内容追加给页面
        }
    });
}

//对“多选项目”进行增加操作
function add_item_tr(obj){
    var fu_obj = obj.clone(); //复制tr
    fu_obj.find('span').remove();//删除复制品tr 内部的“span”
    fu_obj.find('em').append("<span onclick='$(this).parent().parent().parent().remove()'>[-]</span>");//给复制品tr内部的em增加一个<span>[-]</span>
    obj.after(fu_obj); //把复制品tr 追加到页面
}
</script>
                <script type="text/javascript">
                var p_num = 1;  //相册计数器
                function add_item(){
                    //增加相册的项目
                    var s = "<tr><td><span style='cursor:pointer;' onclick='$(this).parent().parent().remove()'>[-]</span>商品相册</td><td><input type='file' name='goods_pics[]' id='goods_pics_"+p_num+"'/><div id='goods_pics_dv_"+p_num+"'><img src='' alt='' width='160' height='160' id='goods_pics_im_"+p_num+"'/></div></td></tr>";
                    $('#gallery-tab-tb').append(s);

                    //设置立即显示上传好的图片效果
                    new uploadPreview({ UpBtn: "goods_pics_"+p_num, DivShow: "goods_pics_dv_"+p_num, ImgShow: "goods_pics_im_"+p_num });

                    p_num++;  //每增加一个相册，计数器的值要累加
                }
                </script>

                <table border="1" width="100%" class="table_a" id="gallery-tab-tb"
                    style="display:none;"
                >
                    <tr>
                        <td><span style='cursor:pointer;' onclick="add_item()">[+]</span>商品相册</td>
                        <td><input type='file' name='goods_pics[]' id="goods_pics_0" />
                        <div id="goods_pics_dv_0"><img src="" alt="" width="160" height="160" id="goods_pics_im_0"/></div>
                        </td>
                    </tr>
                </table>
                <script type="text/javascript">
                $(function(){
                    new uploadPreview({ UpBtn: "goods_pics_0", DivShow: "goods_pics_dv_0", ImgShow: "goods_pics_im_0" });
                });
                </script>
                <table width="100%">
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="添加" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>


        </body>
</html>