<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/6
 * Time: 22:15
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}