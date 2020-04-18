<?php
/**
 * Description: PhpStorm.
 * Autor: daiysh
 * CreateTime: 2020-03-31 10:20
 */

namespace app\service;
use app\model\DeviceModel;
use think\facade\Db;



class DeviceService
{

    public static function insert(array $data)
    {
        $device = new DeviceModel($data);
        // TODO: 推送到云端
        return $device->save();
    }

    public static function findList()
    {
        //TODO:分页查询 构造分页数据 定义一个分页类
//        $list = DeviceModel::find(1)->paginate(1,10);
        $list = Db::table('bs_device')->page(1,10)->select(); //Db::find(1)->paginate(1,10);
//        $list = Db::table('bs_device')->paginate(1)->each(function ($item,$key){
//            $item['name'] = explode('dai', $item['name']);
//        }); //Db::find(1)->paginate(1,10);

//        $count = $list->total();
        return $list;

    }
    public static function findUserList()
    {
        //TODO:分页查询 构造分页数据 定义一个分页类
        $list = Db::table('sys_user')->page(1,10)->select(); //Db::find(1)->paginate(1,10);

        return $list;

    }

    public static function findCompanyList()
    {
        //TODO:分页查询 构造分页数据 定义一个分页类
        $list = Db::table('bs_company')->page(1,10)->select(); //Db::find(1)->paginate(1,10);

        return $list;

    }

}
