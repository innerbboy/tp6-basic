<?php
namespace app\controller;

use app\BaseController;
use app\Request;

class User extends BaseController
{
    public function login(Request $request)
    {
        //1 校验参数
        //2 生成token
        //3 存储token
        $token = ['token' => 'admin-token'];
        $data = ['data' => $token, 'code' => 20000];
        return json($data);
    }

    public function info()
    {
        //1 根据token查询用户信息
        $roles=array(0=>"admin");
        $result = ['roles' => $roles, 'name' => 'Super Admin',"introduction" => '',"avatar" =>''];
        $data = ['code' => 20000, 'msg' => 'success', 'data' => $result];

        return json($data);
    }

    public function logout()
    {
        //1 清除token
        session('token',null);
        $data = ['code' => 20000, 'msg' => 'success'];

        return json($data);

    }

}
