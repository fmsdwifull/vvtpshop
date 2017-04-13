/*
@功能：商品页js
@作者：diamondwang
@时间：2013年11月13日
*/

var module_url = "http://web.php41.com/index.php/Home/";
var img_home_url = "http://web.php41.com/Home/Public/images/";

$(function(){
	//商品缩略图左右移动效果
	//点击后退
	$("#backward").click(function(){
		var left = parseInt($(".smallpic_wrap ul").css("left")); //获取ul水平方向偏移量
		var offset = left + 62;
		if (offset <= 0){
			$(".smallpic_wrap ul").stop(true,false).animate({left:offset},"slow",'',function(){
				//动画完成之后，判断是否到了左边缘
				if ( parseInt($(".smallpic_wrap ul").css("left")) >= 0 ){
					$("#backward").removeClass("on").addClass("off");
				}
			});
			//开启右边的按钮
			$("#forward").removeClass("off").addClass("on");			
		}
		
		$(this).blur(); //去除ie 虚边框
	});

	//点击前进
	$("#forward").click(function(){
		var left = parseInt($(".smallpic_wrap ul").css("left")); //获取ul水平方向偏移量
		var len = $(".smallpic_wrap li").size() * 62; //获取图片的整体宽度(图片数 * 图片宽度)558
		var offset = left - 62;
		if (offset >= -(len - 62*5)){
			$(".smallpic_wrap ul").stop(true,false).animate({left:offset},"slow",'',function(){
				//判断是否到了右边缘
				if ( parseInt($(".smallpic_wrap ul").css("left")) <= -(len - 62*5) ){
					$("#forward").removeClass("on").addClass("off");
				}
			});
			//开启左边的按钮
			$("#backward").addClass("on").removeClass("off");
			
		}
		
		$(this).blur(); //去除ie 虚边框
	});

	//选择货品，如颜色、版本等
	$(".product a").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
		$(this).find("input").attr({checked:"checked"});
		//去除虚边框
		$(this).blur();
	});


	//购买数量
	//减少
	$("#reduce_num").click(function(){
		if (parseInt($(".amount").val()) <= 1){
			alert("商品数量最少为1");
		} else{
			$(".amount").val(parseInt($(".amount").val()) - 1);
		}
	});

	//增加
	$("#add_num").click(function(){
		$(".amount").val(parseInt($(".amount").val()) + 1);
	});

	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(".amount").val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
	});

	//商品详情效果
	$(".detail_hd li").click(function(){
		$(".detail_div").hide().eq($(this).index()).show();
		$(this).addClass("on").siblings().removeClass("on");

		//点击“商品评论”要感知到
		var num = $(this).index(); //1:商品评论
		if(num===1){
			//ajax去服务器端获得商品评论
			var goods_id = $('#goods_id').val();
			show_comment_back(goods_id);
		}
	});
});
//专门用于显示评论 和 回复 的列表信息
//(有集成ajax无刷新分页效果)
function show_comment_back(goods_id,page=0){
	$.ajax({
			url:module_url+"Comment/showlist",
			data:{'goods_id':goods_id,'page':page},
			dataType:'json',
			//type:'get',
			success:function(msg){
				//遍历msg，把 评论内容 与 html标签 结合显示
				var s = "";
				$.each(msg,function(k,v){
					s += '<div id="comment_show_'+v.cmt_id+'" class="comment_items mt10" ><div class="user_pic"><dl><dt><a href=""><img src="'+img_home_url+'user1.gif" alt="" /></a></dt><dd><a href="">'+v.user_name+'</a></dd></dl></div><div class="item" id="item_'+v.cmt_id+'"><div class="title"><span>'+v.time+'</span><strong class="star star'+v.cmt_star+'"></strong> </div><div class="comment_content"><dl><dt>内容：</dt><dd>'+v.cmt_msg+'</dd></dl></div><div class="btns"><a href="javascript:;" onclick="open_back('+v.cmt_id+')" class="reply">回复(0)</a><a href="" class="useful">有用(0)</a></div>';
					
//显示对应的回复内容
if(typeof v.back_info !=='undefined'){
$.each(v.back_info,function(kk,vv){
	s += "<div class='btns' style='margin-left:30px;margin-top:5px;margin-right:30px;'><ul><li style='margin-top:5px'><div style='float:right'>"+vv.time+"</div><div style='float:left'>回复人："+vv.user_name+"</div><div style='clear:both;'>回复内容："+vv.back_msg+"</div></li></ul></div>";
});
}
					s += '</div><div class="cornor"></div></div>';

				});
				$('[id^=comment_show_]').remove();//删除旧的之前的评论信息
				$('.comment_summary').after(s);//追加(新的评论)信息到页面
			}
		});
}

//给回复按钮后边追加一个“textarea”文本域，进行回复内容填写
function open_back(cmt_id){
	//判断用户是否登录系统
	//ajax去服务器端判断session是否存在
	$.ajax({
		url:module_url+'User/isLogin',
		dataType:'json',
		success:function(msg){
			if(msg.status==1){ //有登录系统
				var s = '<div class="btns" id="back_reply_'+cmt_id+'" style="margin-left:405px;margin-top:35px;""><textarea cols="50" rows="3" id="back_msg_'+cmt_id+'"></textarea><input type="button" onclick="send_back('+cmt_id+')" value="提交回复" /></div>';
				$('#item_'+cmt_id).append(s);
			}else{
				window.location.href=module_url+"User/login";
			}
		}
	});
}

//提交回复内容到数据库
function send_back(cmt_id){
	//获得输入的回复内容
	var back_msg = $('#back_msg_'+cmt_id).val();
	//走ajax，把内容 和 cmt_id 一并提交给服务器端
	$.ajax({
		url:module_url+'Comment/sendBack',
		data:{'back_msg':back_msg,'cmt_id':cmt_id},
		dataType:'json',
		type:'post',
		success:function(msg){
			if(msg.status==1){
				//显示已经提交的“回复”信息
				//把回来的回复信息 与 html 标签结合并显示
				var s = "<div class='btns' style='margin-left:30px;margin-top:5px;margin-right:30px;'><ul><li style='margin-top:5px;list-style:none;'><div style='float:right'>"+msg.backinfo.time+"</div><div style='float:left'>回复人："+msg.backinfo.user_name+"</div><div style='clear:both;'>回复内容："+msg.backinfo.back_msg+"</div></li></ul></div>";
	            $('#item_'+cmt_id).append(s);
				//销毁"回复的文本域及按钮"
				$('#back_reply_'+cmt_id).remove();
			}
		}
	});
}
