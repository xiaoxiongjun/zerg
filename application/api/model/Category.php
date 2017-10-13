<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/23
 * Time: 12:51
 * Copyright: 66sss.net
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time','update_time','create_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}