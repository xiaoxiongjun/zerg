<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/29
 * Time: 19:16
 * Copy: biuwu.com
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}