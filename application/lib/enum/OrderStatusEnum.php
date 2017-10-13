<?php
/**
 * Created by PhpStorm.
 * User: 小熊
 * Date: 2017/9/28
 * Time: 19:30
 * Copy: biuwu.com
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    // 待支付
    const UNPAID = 1;

    // 已支付
    const PAID = 2;

    //已发货
    const DELIVERED = 3;

    // 已支付，但库存不足
    const PAID_BUT_OUT_OF = 4;
}