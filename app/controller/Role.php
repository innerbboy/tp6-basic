<?php
namespace app\controller;

use app\BaseController;
use think\Facade\Db;

class Role extends BaseController
{
    public function list()
    {
        $list = '角色列表';
        try {
            $list = Db::name('sys_role')->select();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return json($list);

    }


    public function test()
    {
        $token = ['token' => 'admin-token'];
        $data = ['data' => $token, 'code' => 20000];
        return json($data);

    }

}

