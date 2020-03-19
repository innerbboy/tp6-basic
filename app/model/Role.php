<?php
namespace app\model;

use think\Model;

class Role extends Model
{

    protected $schema = [
        'id'			=>	'int',
        'name'			=>	'string',
        'create_time'	=>	'datetime',
        'update_time'	=>	'datetime',
    ];
}
