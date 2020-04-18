<?php
namespace app\middleware;
use app\api\libs\Auth;
class CheckApiLogin
{
    public function handle($request, \Closure $next)
    {
        // 令牌验证
        Auth::getInstance()->checkLogin();
        return $next($request);
    }
}
