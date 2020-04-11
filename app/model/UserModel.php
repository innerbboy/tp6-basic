<?php

namespace app\model;

use think\Model;

/**
 * Class UserModel
 * @package app\model
 * Author: daiysh
 * CreateTime: 2020-03-31 10:38
 */
class UserModel extends Model
{
    protected $table = 'sys_user';

    // 模型数据不区分大小写
    protected $strict = false;

    protected $schema = [
        'id'			=>	'int',
        'phone'			=>	'int',
        'name'			=>	'string',
        'user_id'		=>	'string',
        'create_time'	=>	'datetime',
        'update_time'	=>	'datetime',
    ];
}
