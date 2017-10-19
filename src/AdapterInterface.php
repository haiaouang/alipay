<?php namespace Hht\AliPay;

use Hht\AliPay\Order\Order;

interface AdapterInterface
{
    public function makeSign(Order $order);

	public function createSDKOrder(Order $order);

	public function verifySign($param);
}
