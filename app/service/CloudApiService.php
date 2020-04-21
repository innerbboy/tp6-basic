<?php
namespace app\service;

class CloudApiService
{
    //定义一个静态成员变量
    protected static $env = 'test-87exc';
    protected static $http_api_url = 'https://api.weixin.qq.com/tcb/databasequery?access_token=';
    protected static $HTTPAPI_DATABASE_ADD = 'https://api.weixin.qq.com/tcb/databaseadd?access_token=';

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

    public static function databaseAdd($collection,array $dataObj) {
        $url = self::$HTTPAPI_DATABASE_ADD . getAccessToken();
        try  {
            $modelObj = new class{};
            $modelObj->data = $dataObj;
            $query = "db.collection(\"bs_device\").add(" . json_encode($modelObj) . ")";

            $obj = new class{};
            $obj->env = self::$env;
            $obj->query = $query;// $param['query'];
            $data = json_encode($obj);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        httpRequest($url,$data);
    }

}
