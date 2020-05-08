<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');
//
//Route::group('admin',function(){
//    Route::get('device/list','/Device/list');
//})->middleware('checkApiLogin');

// ----- 需要token 验证的接口
// Route::get('device/list','/Device/list')->middleware('checkApiLogin');



// ----- 需要验证admin登录的接口
//Route::group('admin',function(){
//    Route::get('/Device/list');
//})->middleware('checkAdminLogin');

//Route::post('device/index','Device/list')->middleware('checkApiLogin');

