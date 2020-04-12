<?php
namespace app\controller;

use app\BaseController;
use app\Request;

/**
 * Class Member
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-03-30 17:30
 */
class Member extends BaseController
{

    /**
     * 会员列表
     * Author: daiysh
     * DateTime: 2020-03-30 17:28
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request) {
        return $this->app->cloudService->databaseQuery($request->param());
    }

    public function test(Request $request) {
        return $this->app->cloudService->test();
    }

    public function sync() {

    }

}
