<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/19
 * Time: 22:07
 * Copyright: 66sss.net
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected  $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分割的多个正整数'
    ];

    protected function checkIDs($value){
        $values = explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}