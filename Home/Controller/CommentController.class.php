<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;

class CommentController extends HomeController {
    //添加评论
    function sendComment(){
        //$star = I('post.star');
        //$msg = I('post.msg');
        //$goods_id = I('post.goods_id');
        $comment = new \Model\CommentModel();
        $data = $comment -> create();
        //富文本编辑器内容避免tp框架的符号实体转换
        $data['cmt_msg'] = $_POST['cmt_msg']; 

        if($new_id=$comment ->add($data)){
            //获得新添加评论的信息
            $commentinfo = $comment
                ->alias('c')
                ->join('__USER__ u on c.user_id=u.user_id')
                ->field('c.cmt_msg,c.cmt_star,from_unixtime(c.add_time) time,u.user_name') 
                -> find($new_id);
            echo json_encode(array('status'=>1,'notice'=>'添加评论成功！','commentinfo'=>$commentinfo));
        }else{
            echo json_encode(array('status'=>2,'notice'=>'添加评论失败！'));
        }
    }

    //获得“评论”列表和 对应的“回复”列表信息
    function showlist(){
        //获得评论信息
        $comment = new \Model\CommentModel();
        $goods_id = I('get.goods_id');
        $page = I('get.page');
        $per = 4;//每页条数
        $offset = $page*$per;//偏移量
        $info = $comment
                ->alias('c')
                ->order('cmt_id desc')
                ->limit($offset,4)
                ->where(array('c.goods_id'=>$goods_id))
                ->join('__USER__ u on c.user_id=u.user_id')
                ->field('c.cmt_id,c.cmt_msg,c.cmt_star,from_unixtime(c.add_time) time,u.user_name') 
                -> select();
        //获得评论对应的"回复"信息
        $cmt_ids = arrayToString($info,'cmt_id');
        //dump($cmt_ids);//string(32) "14,13,12,11,10,9,8,7,6,5,4,3,2,1"
        //通过评论的$cmt_ids作为条件，获得对应的回复信息
        $backinfo = D('CommentBack')
            ->alias('b')
            ->join('__USER__ u on b.user_id=u.user_id')
            ->field('b.back_id,b.back_msg,b.cmt_id,from_unixtime(b.add_time) time,u.user_name')
            ->where(array('cmt_id'=>array('in',$cmt_ids)))
            ->select();
        //把$info 和 $backinfo 的两个二维数组变为一个四维数组
        foreach($info as $k => $v){
            foreach($backinfo as $kk => $vv){
                if($v['cmt_id']==$vv['cmt_id']){
                    $info[$k]['back_info'][] = $vv;
                }
            }
        }
        echo json_encode($info);
    }


    //收集回复内容存储到数据库
    function sendBack(){
        $back = new \Model\BackModel();

        //在BackModel的_before_insert()里边维护其他需要的字段
        $data = $back->create();
        if($new_id = $back->add($data)){
            //把最新写入的回复信息返回给客户端显示
            //给ajax回馈信息
            $backinfo = $back
                ->alias('b')
                ->join('__USER__ u on b.user_id=u.user_id')
                ->field('b.back_id,b.back_msg,b.cmt_id,from_unixtime(b.add_time) time,u.user_name')
                ->find($new_id);
            echo json_encode(array('status'=>1,'backinfo'=>$backinfo));
        }
    }
}
