<?php namespace Hht\AliPay\Order;

use Hht\Support\Contracts\Order as OrderContract;

class Order implements OrderContract
{
	public $out_trade_no;

	public $subject;

	public $body;

	public $total_fee;

	public $notify_url;

	public $payment_type = 1;

	public $clientVersion;

	public $goods_type = 0;

	public $show_url = 'm.alipay.com';

	public $clientType = 0;

	private $service;

	private $partner;

	private $_input_charset;

	private $seller_id;

	private $it_b_pay;

	private $sign_type;
	
	public function setService($service) {
		$this->service = $service;
	}

	public function getService() {
		return $this->service;
	}

	public function setPartner($partner) {
		$this->partner = $partner;
	}

	public function getPartner() {
		return $this->partner;
	}

	public function setInputCharset($input_charset) {
		$this->_input_charset = $input_charset;
	}

	public function getInputCharset() {
		return $this->_input_charset;
	}

	public function setSellerId($seller_id) {
		$this->seller_id = $seller_id;
	}

	public function getSellerId() {
		return $this->seller_id;
	}

	public function setPaymentTime($it_b_pay) {
		$this->it_b_pay = $it_b_pay;
	}

	public function getPaymentTime() {
		return $this->it_b_pay;
	}

	public function setSignType($sign_type) {
		$this->sign_type = $sign_type;
	}

	public function getSignType() {
		return $this->sign_type;
	}

	public function toString() {
		$str = '';

		if ($this->clientType == 0)
			$str = $this->toAndroidString();
		else if ($this->clientType == 1)
			$str = $this->toIOSString();

		return $str; 
	}

	public function toAndroidString() {
		$str = '';

		$str .= 'service="' . $this->service . '"&';
		$str .= 'partner="' . $this->partner . '"&';
		$str .= '_input_charset="' . strtolower($this->_input_charset) . '"&';
		$str .= 'notify_url="' . $this->notify_url . '"&';
		$str .= 'appenv="system=android^version=' . $this->clientVersion . '"&';
		$str .= 'out_trade_no="' . $this->out_trade_no . '"&';
		$str .= 'subject="' . $this->subject . '"&';
		$str .= 'payment_type="' . $this->payment_type . '"&';
		$str .= 'seller_id="' . $this->seller_id . '"&';
		$str .= 'total_fee="' . $this->total_fee . '"&';
		$str .= 'body="' . $this->body . '"&';
		$str .= 'it_b_pay="' . $this->it_b_pay . '"&';
		$str .= 'goods_type="' . $this->goods_type . '"';

		return $str;
	}

	public function toIOSString() {
		$str = '';

		$str .= 'partner="' . $this->partner . '"&';
		$str .= 'seller_id="' . $this->seller_id . '"&';
		$str .= 'out_trade_no="' . $this->out_trade_no . '"&';
		$str .= 'subject="' . $this->subject . '"&';
		$str .= 'body="' . $this->body . '"&';
		$str .= 'total_fee="' . $this->total_fee . '"&';
		$str .= 'notify_url="' . $this->notify_url . '"&';
		$str .= 'service="' . $this->service . '"&';
		$str .= 'payment_type="' . $this->payment_type . '"&';
		$str .= '_input_charset="' . strtolower($this->_input_charset) . '"&';
		$str .= 'it_b_pay="' . $this->it_b_pay . '"&';
		$str .= 'show_url="' . $this->show_url . '"&';
		//sign_date
		$str .= 'appID="' . $this->clientVersion . '"';

		return $str;
	}
}
