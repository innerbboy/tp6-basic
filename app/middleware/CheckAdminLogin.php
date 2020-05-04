<?php

namespace app\middleware;
use think\facade\Session;

class CheckAdminLogin
{
    public function handle($request, \Closure $next)
    {
        // 登录验证，判断用户的登录状态，如果没有登录直接重定向到登录页面
        // 和前端放在一个文件夹，是不是可以获取到session呢
        if(!Session::has('username') || !Session::has('userid')){
            return redirect('user/login');
        }
        return $next($request);
    }


}
