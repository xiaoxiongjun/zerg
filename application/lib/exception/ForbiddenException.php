<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/20
 * Time: 19:33
 * Copy: biuwu.com
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}