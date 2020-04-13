<?php
namespace app\controller;

use app\BaseController;
use think\Facade\Db;

class Role extends BaseController
{
    public function list()
    {
        $list = Db::name('sys_role')->select();

        return json($list);

    }


    public function test()
    {
        $token = ['token' => 'admin-token'];
        $data = ['data' => $token, 'code' => 20000];
        return json($data);

    }

}

