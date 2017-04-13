<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;

class IndexController extends HomeController {
    public function index(){
        /***********获得推荐商品信息************/
        //推荐商品设置一个key
        S(array('type'=>'memcache','host'=>'localhost','port'=>11211));
        $tuijian_key = md5("qiang_rec_hot_new");
        $info = S($tuijian_key);//读取memcache数据

        if(empty($info)){
            echo "此时走数据库";
            $goods = D('Goods');
            $cdt['is_del'] = "不删除";
            $cdt['is_sale'] = "上架";

            //① 抢购的
            $cdt_q = $cdt;
            $cdt_q['is_qiang'] = "抢";
            $info_qiang = $goods -> where($cdt_q)->order('goods_id desc')->limit(5)->select();
            //SELECT * FROM `php41_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_qiang` = '抢' ORDER BY goods_id desc LIMIT 5
            //获得抢购的商品id信息
            $ids_q = arrayToString($info_qiang,'goods_id');
            //dump($ids_q);//string(14) "33,32,31,30,29"
            
            //② 热销的
            $cdt_h = $cdt;
            $cdt_h['is_hot'] = "热销";
            $cdt_h['goods_id'] = array('not in',$ids_q); //排除抢购的，剩下的是热销的
            $info_hot = $goods -> where($cdt_h)->order('goods_id desc')->limit(5)->select();
            $ids_h = arrayToString($info_hot,'goods_id');


            //③ 推荐的
            $cdt_c = $cdt;
            $cdt_c['is_rec'] = '推荐';
            //排除抢购的、热销的，剩下的是推荐的
            $cdt_c['goods_id'] = array('not in',$ids_q.",".$ids_h); 
            $info_rec = $goods -> where($cdt_c)->order('goods_id desc')->limit(5)->select();
            $ids_c = arrayToString($info_rec,'goods_id');

            //④ 新品
            $cdt_n = $cdt;
            $cdt_n['is_new'] = '新品';
            //排除抢购的、热销的、推荐的，剩下的是新的
            $cdt_n['goods_id'] = array('not in',$ids_q.",".$ids_h.",".$ids_c); 
            $info_new = $goods -> where($cdt_n)->order('goods_id desc')->limit(5)->select();
            //SELECT * FROM `php41_goods` WHERE `is_del` = '不删除' AND `is_sale` = '上架' AND `is_new` = '新品' AND `goods_id` NOT IN ('33','32','31','30','29','28','26','23','22','21') ORDER BY goods_id desc LIMIT 5
            $ids_n = arrayToString($info_new,'goods_id');

            //把查询好的数据放到memcache中
            $info['qiang'] = $info_qiang;
            $info['hot'] = $info_hot;
            $info['rec'] = $info_rec;
            $info['new'] = $info_new;
            S($tuijian_key,$info); 
        }

        $this -> assign('info_qiang',$info['qiang']);
        $this -> assign('info_hot',$info['hot']);
        $this -> assign('info_rec',$info['rec']);
        $this -> assign('info_new',$info['new']);
        /***********获得推荐商品信息************/

        /******获得最近登录系统的前5个用户******/
        /*
        $redis = new \Redis();
        $redis -> connect('localhost',6379);
        $redis -> select(1);
        $recent_user = $redis -> lrange('new_login',0,100);
        $this -> assign('recent_user',$recent_user);
        */
        /******获得最近登录系统的前5个用户******/

        $this -> display();
    }
}
