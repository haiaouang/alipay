<?php namespace Hht\AliPay\Plugin;

use Hht\AliPay\PayerInterface;

interface PluginInterface
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set the Payer object.
     *
     * @param PayerInterface $payer
     */
    public function setPayer(PayerInterface $payer);
}
