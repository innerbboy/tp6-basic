<?php
namespace app\exception;

use think\exception\Handle;
use think\facade\Env;
use think\Response;
use Throwable;

class ExceptionHandle extends Handle
{
    private $msg ="未知错误";
    private $httpcode =500;
    private $errorcode =19999;
    public function render($request, Throwable $e): Response
    {
        //获取调试状态
        if(Env::get("APP_DEBUG")==1){
            // 其他错误交给系统处理
            return parent::render($request, $e);
        }

        $this->msg = $e->getMessage()?:$this->msg;
        if($e instanceof HttpExceptions){
            $this->httpcode = $e->getStatusCode()?:$this->httpcode;
        }
        $this->errorcode = $e->getCode()?:$this->errorcode;
        $result_data = [
            'message'=>$this->msg,
            'data'=>[],
            'errorcode'=>$this->errorcode
        ];
        return json($result_data,$this->httpcode);
    }

}
