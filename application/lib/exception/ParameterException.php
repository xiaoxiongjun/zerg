<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/15
 * Time: 12:22
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errroeCode = 10000;

}