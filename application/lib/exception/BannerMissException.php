<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/14
 * Time: 11:01
 * Copyright: 66sss.net
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banner不存在';
    public $errorCode = 40000;



}