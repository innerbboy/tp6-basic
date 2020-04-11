<?php
namespace app\controller;

use app\BaseController;
use think\Facade\Db;

class Role extends BaseController
{
    public function list()
    {
        $list = Db::name('sys_role')->select();

        return ok($list);

    }

}

