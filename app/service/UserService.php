<?php
/**
 * Description: PhpStorm.
 * Autor: daiysh
 * CreateTime: 2020-03-31 10:20
 */

namespace app\service;
use app\model\UserModel;


class UserService
{

    public static function insert(array $data)
    {
        $user = new UserModel($data);
        return $user->save();
    }

    public static function delete()
    {
        Db::name('sys_user')->where('id', 1)->delete();

    }


    public static function findList()
    {
        //TODO:分页查询 构造分页数据 定义一个分页类
        $list = Db::table('sys_user')->page(1, 10)->select(); //Db::find(1)->paginate(1,10);
        return $list;
    }

}
