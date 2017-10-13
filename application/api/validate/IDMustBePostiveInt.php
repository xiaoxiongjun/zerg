<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/11
 * Time: 20:32
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];

}