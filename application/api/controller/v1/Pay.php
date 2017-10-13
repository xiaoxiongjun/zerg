<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/28
 * Time: 16:15
 * Copy: biuwu.com
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];
    public function getPreOrder($id = ''){
        (new IDMustBePostiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    public function receiveNotify(){
        $notify = new WxNotify();
        $notify->Handle();
    }
}