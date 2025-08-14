<?php

namespace Omnipay\Adyen;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Adyen';
    }

    public function getDefaultParameters()
    {
        return [
            'testMode' => false
        ];
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setPrefix($value)
    {
        return $this->setParameter('prefix', $value);
    }

    public function getPrefix()
    {
        return $this->getParameter('prefix');
    }

    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
    }

    public function getMerchantAccount()
    {
        return $this->getParameter('merchantAccount');
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * Create a purchase request
     *
     * @param array $parameters
     * @return \Omnipay\Adyen\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Adyen\Message\PurchaseRequest', $parameters);
    }

    /**
     * Create a complete purchase request
     *
     * @param array $parameters
     * @return \Omnipay\Adyen\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Adyen\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * Create a check status request
     *
     * @param array $parameters
     * @return \Omnipay\Adyen\Message\CompletePurchaseRequest
     */
    public function checkStatus(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Adyen\Message\CheckStatusRequest', $parameters);
    }
}
