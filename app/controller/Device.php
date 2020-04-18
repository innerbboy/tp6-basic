<?php

namespace app\controller;

use app\BaseController;
use app\Request;

/**
 * Class Device
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-03-31 21:05
 */
class Device extends BaseController
{

    public function list(Request $request) {
        return ok($this->app->deviceService->findList($request->param()));
    }

    public function userlist(Request $request) {
        return ok($this->app->deviceService->findUserList($request->param()));
    }

    public function companylist(Request $request) {
        return ok($this->app->deviceService->findCompanyList($request->param()));
    }

    public function create(Request $request) {
        return ok($this->app->deviceService->insert($request->param()));
    }

    public function sync() {

    }
}
