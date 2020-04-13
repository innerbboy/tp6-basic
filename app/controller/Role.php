<?php
namespace app\controller;

use app\BaseController;
use think\db\exception\DbException;
use think\Facade\Db;
use think\Facade\Cache;

class Role extends BaseController
{
    public function list()
    {
        $list = '角色列表';
        try {
            $token = Cache::get('access_token');
            echo $token;
            $list = Db::name('sys_role')->select();
        } catch (DbException $e) {
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

