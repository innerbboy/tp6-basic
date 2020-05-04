<?php
namespace app\controller;

use app\BaseController;
use app\Request;

class Role extends BaseController
{
    public function list(Request $request) {
        // 从小程序端获取
        return $this->app->cloudService->databaseQuery('sys_role',$request->param());
    }

    public function test()
    {
        $token = ['token' => 'admin-token'];
        $data = ['data' => $token, 'code' => 20000];
        return json($data);

    }

}

