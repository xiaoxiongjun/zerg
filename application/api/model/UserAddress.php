<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/20
 * Time: 16:07
 * Copy: biuwu.com
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id','delete_time','user_id'];
}