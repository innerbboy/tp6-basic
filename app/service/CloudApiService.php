<?php
namespace app\service;

class CloudApiService
{
    //定义一个静态成员变量
    protected static $env = 'test-87exc';
    protected static $http_api_url = 'https://api.weixin.qq.com/tcb/databasequery?access_token=';

    // 设置云环境Id的值
    public static function setEnv($envId){
           self::$env = $envId;
    }

    public static function databaseQuery($param) {
        $query = 'db.collection(\"member\").get()';
        $url = self::$http_api_url . getAccessToken();
        $obj = new class{};
        $obj->env = self::$env;
        $obj->query = $query;// $param['query'];
        $data = json_encode($obj);

        return httpRequest($url,$data);

    }

    public static function test() {
        $url = self::$http_api_url . getAccessToken();
        return json($url);
    }
    public static function test2() {
        $url = self::$http_api_url;
        return json($url);
    }

    public static function databaseAdd($param) {

    }

    public static function syncTable($table) {
        $url = self::$http_api_url . getAccessToken();
        $query = 'db.collection('.$table.').get()';
        $obj = new class{};
        $obj->env = self::$env;
        $obj->query = $query;

        $data = json_encode($obj);
        $output = httpRequest($url,$data);

        // TODO:保存到数据库中

    }
}
