<?php

namespace app\model;

use think\Model;

/**
 * Class UserModel
 * @package app\model
 * Author: daiysh
 * CreateTime: 2020-03-31 10:38
 */
class UserModel extends Model
{
    protected $table = 'sys_user';

    // 模型数据不区分大小写
    protected $strict = false;

    protected $schema = [
        'id'			=>	'int',
        'phone'			=>	'int',
        'name'			=>	'string',
        'user_id'		=>	'string',
        'create_time'	=>	'datetime',
        'update_time'	=>	'datetime',
    ];

    public static function checkLogin($data){
        //1. 验证验证数据，这里要注意和之前版本的验证上是有区别的
//        try {
//            $result = validate(ManagerValidate::class)->scene('login')->check($data);
//        } catch (ValidateException $e) {
//            // 验证失败 输出错误信息
//            return return_msg(0,$e->getError());
//        }
        //2.验证密码和用户名
        $m = self::where('user_id', $data['username'])->find();
        if(!$m){
            return return_msg(0,"用户名不存在");
        }
        //验证密码是否正确
        if(password_verify($data['password'],$m['password']) !==true) return return_msg(0,"密码输入错误");
        //记录用户登录的状态
        session('username',$data['username']);
        session('userid',$m['id']);
        return return_msg(1,"登录成功");
    }
}
