<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/11
 * Time: 17:09
 * Copyright: 66sss.net
 */

namespace app\api\validate;

class AddressNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty'
    ];
}