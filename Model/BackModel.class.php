<?php

//商品goodsmodel模型

namespace Model;
use Think\Model;

class BackModel extends Model{
    //定义操作的真实数据表
    // 数据表名（不包含表前缀）
    protected $tableName        =   'comment_back';

    // 插入数据前的回调方法
    protected function _before_insert(&$data,$options) {
        $data['user_id'] = session('user_id');
        $data['add_time'] = time();
    }
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
    }
}
