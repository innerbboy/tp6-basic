<?php

namespace app\controller;
use app\BaseController;
use Qcloud\Cos\Client;
use think\facade\Db;


class File extends BaseController
{
    /**
     * 接收上传文件
     *
     * Author: daiysh
     * CreateTime: 2020-04-25 10:03
     * @return \think\response\Json
     */
    public function upload() {
        // 上传文件到腾讯云
        return json($this->upload2cloud($_FILES['file']));


    }

    private function upload2cloud($file) {
        // 0 从数据库中取值
        $config = Db::table('sys_config')->where('type','tencentYun')->findOrEmpty();//->where('type', tencentYun)->find();
        // 初始化
        $secretId = $config['app_id'];//"AKIDUn13vcDWRRHvMarib1NISQH3agUAnBQQ"; //"云 API 密钥 SecretId";
        $secretKey = $config['app_secret'];//"wjPq42uo5HOXG7rKgjtjR4gCrQyQqAYn"; //"云 API 密钥 SecretKey";
        $region = "ap-guangzhou"; //设置一个默认的存储桶地域
        $cosClient = new Client(
            array(
                'region' => $region,
                'schema' => 'https', //协议头部，默认为http
                'credentials'=> array(
                    'secretId'  => $secretId ,
                    'secretKey' => $secretKey)));
        // 上传文件流
        try {
            //存储桶名称 格式：BucketName-APPID
            $bucket = "upload-1300792747";

            $fileName = $file['name'];
            // 文件名+时间戳生成唯一的文件名
            $key = "jxshhkj/device/" . time() . substr($fileName,strpos($fileName, '.'),strlen($fileName));
            $fileObj = fopen($file['tmp_name'], "rb");
            if ($fileObj) {
                $result = $cosClient->putObject(array(
                    'Bucket' => $bucket,
                    'Key' => $key,
                    'Body' => $fileObj
                ));

                return "https://" . $result['Location'];
            }
        } catch (\Exception $e) {
            echo "$e\n";
        }

        return null;
    }

}
