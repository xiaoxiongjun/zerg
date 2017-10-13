<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/7/23
 * Time: 12:50
 * Copyright: 66sss.net
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([],'img');
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
}