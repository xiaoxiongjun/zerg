<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/20
 * Time: 19:52
 * Copy: biuwu.com
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\service\Order as OrderService;
use app\api\validate\PagingParameter;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\model\Order as OrderModel;
use app\api\service\Token as TokenService;

class Order extends BaseController
{
    // 用户在选择商品后，向api提交包含他所选商品的相关信息
    // api在接收到信息后，需要检查订单相关商品的库存量
    // 有库存，把订单数据存入数据库中 = 下单成功了，返回客户端消息，告诉客户端可以支付了
    // 调用我们的支付接口，进行支付
    // 还需要我们进行库存量检测
    // 服务器这边就可以调用微信的支付接口进行支付
    // 微信会返回给我们一个支付的结果
    // 成功也需要进行库存量的检查
    // 支付成功进行库存量的扣除，支付失败返回一个支付失败的结果
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser']
    ];

    public function getSummaryByUser($page=1,$size=15){
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid,$page,$size);
        if($pagingOrders->isEmpty()){
            return [
                'data' => [],
                'current_page' => $pagingOrders->getCurrentPage()
            ];
        }
        $data = $pagingOrders->hidden(['snap_items','snap_address','prepay_id'])->toArray();
        return [
            'data' => $data,
            'current_page' => $pagingOrders->getCurrentPage()
        ];
    }

    public function getDetail($id){
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if(!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }

    public function placeOrder(){
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid,$products);
        return $status;
    }
}