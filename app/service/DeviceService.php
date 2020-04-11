<?php
/**
 * Description: PhpStorm.
 * Autor: daiysh
 * CreateTime: 2020-03-31 10:20
 */

namespace app\service;
use app\model\DeviceModel;
use app\model\UserModel;


class DeviceService
{

    public static function insert(array $data)
    {
        $user = new UserModel($data);
        return $user->save();
    }

    public static function findList()
    {
        $list = DeviceModel::find(1);

        return $list;

    }

}
