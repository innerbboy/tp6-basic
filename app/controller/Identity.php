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
class Identity extends BaseController
{

    public function list(Request $request) {
        return $this->app->cloudService->databaseQuery('bs_identity',$request->param());
    }

    public function create(Request $request) {
        // 推送到云端
        $this->app->cloudService->databaseAdd('bs_identity',$request->param());
    }

    public function update(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseUpdate('bs_identity',$request->param());
    }

    public function delete(Request $request) {
        // 更新云端数据
        $this->app->cloudService->databaseDelete('bs_identity',$request->param());
    }
}
