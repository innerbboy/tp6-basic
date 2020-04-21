<?php

namespace app\service;

/**
 * Class CompanyService
 * @package app\service
 * Author: daiysh
 * CreateTime: 2020-04-21 10:22
 */
class CompanyService
{

    public static function findList()
    {
        //TODO:分页查询 构造分页数据 定义一个分页类
        $list = Db::table('bs_company')->page(1,10)->select(); //Db::find(1)->paginate(1,10);

        return $list;

    }
}
