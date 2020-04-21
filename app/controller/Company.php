<?php

namespace app\controller;


use app\BaseController;
use app\Request;
/**
 * Class Company
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-04-21 10:21
 */
class Company extends BaseController
{
    public function list(Request $request) {
        return $this->app->cloudService->databaseQuery('bs_company',$request->param());
    }

    public function create(Request $request) {
        // 推送到云端
        $this->app->cloudService->databaseAdd('bs_company',$request->param());
//        return ok($this->app->deviceService->insert($request->param()));
    }

    public function update(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseUpdate('bs_company',$request->param());
    }

    public function delete(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseDelete('bs_company',$request->param());
    }

}
