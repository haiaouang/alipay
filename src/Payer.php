<?php namespace Hht\AliPay;

use Hht\Support\Contracts\Order;
use Hht\AliPay\Config\ConfigAwareTrait;
use Hht\AliPay\Plugin\PluggableTrait;

class Payer implements PayerInterface
{
    use PluggableTrait;
    use ConfigAwareTrait;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @param Config|array     $config
     */
    public function __construct(AdapterInterface $adapter, $config = null)
    {
        $this->adapter = $adapter;
        $this->setConfig($config);
    }

    /**
     * Get the Adapter.
     *
     * @return AdapterInterface adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
	
	/**
     * Make pay order sign.
     *
	 * @param Hht\AliPay\Order $order
     * @return string
     */
	public function makeSign(Order $order) {
		return $this->adapter->makeSign($order);
	}
	
	/**
     * Make mobile pay order.
     *
	 * @param Hht\AliPay\Order $order
     * @return Hht\AliPay\SDKOrder
     */
	public function createSDKOrder(Order $order) {
		return $this->adapter->createSDKOrder($order);
	}
	
	/**
     * Verify pay order callback.
     *
	 * @param array $param
     * @return boolean
     */
	public function verifySign($param) {
		return $this->adapter->verifySign($param);
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
        $back = call_user_func_array([$this->adapter, $method], $parameters);

		if ($back instanceof AdapterInterface)
			return $this;
		else
			return $back;
    }
}
