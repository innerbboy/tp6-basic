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
//        return ok($this->app->deviceService->findList($request->param()));
        // 从小程序端获取
        return $this->app->cloudService->databaseQuery('bs_device',$request->param());
    }

    public function userlist(Request $request) {
        return ok($this->app->deviceService->findUserList($request->param()));
    }

    public function companylist(Request $request) {
        return ok($this->app->deviceService->findCompanyList($request->param()));
    }

    public function identityList(Request $request) {
        return $this->app->cloudService->databaseQuery('bs_identity',$request->param());
    }

    public function create(Request $request) {
        // 推送到云端
        $this->app->cloudService->databaseAdd('bs_device',$request->param());
//        return ok($this->app->deviceService->insert($request->param()));
    }

    public function update(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseUpdate('bs_device',$request->param());
    }

    public function delete(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseDelete('bs_device',$request->param());
    }

    public function sync() {

    }
}
