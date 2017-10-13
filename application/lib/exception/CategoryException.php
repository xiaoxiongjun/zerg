<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/23
 * Time: 13:03
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存组，请检查参数';
    public $errorCode = 50000;
}