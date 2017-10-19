<?php namespace Hht\AliPay\Order;

use Hht\Support\Contracts\Result as ResultContract;

class SDKOrder implements ResultContract
{
	private $order;

	private $sign;

	public function setOrder($order) {
		$this->order = $order;
	}

	public function getOrder() {
		return $this->order;
	}

	public function setSign($sign) {
		$this->sign = $sign;
	}

	public function getSign() {
		return $this->sign;
	}

	public function toString() {
		$str  = $this->order->toString();
		$str .= '&sign="' . urlencode($this->sign) . '"&';
		$str .= 'sign_type="' . $this->order->getSignType() . '"';

		return $str;
	}
}
