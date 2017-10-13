<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/8
 * Time: 14:14
 * Copyright: 66sss.net
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id','delete_time','product_id'];

    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}