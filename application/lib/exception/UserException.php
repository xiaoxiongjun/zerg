<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/20
 * Time: 15:02
 * Copy: biuwu.com
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}