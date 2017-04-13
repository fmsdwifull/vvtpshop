<?php

//模型

namespace Model;
use Think\Model;

class OrderModel extends Model{
    // 数据add写入前的回调方法
    protected function _before_insert(&$data,$options) {
        //维护订单的"其他"字段
        $data['add_time'] = time();
        $data['user_id'] = session('user_id');
        $data['order_number'] = 'itcast_'.date("YmdHis")."_".mt_rand(1000,9999);


        //通过购物车获得订单总价格
        $cart = new \Common\Tools\Cart();
        $number_price = $cart -> getNumberPrice();
        $data['order_price'] = $number_price['price'];  //订单总价格

    }

    // 数据add写入后的回调方法
    protected function _after_insert($data,$options) {
        //维护"订单商品表php41_order_goods"的数据
        $cart = new \Common\Tools\Cart();
        $cartinfo = $cart -> getCartInfo();
        $order_goods = D('OrderGoods');
        foreach($cartinfo as $k => $v){
            $arr = array(
                'goods_id'      =>$v['goods_id'],
                'goods_name'    =>$v['goods_name'],
                'order_id'      =>$data['order_id'],
                'goods_price'   =>$v['goods_price'],
                'goods_number'  =>$v['goods_number'],
            );
            $order_goods -> add($arr);//写入数据到 订单商品表
        }
        //清空购物车信息
        $cart -> delall();
    }
}
