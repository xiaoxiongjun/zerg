<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/21
 * Time: 20:29
 * Copy: biuwu.com
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{
    protected  function checkPrimaryScope(){
        TokenService::needPrimaryScope();
    }

    protected  function checkExclusiveScope(){
        TokenService::needExclusiveScope();
    }
}