<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/20
 * Time: 11:53
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}