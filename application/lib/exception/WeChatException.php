<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/26
 * Time: 18:05
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}