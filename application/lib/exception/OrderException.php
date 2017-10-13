<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/25
 * Time: 13:57
 * Copy: biuwu.com
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查商品ID';
    public $errorCode =80000;
}