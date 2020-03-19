<?php
namespace app\controller;

use app\BaseController;
use app\Request;
use think\facade\Cache;
/**
 * Created by PhpStorm.
 * User: daiyunshan
 * Date: 2020-03-18
 * Time: 10:22
 */

class Member extends BaseController
{

    public function getAccessToken() {
        $appid = 'wxc429fdf05d591605'; //获取用户唯一凭证
        $secret = '6d92b57ad1d5137a1c4a3cc7c34f7705'; //用户唯一凭证密钥
        // 将token放到缓存中
        $token = Cache::get('access_token');
        if (!$token) {
            $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' .$appid.'&secret='. $secret);
            $res = json_decode($res, true);
            $token = $res['access_token'];
            $time = $res['expires_in'];
            if($token){
                // 缓存在3600秒之后过期
                Cache::set('access_token', $token, $time);
            }
        }
        return $token;

    }

    public function list($env,$query,Request $request) {
//        $query = 'db.collection(\"member\").get()';
//        $env = 'test-87exc';
        $url = 'https://api.weixin.qq.com/tcb/databasequery?access_token=' . $this->getAccessToken();
        $obj = new class{};
        $obj->env = $env;
        $obj->query = $query;
        $data = json_encode($obj);

        return $this->http_request($url,$data);

    }

    public function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
