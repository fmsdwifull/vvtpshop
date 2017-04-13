<?php

//商店控制器，实现购物车的"增、删、改、查"操作
//使用Cart.class.php工具
namespace Home\Controller;
use Think\Controller;

class ShopController extends Controller{
    //添加商品到购物车
    function addCart(){
        //根据商品id获得商品的详情信息，并给商品存储到购物车里边
        $goods_id = I('get.goods_id');
        $goodsinfo = D('Goods')->field('goods_name,goods_shop_price')->find($goods_id);

        $data['goods_id'] = $goods_id;
        $data['goods_name'] = $goodsinfo['goods_name'];
        $data['goods_price'] = $goodsinfo['goods_shop_price'];
        $data['goods_number'] = 1;
        $data['goods_total_price'] = $goodsinfo['goods_shop_price'];
        //购物车每个商品存储5部分信息：id/name/price/number/total_price

        //存储商品到购物车
        $cart = new \Common\Tools\Cart();
        $cart -> add($data);
        //获得目前购物车的商品总数量、总价格
        $number_price = $cart -> getNumberPrice();
        echo json_encode($number_price);
    }

    //显示购物车列表信息
    function showlist(){
        //获取购物车去全部商品信息
        /****购物车全部商品信息****/
        $cart = new \Common\Tools\Cart();
        $cartinfo = $cart -> getCartInfo();
        $this -> assign('cartinfo',$cartinfo);
        /****购物车全部商品信息****/

        //购物车商品总数量、总价格
        $number_price = $cart -> getNumberPrice();
        $this -> assign('number_price',$number_price);

        $this -> display();
    }

    //删除购物车商品
    function delCart(){
        $goods_id = I('get.goods_id'); //被删除商品的id

        $cart = new \Common\Tools\Cart();
        $cart -> del($goods_id);

        //获得最新的购物车信息并返回
        $number_price = $cart -> getNumberPrice();
        echo json_encode($number_price);
    }


    //购物车商品数量变化
    function modifyNum(){
        $goods_id = I('get.goods_id');
        $after_num = I('get.after_num');

        //购物车
        $cart = new \Common\Tools\Cart();
        $ji_price = $cart -> changeNumber($after_num,$goods_id);

        $number_price = $cart -> getNumberPrice();

        $data = array(
            'ji_price'=>$ji_price,
            'zong_price'=>$number_price['price'],
            'zong_number'=>$number_price['number'],
            );

        echo json_encode($data);
    }

    //展示生成订单的模板页面
    function showorder(){
        //判断用户是否登录系统
        $user_id = session('user_id');
        if(empty($user_id)){
            session('back_url','Shop/showorder'); //定义登录成功后跳转的地址
            $this -> redirect('User/login');
        }
        if(IS_POST){
            $order = new \Model\OrderModel();

            $data = $order -> create();
            //把收集的订单信息存储起来
            //在model模型的_before_insert()维护"其他"字段并存储
            if($new_id = $order -> add($data)){
                //把数据整合好提交给支付宝页面 alipayapi.php
                $url = "http://web.php41.com/zhifubao/alipayapi.php";
                //获得订单信息
                $orderinfo = D('Order')->find($new_id);

                $arr = array(
                    'WIDout_trade_no' => $orderinfo['order_number'],
                    'WIDsubject' => '传智商城_牛仔裤_'.mt_rand(100,999),
                    'WIDtotal_fee' => $orderinfo['order_price'],
                );

                //向$url地址发送一个“post”请求，并且传递$arr的post数据
                //file_get_contents($url);//只能发送"get"请求
                //可以利用curl技术，实现其他地址的请求，get/post请求均可以
                //curl:模拟登录技术、信息采集(cms)技术
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
            }
        }else{
            /********获得购物车商品信息*******/
            $cart = new \Common\Tools\Cart();
            $cartinfo = $cart -> getCartInfo();
            //获得商品对应的logo小图
            foreach($cartinfo as $k => $v){
                $cartinfo[$k]['goods_logo'] = D('Goods')->where(array('goods_id'=>$v['goods_id']))->getField('goods_small_logo');
            }
            //dump($cartinfo);
            $this -> assign('cartinfo',$cartinfo);
            /********获得购物车商品信息*******/

            $this -> display();
        }
    }
}
