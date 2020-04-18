<?php

namespace app\model;

use think\Model;

class DeviceModel extends Model
{

    protected $table = 'bs_device';

    // 模型数据不区分大小写(貌似没有起到什么作用)
    protected $strict = false;

    protected $schema = [
        'id'			=>	'int',
        'name'			=>	'string',
        'model_type'	=>	'string',
        'unit'		    =>	'string',
        'manufacturer'	=>	'string',
        'manufact_number' =>	'string',
        'manufact_date'	=>	'datetime',
        'use_date'		=>	'string',
        'purpose'		=>	'string',
        'remark'		=>	'string',
        'create_time'	=>	'datetime',
        'update_time'	=>	'datetime'
    ];
}
