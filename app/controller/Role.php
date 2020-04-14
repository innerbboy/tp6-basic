<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;

class Role extends BaseController
{
    public function list()
    {
        $list = Db::name('sys_role')->select();

        return ok($list);
    }


    public function test()
    {
        $token = ['token' => 'admin-token'];
        $data = ['data' => $token, 'code' => 20000];
        return json($data);

    }

}

