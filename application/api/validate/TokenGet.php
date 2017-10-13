<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/26
 * Time: 12:39
 * Copyright: 66sss.net
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];
    protected $message = [
        'code' => 'code为空'
    ];
}