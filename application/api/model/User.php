<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/26
 * Time: 12:49
 * Copyright: 66sss.net
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address(){
        return $this->hasOne('UserAddress','user_id','id');
    }

    public static function getByOpenID($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }
}