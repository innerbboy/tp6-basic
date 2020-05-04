<?php
/**
 * Description: PhpStorm.
 * Autor: daiysh
 * CreateTime: 2020-03-31 10:20
 */

namespace app\service;
use app\model\UserModel;
use think\facade\Db;


class UserService
{

    public static function insert(array $data)
    {
        $user = new UserModel($data);
        return $user->save();
    }

    public static function update(array $data)
    {
        $user = UserModel::find($data['id']);
        return $user->save($data);
    }

    public static function delete(array $data)
    {
        Db::name('sys_user')->where('id', $data['id'])->delete();

    }


    public static function findList()
    {
        //分页查询 构造分页数据 定义一个分页类
        $list = Db::table('sys_user')->page(1, 10)->select(); //Db::find(1)->paginate(1,10);
        return $list;
    }

}
