<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/8
 * Time: 14:17
 * Copyright: 66sss.net
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id','delete_time','id'];
}