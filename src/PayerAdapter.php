<?php namespace Hht\AliPay;

use Hht\AliPay\Core\Config;
use Hht\AliPay\Order\Order;
use Hht\AliPay\Order\SDKOrder;
use Hht\AliPay\Core\AlipayCore;
use Hht\AliPay\Core\AlipayRsa;

class PayerAdapter implements AdapterInterface
{
	public function __construct($config) {
		$this->config = new Config($config);
	}
	
	/**
	 * Make pay order sign.
	 *
	 * @param   \Hht\AliPay\Order\Order    $order
	 * @return  string
	 */
	public function makeSign(Order $order) {
		if (empty($order->getService()))
		{
			if ($order->clientType == 0 || $order->clientType == 1)
				$order->setService($this->config->sdk_service);
			else
				$order->setService($this->config->service);
		}
		
		if (empty($order->getPartner()))
			$order->setPartner($this->config->partner);
		
		if (empty($order->getInputCharset()))
			$order->setInputCharset($this->config->input_charset);

		if (empty($order->getSellerId()))
			$order->setSellerId($this->config->seller_id);

		if (empty($order->getPaymentTime()))
			$order->setPaymentTime($this->config->payment_time);

		if (empty($order->getSignType()))
			$order->setSignType($this->config->sign_type);

		if ($order->getSignType() == 'RSA')
			return AlipayRsa::makeSign($order->toString(), $this->config->private_key);
		else
			return '';
	}
	
	/**
	 * Create mobile pay order.
	 *
	 * @param   \Hht\AliPay\Order\Order    $order
	 * @return  \Hht\AliPay\Order\SDKOrder
	 */
	public function createSDKOrder(Order $order) {
		if (empty($order->getService()))
		{
			if ($order->clientType == 0 || $order->clientType == 1)
				$order->setService($this->config->sdk_service);
			else
				$order->setService($this->config->service);
		}
		
		if (empty($order->getPartner()))
			$order->setPartner($this->config->partner);
		
		if (empty($order->getInputCharset()))
			$order->setInputCharset($this->config->input_charset);

		if (empty($order->getSellerId()))
			$order->setSellerId($this->config->seller_id);

		if (empty($order->getPaymentTime()))
			$order->setPaymentTime($this->config->payment_time);

		if (empty($order->getSignType()))
			$order->setSignType($this->config->sign_type);

		$sign = $this->makeSign($order);
		
		$sdkorder = new SDKOrder();
		$sdkorder->setOrder($order);
		$sdkorder->setSign($sign);

		return $sdkorder;
	}	
	
	/**
	 * Verify pay order callback.
	 *
	 * @param   \Hht\AliPay\Order\Order    $order
	 * @return  \Hht\AliPay\Order\SDKOrder
	 */
	public function verifySign($param) {
		if ($this->config->sign_type == 'RSA')
		{
			$str = AlipayCore::createLinkstring(AlipayCore::argSort(AlipayCore::paramFilter($param)));

			return (AlipayRsa::verifySign($str, $this->config->alipay_public_key, isset($param['sign']) ? $param['sign'] : ''));
		}
		else
		{
			return false;
		}
	}
	
	/**
     * Pass dynamic methods call onto PayerAdapter.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
	public function __call($method, array $parameters)
	{
		return $this;
	}
}
