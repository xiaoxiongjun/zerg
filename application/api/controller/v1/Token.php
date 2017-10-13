<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/26
 * Time: 12:38
 * Copyright: 66sss.net
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = ''){
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token
        ];
    }
}