<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/29
 * Time: 16:46
 * Copy: biuwu.com
 */

namespace app\api\service;

use app\api\model\Product;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderServion;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        if($data['result_code'] == 'SUCCESS'){
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try{
                $order = OrderModel::where('order_no','=',$orderNo)
                    ->find();
                if ($order->status == 1){
                    $service = new OrderServion();
                    $stockStatus = $service->checkOrderStock($order->id);
                    if($stockStatus['pass']){
                        $this->updateOrderStatus($order->id,true);
                        $this->reduceStock($stockStatus);
                    }else{
                        $this->updateOrderStatus($order->id,true);
                    }
                }
                Db::commit();
                return true;
            }catch (Exception $ex){
                Db::rollback();
                Log::error($ex);
                return false;
            }
        }else{
            return true;
        }
    }

    public function reduceStock($stockStatus){
        foreach ($stockStatus['pStatusArray'] as $singlePStatus){
            Product::where('id','=',$singlePStatus)
                ->setDec('stock',$singlePStatus);
        }
    }

    public function updateOrderStatus($orderID,$success){
        $status = $success?OrderStatusEnum::PAID:OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id','=',$orderID)->update(['status' => $status]);
    }
}