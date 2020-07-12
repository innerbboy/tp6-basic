<?php

namespace app\service;

class CloudApiService
{
    //定义一个静态成员变量
    protected static $env = 'test-87exc';
    // 开发环境
//    protected static $env = 'dev-jxhh-20200306';
    protected static $http_api_url = 'https://api.weixin.qq.com/tcb/databasequery?access_token=';
    protected static $HTTPAPI_DATABASE_ADD = 'https://api.weixin.qq.com/tcb/databaseadd?access_token=';
    protected static $HTTPAPI_DATABASE_UPDATE = 'https://api.weixin.qq.com/tcb/databaseupdate?access_token=';
    protected static $HTTPAPI_DATABASE_DELETE = 'https://api.weixin.qq.com/tcb/databasedelete?access_token=';

    // 设置云环境Id的值
    public static function setEnv($envId)
    {
        self::$env = $envId;
    }

    public static function databaseQuery($collection, $param)
    {
        $query = "db.collection('" . $collection . "')";
        if (strcmp($collection, 'bs_device') == 0) {
            $query = $query . self::getDeviceQuery($param);
            $query = $query . self:: wrapPage($param);
            $query = $query . ".orderBy('createTime', 'desc')";
        }
        if (strcmp($collection, 'bs_device_type') == 0) {
            $query = $query . self::getDeviceTypeQuery($param);
            $query = $query . self:: wrapPage($param);
            $query = $query . ".orderBy('createTime', 'desc')";
        }
        if (strcmp($collection, 'bs_identity') == 0) {
            $query = $query . self:: wrapPage($param);
            $query = $query . ".orderBy('createTime', 'desc')";
        }
        if (strcmp($collection, 'cloud_member') == 0) {
            $query = $query . self::getMemberQuery($param);
            $query = $query . self:: wrapPage($param);
            $query = $query . ".orderBy('createTime', 'desc')";
        }
        if (strcmp($collection, 'bs_identity') == 0) {
            $query = $query . self::getIdentityQuery($param);
            $query = $query . self:: wrapPage($param);
            $query = $query . ".orderBy('createTime', 'desc')";
        }

        $query = $query . ".get()";
        $url = self::$http_api_url . getAccessToken();
        $obj = new class
        {
        };
        $obj->env = self::$env;
        $obj->query = $query;// $param['query'];
        $data = json_encode($obj);

        return httpRequest($url, $data);

    }

    private static function wrapPage($param)
    {
        $skipSize = ($param['page'] - 1) * $param['limit'];
        $limitSize = $param['limit'];
        $pageStr = ".skip(" . $skipSize . ").limit(" . $limitSize . ")";

        return $pageStr;

    }

    private static function getIdentityQuery($param)
    {
        $where = "";
        if ($param['name']) {
            $condition = array();
            if ($param['name']) {
                $condition['real_name'] = $param['name'];
            }
            if ($param['phone']) {
                $condition['phone'] = $param['phone'];
            }

            $where = ".where(" . json_encode($condition) . ")";
        }

        return $where;
    }

    private static function getMemberQuery($param)
    {
        $where = "";
        if ($param['nickname'] || $param['phone']) {
            $condition = array();
            if ($param['nickname']) {
                $condition['nickname'] = $param['nickname'];
            }
            if ($param['phone']) {
                $condition['phone'] = $param['phone'];
            }
            $where = ".where(" . json_encode($condition) . ")";
        }

        return $where;
    }

    private static function getDeviceQuery($param)
    {
        $where = "";
        if ($param['name'] || $param['model_type'] || $param['company_code'] || $param['device_code']) {
            $condition = array();
            if ($param['name']) {
                $condition['name'] = $param['name'];
            }
            if ($param['model_type']) {
                $condition['model_type'] = $param['model_type'];
            }
            if ($param['company_code']) {
                $condition['company_code'] = $param['company_code'];
            }
            if ($param['device_code']) {
                $condition['device_code'] = $param['device_code'];
            }
            $where = ".where(" . json_encode($condition) . ")";
        }

        return $where;
    }

    private static function getDeviceTypeQuery($param)
    {
        $where = "";
        if ($param['name'] || $param['company_code'] || $param['device_code']) {
            $condition = array();
            if ($param['name']) {
                $condition['name'] = $param['name'];
            }
            if ($param['company_code']) {
                $condition['company_code'] = $param['company_code'];
            }
            if ($param['device_code']) {
                $condition['device_code'] = $param['device_code'];
            }
            $where = ".where(" . json_encode($condition) . ")";
        }

        return $where;
    }

    public static function findDailyCheckList($collection, $param)
    {
        $query = "db.collection('" . $collection . "').where({kind_type:" . $param['kindType'] . "}).get()";
        $url = self::$http_api_url . getAccessToken();
        $obj = new class
        {
        };
        $obj->env = self::$env;
        $obj->query = $query;// $param['query'];
        $data = json_encode($obj);

        return httpRequest($url, $data);

    }

    public static function findCompanyList()
    {
        $query = "db.collection('bs_company').limit(100).get()";
        $url = self::$http_api_url . getAccessToken();
        $obj = new class
        {
        };
        $obj->env = self::$env;
        $obj->query = $query;
        $data = json_encode($obj);

        return httpRequest($url, $data);
    }

    public static function findDeviceList()
    {
        // limit 默认10条，这里设置为1000条
        $query = "db.collection('bs_device').limit(1000).orderBy('createTime', 'desc').get()";
        $url = self::$http_api_url . getAccessToken();
        $obj = new class
        {
        };
        $obj->env = self::$env;
        $obj->query = $query;
        $data = json_encode($obj);

        return httpRequest($url, $data);
    }

    public static function findTypeList()
    {
        // limit 默认10条，这里设置为100条
        $query = "db.collection('bs_device_type').limit(100).orderBy('createTime', 'desc').get()";
        $url = self::$http_api_url . getAccessToken();
        $obj = new class
        {
        };
        $obj->env = self::$env;
        $obj->query = $query;
        $data = json_encode($obj);

        return httpRequest($url, $data);
    }


    public static function databaseAdd($collection, array $dataObj)
    {
        $url = self::$HTTPAPI_DATABASE_ADD . getAccessToken();
        try {
            $modelObj = new class{};
            $modelObj->data = $dataObj;
            $query = "db.collection('" . $collection . "').add(" . json_encode($modelObj) . ")";

            $obj = new class{};
            $obj->env = self::$env;
            $obj->query = $query;// $param['query'];
            $data = json_encode($obj);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        httpRequest($url, $data);
    }

    public static function databaseUpdate($collection, $dataObj)
    {
        $url = self::$HTTPAPI_DATABASE_UPDATE . getAccessToken();
        try {
            $modelObj = new class{};
            $modelObj->data = $dataObj;
            $query = "db.collection('" . $collection . "').where({_id:'" . $dataObj['_id'] . "'}).update(" . json_encode($modelObj) . ")";

            $obj = new class{};
            $obj->env = self::$env;
            $obj->query = $query;// $param['query'];
            $data = json_encode($obj);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        httpRequest($url, $data);
    }


    public static function batchUpdateCompany($collection, $param)
    {
        $ids = $param['ids'];
        $idsLength = count($ids);
        $company_code = $param['company_code'];
        $company_name = $param['company_name'];
        // TODO:遍历ids，更新公司
        for ($x = 0; $x < $idsLength; $x++) {
            $id = $ids[$x];
            $obj = array();
            $obj['id'] = $id;
            $obj['company_code'] = $company_code;
            $obj['company_name'] = $company_name;
            self::updateDeviceType($collection,$obj);
        }


    }
    public static function updateDeviceType($collection, $dataObj) {
        $url = self::$HTTPAPI_DATABASE_UPDATE . getAccessToken();
        try  {
            $modelObj = new class{};
            $modelObj->data = $dataObj;
            $query = "db.collection('" . $collection . "').where({_id:'" . $dataObj['id'] . "'}).update(" . json_encode($modelObj) . ")";

            $obj = new class{};
            $obj->env = self::$env;
            $obj->query = $query;// $param['query'];
            $data = json_encode($obj);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        httpRequest($url,$data);
    }

    public static function databaseDelete($collection, array $dataObj)
    {
        $url = self::$HTTPAPI_DATABASE_DELETE . getAccessToken();
        try {
            $modelObj = new class
            {
            };
            $modelObj->data = $dataObj;
            $query = "db.collection('" . $collection . "').where({_id:'" . $dataObj['_id'] . "'}).remove()";

            $obj = new class
            {
            };
            $obj->env = self::$env;
            $obj->query = $query;
            $data = json_encode($obj);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        httpRequest($url, $data);
    }

}
