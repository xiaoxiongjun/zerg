<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/22
 * Time: 21:07
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在，请检查参数';
    public $errorCode = 20000;
}