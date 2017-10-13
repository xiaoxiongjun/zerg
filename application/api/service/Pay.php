<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/28
 * Time: 16:32
 * Copy: biuwu.com
 */

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class Pay
{
    private $orderID;
    private $orderNO;

    function __construct($orderID){
        if (!$orderID){
            throw new Exception('订单号不允许为空');
        }
        return $this->orderID = $orderID;
    }

    public function pay(){
        $this->checkOrderValid();
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if(!$status['pass']){
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
    }

    private function makeWxPreOrder($totalPrice){
        $openid = Token::getCurrentTokenVar('openid');
        if(!$openid){
            throw new TokenException();
        }
        $wxOrderDate = new \WxPayUnifiedOrder();
        $wxOrderDate->SetOut_trade_no($this->orderNO);
        $wxOrderDate->SetTrade_type('JSAPI');
        $wxOrderDate->SetTotal_fee($totalPrice*100);
        $wxOrderDate->SetBody('小熊小熊');
        $wxOrderDate->SetOpenid($openid);
        $wxOrderDate->SetNotify_url(config('secure.pay_back_url'));
        return $this->getPaySignature($wxOrderDate);
    }

    private function getPaySignature($wxOrderDate){
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderDate);
        if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取支付订单失败');
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    public function sign($wxOrder){
        $jsApiPayDate = new\WxPayJsApiPay();
        $jsApiPayDate->SetAppid(config('wx.app_id'));
        $jsApiPayDate->SetTimeStamp((string)time());

        $rand = md5(time().mt_rand(0,1000));
        $jsApiPayDate->SetNonceStr($rand);

        $jsApiPayDate->SetPackage('prepay_id='.$wxOrder['prepay_id']);
        $jsApiPayDate->SetSignType('md5');
        $sign = $jsApiPayDate->MakeSign();
        $rawValues = $jsApiPayDate->GetValues();
        $rawValues['paySign'] = $sign;

        unset($rawValues['appId']);
        return $rawValues;

    }

    public function recordPreOrder($wxOrder){
        OrderModel::where('id','=',$this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    private function checkOrderValid(){
        $order = OrderModel::where('id','=',$this->orderID)->find();
        if(!$order){
            throw new OrderException();
        }
        if(!Token::isValidOperate($order->user_id)){
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        if($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg' => '订单已支付过了',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }
}