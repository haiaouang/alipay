<?php namespace Hht\AliPay\Core;

class Config 
{
	/**
	 * @var partner.
	 */
	public $partner;

	/**
	 * @var seller_id.
	 */
	public $seller_id;

	/**
	 * @var private_key.
	 */
	public $private_key;
	
	/**
	 * @var alipay_public_key.
	 */
	public $alipay_public_key;
	
	/**
	 * @var sign_type.
	 */
	public $sign_type;
	
	/**
	 * @var input_charset.
	 */
	public $input_charset;
	
	/**
	 * @var payment_type.
	 */
	public $payment_type;

	/**
	 * @var service.
	 */
	public $service;

	/**
	 * @var sdk_service.
	 */
	public $sdk_service;

	/**
	 * @var payment_time.
	 */
	public $payment_time;

	public function __construct($config)
	{
		if (isset($config['partner']))
			$this->partner = $config['partner'];

		if (isset($config['seller_id']))
			$this->seller_id = $config['seller_id'];

		if (isset($config['private_key']))
			$this->private_key = $config['private_key'];

		if (isset($config['alipay_public_key']))
			$this->alipay_public_key = $config['alipay_public_key'];

		if (isset($config['sign_type']))
			$this->sign_type = $config['sign_type'];

		if (isset($config['input_charset']))
			$this->input_charset = $config['input_charset'];

		if (isset($config['payment_type']))
			$this->payment_type = $config['payment_type'];

		if (isset($config['service']))
			$this->service = $config['service'];

		if (isset($config['sdk_service']))
			$this->sdk_service = $config['sdk_service'];

		if (isset($config['payment_time']))
			$this->payment_time = $config['payment_time'];
	}
}

?>
