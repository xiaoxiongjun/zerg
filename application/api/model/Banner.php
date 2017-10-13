<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/13
 * Time: 19:33
 * Copyright: 66sss.net
 */

namespace app\api\model;


class Banner extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerByID($id){
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }

}