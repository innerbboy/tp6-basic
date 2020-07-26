<?php

namespace app\controller;

use app\BaseController;
use app\Request;

/**
 * Class DailyCheck
 *
 * @package app\controller
 * Author: daiysh
 * CreateTime: 2020-03-31 21:05
 */
class DailyCheck extends BaseController
{

    public function list(Request $request) {
        return $this->app->cloudService->databaseQuery('bs_daily_check',$request->param());
    }

    public function create(Request $request) {
        $this->app->cloudService->dailyCheckAdd('bs_daily_check',$request->param());
    }

    public function update(Request $request) {
        $this->app->cloudService->databaseUpdate('bs_daily_check',$request->param());
    }

    public function delete(Request $request) {
        $this->app->cloudService->databaseDelete('bs_daily_check',$request->param());
    }

}
