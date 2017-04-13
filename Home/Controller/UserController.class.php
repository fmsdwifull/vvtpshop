<?php
namespace Home\Controller;
//use Think\Controller;
use Common\Tools\HomeController;

class UserController extends HomeController {
    public function login(){
        //两个逻辑：展示、收集
        if(IS_POST){
            //用户名/密码校验，、
            $user = D('User');
            $name = $_POST['user_name'];
            $pwd = $_POST['user_pwd'];
            $info = $user -> where(array('user_name'=>$name,'user_pwd'=>md5($pwd)))->find();

            if($info){
                if($info['user_check'] === "1"){
                    //已经通过邮件激活账号
                    //持久化用户信息
                    session('user_id',$info['user_id']);
                    session('user_name',$name);

                    //页面跳转
                    //$this -> redirect($url,$params=array(),$delay=间隔时间,$msg='');

                    //判断用户是否有定义要跳转到的地址
                    $back_url = session('back_url');
                    if(!empty($back_url)){
                        session('back_url',null); //销毁，该地址只只用一次
                        $this -> redirect($back_url);
                    }

                    /****把用户名称存储到redis里边****/
                    $redis = new \Redis();
                    $redis -> connect('localhost',6379);
                    $redis -> select(1);
                    $redis -> lrem('new_login',$name,0);//去除重复的用户
                    $redis -> lpush('new_login',$name);
                    $redis -> ltrim('new_login',0,4);
                    /****把用户名称存储到redis里边****/


                    $this -> redirect('Index/index');
                }
                $this -> error('请先通过邮件激活您的账号',U('showRegister'),1);
                exit;
            }
            $this -> error('用户名或密码不存在',U('login'),1);

        }else{
            $this -> display();
        }
    }

    function qq_login(){
        //通过openid获得qq账号信息
        //把qq账号信息添加到自己的数据库里边
        //session持久化qq相关的信息
        /*        dump($_SESSION);
        array(7) {
          ["appid"] => int(101277963)
          ["appkey"] => string(32) "9f92bca6541bcb121e626d477f11b6c0"
          ["callback"] => string(54) "http://www.hulaquan.cc/Plugin/qq/oauth/qq_callback.php"
          ["scope"] => string(88) "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo"
          ["state"] => string(32) "36c6c2ab832d857d3ca98d035af6de16"
          ["access_token"] => string(32) "9AD2AA9BADD3F210590851263C8A3633"
          ["openid"] => string(32) "CE464731B8886F0F4287436B1558883D"
        }
        */
        //调用获取qq账号信息的接口
        //在当前页面调用file_get_contents()触发请求其他页面，不给传递session信息
        //可以自己手动get传递

        $userinfo = file_get_contents("http://www.hulaquan.cc/Plugin/qq/user/get_user_info.php?access_token=".$_SESSION['access_token']."&appid=".$_SESSION['appid']."&openid=".$_SESSION['openid']);
        
        $userinfo = json_decode($userinfo,true);
        //把收集到的信息写入数据库
        $arr = array(
            'user_name' => $userinfo['nickname'],
            'user_sex'  => $userinfo['gender'],
            'openid'  => $_SESSION['openid'],
            'user_pwd'  => md5(123),
        );
        $user = new \Model\UserModel();

        //判断此qq账号之前是否已经登陆过
        //登录：update更新
        //没有登录:insert写入
        $oneinfo = $user -> where(array('openid'=>$_SESSION['openid']))->find();
        if($oneinfo){
            $user ->where(array('openid'=>$_SESSION['openid']))-> save($arr);
        }else{
            if($newid = $user -> add($arr)){
                //持久化用户信息
            }
        }

        session('user_id',$newid['user_id']);
        session('user_name',$userinfo['nickname']);
        $this -> redirect('Index/index');
    }

    function logout(){
        session(null);
        $this -> redirect('Index/index');
    }

    public function regist(){
        //两个逻辑：展示、收集
        $user = new \Model\UserModel();
        if(IS_POST){

            $data = $user -> create(); //过滤非法字段
            if($user->add($data)){
                $this -> success('注册成功',U('showRegister'),1);
            }else{
                $this -> error('注册失败',U('regist'),1);
            }

        }else{
            $this -> display();
        }
    }

    function verifyImg(){
        //显示验证码
        $cfg = array(
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            'fontSize'  =>  15,              // 验证码字体大小(px)
        );
        $very = new \Think\Verify($cfg);
        $very -> entry();
    }
    //ajax过来校验验证码
    function checkCode(){
        $code = I('get.code'); //获得用户输入的验证码
        $vry = new \Think\Verify();
        if($vry -> check($code)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>2));
        }
    }

    //用户注册成功后显示相关信息
    function showRegister(){
        $this -> display();
    }

    //会员邮箱激活
    function jihuo(){
        $user_id = I('get.user_id');
        $checkcode = I('get.checkcode');

        //更改user_check=1,user_check_code=null
        $user = D('User');
        //首先需要验证，再激活
        $userinfo = $user ->where(array('user_check'=>0))-> find($user_id);
        if($userinfo['user_check_code']===$checkcode){
            //2天之内需要激活账号，否则删除此账号
            if(time()-$userinfo['add_time']<3600*24*2){
                //验证码比较成功再激活
                $z = $user -> setField(array('user_id'=>$user_id,'user_check'=>1,'user_check_code'=>''));
                if($z){
                    $this -> success('会员激活成功',U('login'),1);
                }
            }else{
                //超过两天没有激活的账号就删除
                $user -> delete($user_id);
            }
        }else{
            $this -> error('操作有错误或账号已经激活',U('login'),1);
        }
    }

    //判断用户是否登录系统
    function isLogin(){
        $user_id = session('user_id');
        if($user_id){
            echo json_encode(array('status'=>1));//有登录系统
        }else {
            echo json_encode(array('status'=>2));//没有登录系统
        }
    }
}
