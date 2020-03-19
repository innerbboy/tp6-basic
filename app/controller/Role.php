<?php
namespace app\controller;

use app\BaseController;
use think\Facade\Db;

class Role extends BaseController
{
    public function list()
    {
        $list = Db::name('sys_role')->select();

        return $this->ok($list);

    }

    private function ok($data) {
        $code = 20000;
        $message = 'success';
        $result=array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );

        return json_encode($result);
    }

    private function fail($data) {
        $code = 10000;
        $message = 'fail';
        $result=array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );

        return json_encode($result);
    }

}

