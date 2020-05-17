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
    public function login(Request $request) {
        $data = $request->param();
        // 0 校验参数，把数据交由模型层来进行处理
        $checkData = UserModel::checkLogin($data);
        if ($checkData['code'] == 1) {
            return $checkData;
        }

        // 1 设置token
        // 2 返回token到前端
        Auth::getInstance()->setToken();
        $token = Auth::getInstance()->getToken();
        $data = ['token' => $token];
        $result = ['data' => $data, 'code' => 20000];
        return json($result);

    }

    public function info()
    {
        //1 根据token查询用户信息
        $roles=array(0=>"admin");
        $result = ['roles' => $roles, 'name' => 'Super Admin', 'avatar' =>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif'];
        $data = ['code' => 20000, 'msg' => 'success', 'data' => $result];

        return json($data);
    }

    public function logout(Request $request)
    {
        $token = $request->param()['token'];
        //1 根据用户名，清除token+过期时间
        $user = UserModel::where('token','=',$token)->find();
        $user->token = null;
        $user->expire_time = 0;
        $user->save();
    }

    public function create(Request $request)
    {
        $returnvalue = $this->app->userService->insert($request->param());
        return ok(json($returnvalue));
    }

    public function update(Request $request)
    {
        $returnvalue = $this->app->userService->update($request->param());
        return ok(json($returnvalue));
    }

    public function delete(Request $request)
    {
        $returnvalue = $this->app->userService->delete($request->param());
        return ok(json($returnvalue));
    }

}
