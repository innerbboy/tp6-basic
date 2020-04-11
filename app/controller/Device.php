<?php

namespace app\controller;

/**
 * Class Device
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-03-31 21:05
 */
class Device extends BaseController
{

    public function list(Request $request) {
        return $this->app->deviceService->findList($request->param());
    }

    public function sync() {

    }
}
