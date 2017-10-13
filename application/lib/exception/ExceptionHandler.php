<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/14
 * Time: 10:57
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(\Exception $e){
        if($e instanceof BaseException){
            //如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if(config('app_debug')){
                return parent::render($e);
            }else{
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorlog($e);
            }
        }
        $request = Request::instance();
        $result = [
            'error_code' =>$this->errorCode,
            'msg' => $this->msg,
            'request_url' => $request->url()
        ];
        return json($result,$this->code);
    }

    private function recordErrorlog(\Exception $e){
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }

}