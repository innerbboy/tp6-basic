<?php
// 应用公共文件

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Cache;
use think\facade\Config;

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md


/**
 * 发送验证码
 * Author: daiyunshan
 * DateTime: 2020-03-30 13:50
 * @param $phone
 * @param $code
 * @throws ClientException
 */
function sendSms($phone,$code) {
    $smsConfig = Config::get('smsconfig');
    AlibabaCloud::accessKeyClient($smsConfig['accessKeyId'], $smsConfig['accessSecret'])
        ->regionId('cn-hangzhou')
        ->asDefaultClient();

    try {
        $result = AlibabaCloud::rpc()
            ->product('Dysmsapi')
            // ->scheme('https') // https | http
            ->version('2017-05-25')
            ->action('SendSms')
            ->method('POST')
            ->host($smsConfig['host'])
            ->options([
                'query' => [
                    'RegionId' => "cn-hangzhou",
                    'PhoneNumbers' => $phone,
                    'SignName' => $smsConfig['SignName'],
                    'TemplateCode' => $smsConfig['TemplateCode'],
                    'TemplateParam' => "{\"code\":$code}",
                    'SmsUpExtendCode' => "2",
                    'OutId' => "1",
                ],
            ])
            ->request();
        print_r($result->toArray());
    } catch (ClientException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    } catch (ServerException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    }
}

/**
 * 获取token
 * Author: daiysh
 * DateTime: 2020-03-30 15:25
 * @return mixed
 */
function getAccessToken() {
    $wxConfig = Config::get('wxconfig');
    // 将token放到缓存中
    $token = Cache::get('access_token');
    if (!$token) {
        $res = file_get_contents($wxConfig['getTokenUrl'].'&appid='.$wxConfig['appid'].'&secret='.$wxConfig['secret']);
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

/**
 * http 请求公共方法
 * Author: daiysh
 * DateTime: 2020-03-30 15:27
 * @param $url
 * @param null $data
 * @return bool|string
 */
function httpRequest($url, $data = null)
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

function ok($data) {
    $code = 20000;
    $message = 'success';
    $result=array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );

    return json_encode($result);
}

function fail($data) {
    $code = 10000;
    $message = 'fail';
    $result=array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );

    return json_encode($result);
}

