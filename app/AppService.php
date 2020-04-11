<?php
declare (strict_types = 1);

namespace app;

use app\service\CloudApiService;
use app\service\UserService;
use think\Service;

/**
 * 应用服务类
 */
class AppService extends Service
{
    public function register()
    {
        // 服务注册
        $this->app->bind('cloudService',CloudApiService::class);
        $this->app->bind('userService',UserService::class);
    }

    public function boot()
    {
        // 服务启动
    }
}
