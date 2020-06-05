<?php

namespace app\controller;

use app\BaseController;
use app\Request;

/**
 * Class DeviceType
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-03-31 21:05
 */
class DeviceType extends BaseController
{

    public function list(Request $request) {
        // 从小程序端获取
        return $this->app->cloudService->databaseQuery('bs_device',$request->param());
    }

    public function typeList(Request $request) {
        return $this->app->cloudService->findTypeList($request->param());
    }

    public function create(Request $request) {
        // 推送到云端
        $this->app->cloudService->databaseAdd('bs_device',$request->param());
    }

    public function update(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseUpdate('bs_device',$request->param());
    }

    public function updateCompany(Request $request) {
        // 批量更新公司
        $this->app->cloudService->batchUpdateCompany('bs_device',$request->param());
    }

    public function delete(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseDelete('bs_device',$request->param());
    }

}
