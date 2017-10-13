<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/22
 * Time: 20:48
 * Copyright: 66sss.net
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,20'
    ];
}