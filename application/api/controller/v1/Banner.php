<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/11
 * Time: 12:49
 */

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;

class Banner
{
    /*
     * @url /banner/:id
     * @http GET
     * @id banner的ID号
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();

        $banner = BannerModel::getBannerByID($id);
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;
    }

}