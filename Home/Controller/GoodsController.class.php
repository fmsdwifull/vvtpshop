<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;

class GoodsController extends HomeController {
    //商品列表展示
    function showlist(){
        $cat_id = I('get.cat_id');

        $goods = new \Model\GoodsModel();
        $cdt['is_del'] = '不删除';
        $cdt['is_sale'] = '上架';

        /*********价格参数**********/
        $price = I('get.price');
        $condition_string = array();
        if(!empty($price)){
            $condition_string[] = "<span style='border:1px solid red;padding:5px 10px'>价格：".$price."&nbsp;<a href='".__MODULE__."/".unsetUrlParams('price')."'>X</a>&nbsp;</span>";
            //点击X的效果：
            //http://web.php41.com/index.php/Home/Goods/showlist/cat_id/3/price/1400-2799
            //上边地址变为以下地址进行请求(去除price的get参数)
            //http://web.php41.com/index.php/Home/Goods/showlist/cat_id/3

            //制作根据价格筛选商品的条件:
            //两种情况:price1-price2    price以上
            if(strpos($price,'-')===false){//price以上
                $pri = (int)$price;//9800以上
                $cdt['goods_shop_price'] = array('egt',$pri);
            }else{//price1-price2
                $price_high_low = explode('-',$price);
                $low_price  = $price_high_low[0];
                $high_price = $price_high_low[1];
                $cdt['goods_shop_price'] = array('between',array($low_price,$high_price));
            }
        }
        /*********价格参数**********/



        /***********关联分类条件***********/
        //获取当前选取的分类 和 其内部全部子级分类，并合并为一个集合
        //商品的主分类、扩展分类必须在此集合中。
        //获得全部子级分类
        //全路径以当前选取分类的全路径为开始内容的分类信息
        $cat = D('Category');
        $now_cat = $cat -> find($cat_id); //当前选取的分类信息
        $now_path = $now_cat['cat_path'];
        $ext_cat = D('Category')->field('cat_id')->where("cat_path like '$now_path%'")->select();
        //SELECT * FROM `php41_category` WHERE ( cat_path like '1%' )
        //dump($ext_cat); //选取的、子级的都存在

        $s = "";
        foreach($ext_cat as $k => $v){
            $s .= $v['cat_id'].",";
        }
        $s = rtrim($s,',');
        //dump($s);//string(19) "1,7,8,9,12,13,14,15"

        //获得商品列表，条件是：“主分类”或“扩展分类”都在$s里边
        $sql = "select goods_id from __GOODS__ where cat_id in ($s) union select goods_id from __GOODS_CAT__ where cat_id in ($s)";
        $ids = D()->query($sql);
        //dump($ids);//二维数组信息，符合要求的商品id

        $w = "";
        foreach($ids as $kk => $vv){
            $w .= $vv['goods_id'].",";
        }
        $w = rtrim($w,',');

        //从$w的条件里边，获得需要的商品列表信息
        $cdt['goods_id'] = array('in',$w);
        /***********关联分类条件***********/

        /*************关联属性条件获得进一步的商品信息*************/
        ///cat_id/3/attr_6/windows/attr_7/粉色
        /***********属性条件参数************/
        $condition = I('get.'); //获得全部get参数
        //Home/Goods/showlist/cat_id/3/price/8400-9799/attr_6/android/attr_10/16g
        //获得全部属性条件
        $attrids = array();
        $have_attr_condition = false; //是否有属性条件
        foreach($condition as $k => $v){
            if(strpos($k,'attr_')===0){  //属性名称下标有attr_开始的
                //先根据attr_id获得对应的属性名称
                $have_attr_condition = true;
                $attr_id = explode('_',$k);
                $attr_id = $attr_id[1];
                $attr_name = D('Attribute')->where(array('attr_id'=>$attr_id))->getField('attr_name');

                $condition_string[] = "<span style='border:1px solid red;padding:5px 10px'>".$attr_name."：".$v."&nbsp;<a href='".__MODULE__."/".unsetUrlParams($k)."'>X</a>&nbsp;</span>";
                $attrids[] = $attr_id;
            }
        }
        $this -> assign('condition_string',$condition_string);
        /***********属性条件参数************/
        //select goods_id from php41_goods_attr where goods_id in($w) and attr_id in (6,7)
        if($have_attr_condition === true){
            //$attrids = implode(',',$attrids);
            //$goods_attr_ids = D('GoodsAttr')->where(array('goods_id'=>array('in',$w),'attr_id'=>array('in',$attrids)))->getField('group_concat(distinct goods_id)');
            //dump($goods_attr_ids);//string(14) "29,33,30,28,26"
            //$cdt['goods_id'] = array('in',$goods_attr_ids);

            //根据具体的属性“分别依次”获得对应的goods_ids信息
            //让它们取“交集”
            $ji_result = explode(',',$w);
            $em = false;  //根据属性获得商品的结果是否为空
            foreach($attrids as $v){
                $gids = D('GoodsAttr')
                    ->field('goods_id')
                    ->where(array('goods_id'=>array('in',$w),'attr_id'=>$v))
                    ->getField('group_concat(distinct goods_id)');
                $arr_gids = explode(',',$gids);
                ////取数组交集
                $ji_result = array_intersect($ji_result, $arr_gids);
                if(empty($ji_result)){
                    break;
                }
            }
        }

        if($have_attr_condition===true){
            if(!empty($ji_result)){
                $cdt['goods_id'] = array('in',implode(',',$ji_result));
            }else{
                $cdt['goods_id'] = 0;
            }
        }
        /*************关联属性条件获得进一步的商品信息*************/


        /******获得展示的全部商品信息(各种排序销量、价格、评论、上架时间)*****/
        //默认是销量倒排序(php41_order_goods表获得销量信息)
        $pai = I('get.pai','xl');//get参数pai没有设置就默认为xl
        $xu = I('get.xu','desc');//get参数xu没有设置就默认为desc
        $info = $goods
            -> alias('g')
            -> where($cdt) 
            -> field('goods_id,goods_name,goods_shop_price,add_time,goods_big_logo,ifnull((select sum(goods_number) from php41_order_goods og where g.goods_id=og.goods_id),0) xl,ifnull((select count(cmt_id) from php41_comment c where g.goods_id=c.goods_id),0) pl')
            -> order("$pai $xu")
            -> select();
        /******获得展示的全部商品信息(各种排序销量、价格、评论、上架时间)*****/

        /************商品的多选属性************/
        //dump($w);//28,29,30,31,33,26
        //select ga.attr_id,ga.attr_value,a.attr_name  from php41_goods_attr ga join php41_attribute a on ga.attr_id=a.attr_id
        //where ga.goods_id in (数字列表) and a.attr_is_sel=1
        $attrinfo = D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
            ->where(array('ga.goods_id'=>array('in',$w),'a.attr_is_sel'=>1))
            ->field('ga.attr_id,ga.attr_value,a.attr_name')
            ->select();

        //把$attrinfo的二维数组变为三维数组
        $attrinfoT = array();
        foreach($attrinfo as $k => $v){
            $attrinfoT[$v['attr_id']]['attr_id'] = $v['attr_id'];
            $attrinfoT[$v['attr_id']]['attr_name'] = $v['attr_name'];
            if(!in_array($v['attr_value'],$attrinfoT[$v['attr_id']]['attr_value'])){
                $attrinfoT[$v['attr_id']]['attr_value'][] = $v['attr_value'];
            }
        }
        //dump($attrinfoT);
        $this -> assign('attrinfoT',$attrinfoT);
        /************商品的多选属性************/

        /*********制作价格区间*********/
        //从$info里边获得商品的最高、最低价格
        $price = array();
        foreach($info as $v){
            $price[] = $v['goods_shop_price'];
        }
        $max_price = max($price);
        $min_price = min($price);
        $qujian = $max_price-$min_price;
        $duan = 7; ////段：价格有几部分组成[7段]
        //平均段区间跨度
        $avg_qujian = floor($qujian/$duan);
        //dump($avg_qujian);//1375 //跨度：每个段的价格的范围[数目恒定]
        //价格区间
        //每段 的价格连接字符串    0-699    700-1199    1200-2099
        $start_price = 0;
        $tmp = 0;
        $string_price = array();
        for($i=0; $i<7; $i++){
            $tmp = $start_price+(int)($avg_qujian/100)*100+99; //1399
            $string_price[] = $start_price."-".$tmp;  //0-1399  1400-2799
            $start_price = $tmp+1;
        }
        $string_price[] = $start_price."以上";
        $this -> assign('string_price',$string_price);
        /*********制作价格区间*********/


        $this -> assign('info',$info);

        $this -> display();
    }

    //商品详情页面
    function detail(){
        $goods_id = I('get.goods_id');
        /***************获取商品的详细信息*******************/
        $info = D('Goods')->find($goods_id);
        $this -> assign('info',$info);
        /***************获取商品的详细信息*******************/

        /***************获取商品的主、扩展分类信息*******************/
        //主、扩展分类
        $sql = "select cat_id from __GOODS__ where goods_id='$goods_id' union select cat_id from __GOODS_CAT__ where goods_id='$goods_id'";
        $cat_ids = D()->query($sql);
        //从二维数组获得一个指定字段的字符串信息
        $cat_ids = arrayToString($cat_ids,'cat_id'); 
        //根据$cat_ids获得所有的分类信息(根据全路径排序)
        $catinfo = D('Category')
        ->where(array('cat_id'=>array('in',$cat_ids)))
        ->order('cat_path')
        ->select();
        $this -> assign('catinfo',$catinfo);
        /***************获取商品的主、扩展分类信息*******************/

        /***************获取商品的"多选"属性信息*******************/
        //数据表：php41_goods_attr、 php41_attribute
        $attrinfo = D('GoodsAttr')
        ->alias('ga')
        ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
        ->where(array('a.attr_is_sel'=>1,'ga.goods_id'=>$goods_id))
        ->field('a.attr_id,a.attr_name,ga.attr_value')
        ->select();
        //把$attrinfo的二维数组变为三维数组
        $attrinfoT = array();
        foreach($attrinfo as $k => $v){
            $attrinfoT[$v['attr_id']]['attr_id'] = $v['attr_id'];
            $attrinfoT[$v['attr_id']]['attr_name'] = $v['attr_name'];
            $attrinfoT[$v['attr_id']]['attr_value'][] = $v['attr_value'];
        }
        $this -> assign('attrinfoT',$attrinfoT);
        /***************获取商品的"多选"属性信息*******************/

        /***************获取商品的相关分类信息*******************/
        //获得商品的最后一级分类
        $last_catinfo = $catinfo[count($catinfo)-1];
        //获得最后一级分类的同级分类信息(它们的父id一致,排除最后一级分类)
        $other_catinfo = D('Category')
        ->where(array('cat_pid'=>$last_catinfo['cat_pid'],'cat_id'=>array('neq',$last_catinfo['cat_id'])))
        ->select();
        //SELECT * FROM `php41_category` WHERE `cat_pid` = 10 AND `cat_id` <> '16' 
        $this -> assign('other_catinfo',$other_catinfo);
        /***************获取商品的相关分类信息*******************/

        /***************获取商品的相册信息*******************/
        $goodspics = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();
        $this -> assign('goodspics',$goodspics);
        /***************获取商品的相册信息*******************/

        /***************获取商品的"单选"属性信息*******************/
        $attrinfoS = D('GoodsAttr')
        ->alias('ga')
        ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
        ->where(array('a.attr_is_sel'=>0,'ga.goods_id'=>$goods_id))
        ->field('a.attr_id,a.attr_name,ga.attr_value')
        ->select();
        $this -> assign('attrinfoS',$attrinfoS);
        /***************获取商品的"单选"属性信息*******************/

        /************当前商品对应的全部“评论数目”*************/
        $commentcnt = D('Comment')->where(array('goods_id'=>$goods_id))->count();
        $this -> assign('commentcnt',$commentcnt);
        /************当前商品对应的全部“评论数目”*************/

        $this -> display();
    }
}
