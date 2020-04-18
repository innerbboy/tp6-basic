<?php
namespace app\controller;

use app\api\libs\Auth;
use app\BaseController;
use app\Request;
use app\model\UserModel;

class User extends BaseController
{

    public function list(Request $request) {
        return ok($this->app->userService->findList($request->param()));
    }
    public function doLogin(Request $request) {
        $data = $request::post();
        // 把数据交由模型层来进行处理
        UserModel::checkLogin($data);

        // 如果验证成功
        // 1 设置token
        // 2 返回token到前端
        Auth::getInstance()->setToken();
        $token = Auth::getInstance()->getToken();
        $data = ['data' => $token, 'code' => 20000];
        return json($data);

    }
    public function login(Request $request)
    {
        //1 校验参数
        //2 生成token
        //3 存储token
//        $data = $request::post();
//        // 把数据交由模型层来进行处理
//        UserModel::checkLogin($data);
//
//        // 如果验证成功
//        // 1 设置token
//        // 2 返回token到前端
//        Auth::getInstance()->setToken();
//        $token = Auth::getInstance()->getToken();
//        $data = ['data' => $token, 'code' => 20000];
//        return json($data);

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

    public function add(Request $request)
    {
        $returnvalue = $this->app->userService->insert($request->param());
        return ok(json($returnvalue));
    }

}
