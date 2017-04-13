<?php

//模型

namespace Model;
use Think\Model;

class CommentModel extends Model{
    // 插入数据之前的回调方法
    protected function _before_insert(&$data,$options) {
        //先维护两个字段user_id /add_time
        $data['user_id'] = session('user_id');
        $data['add_time'] = time();
    }    
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
        
    }
}
