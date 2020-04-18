<?php


namespace app\api\libs;

use app\model\UserModel;
use think\facade\Request;

/**
 * 1.生成令牌
 * 2.设置登录状态
 * 3.验证登录状态
 * Class Auth
 * @package app\api\libs
 */
class Auth
{
    private $token = '';
    private $username = '';
    private static $instance = null;

    private function __construct()
    {
        $request  = Request::instance();
        $this->username = $request->post('username');
        $this->token = $request->param('token');
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    //统一的入口
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    //获取token
    public function getToken(){
        return $this->token;
    }

    //生成token
    private function createToken(){
        $this->token = md5($this->username.time().rand(100000,999999));
    }

    //设置token 保持登录状态
    public function setToken(){
        $this->createToken();
        //写入数据表
        $user = (new User())->where('username','=',$this->username)->find();
        $user->login_code = $this->token;
        $user->expiration_time = time()+config('auth.expire_time');
        $user->save();
        return $this;
    }

    //验证,10006：无权限
    public function checkLogin(){
        //1.到数据库中查询用户信息，token
        $user = (new UserModel())->where('login_code','=',$this->token)->find();
        if(!$user){
            throw new HttpExceptions(403,"无权限",10006);
        }
        //2. 登录是否过期   10007：超时
        if($user['expiration_time']<time()){
            throw new HttpExceptions(403,"登录超时",10007);
        }
        //延期过期时间
        if(($user->expiration_time-time())<5){
            $user->expiration_time = time()+config('auth.expire_time');
            $user->save();
        }
        // echo $user->expiration_time."\n";
        return true;
    }
}
