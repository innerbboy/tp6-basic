<?php
namespace app\api\libs;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use app\exception\HttpExceptions;

/**
 * 接入阿里云服务（短信服务）
 * Class Aliyun
 * @package app\api\libs
 */
class Aliyun
{
    private $AccessKeyId;
    private $AccessKeySecret;
    private $SignName;
    private $TemplateCode;

    public function __construct()
    {
        $this->AccessKeyId = config("Aliyun.Sms.AccessKeyId");
        $this->AccessKeySecret = config("Aliyun.Sms.AccessKeySecret");
        $this->SignName = config("Aliyun.Sms.SignName");
        $this->TemplateCode = config("Aliyun.Sms.TemplateCode");
    }


    public function sendSms($phone, $code)
    {
        AlibabaCloud::accessKeyClient($this->AccessKeyId, $this->AccessKeySecret)
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $phone,
                        'SignName' => $this->SignName,
                        'TemplateCode' => $this->TemplateCode,
                        'TemplateParam' => json_encode(['code' => $code])
                    ],
                ])
                ->request();
            $result = $result->toArray();
            if ($result["Code"] == "OK") {
                return true;
            } else {
                throw new HttpExceptions(403, $result['Message'], 19999);
            }
        } catch (ClientException $e) {
            throw new HttpExceptions(403, "短信服务异常", 19999);
        } catch (ServerException $e) {
            throw new HttpExceptions(403, "短信服务异常", 19999);
        }
    }
}
