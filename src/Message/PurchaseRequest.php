<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\AbstractRequest;
use Adyen\Model\Checkout\PaymentLinkRequest;
use Adyen\Client;
use Adyen\Environment;
use Adyen\Service\Checkout\PaymentLinksApi;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\Address;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return [];
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

    public function sendData($data)
    {
        $client = new Client();
        $client->setXApiKey($this->getApiKey());
        $client->setEnvironment($this->getTestMode() ? Environment::TEST : Environment::LIVE, $this->getPrefix());
        $client->setTimeout(10);

        $service = new PaymentLinksApi($client);

        $amount = new Amount();
        $amount->setCurrency($this->getCurrency())
            ->setValue($this->getAmount());

        $billingAddress = new Address();
        $billingAddress->setStreet($this->getCard()->getBillingAddress1())
            ->setCity($this->getCard()->getBillingCity())
            ->setCountry($this->getCard()->getBillingCountry())
            ->setPostalCode($this->getCard()->getBillingPostcode());

        $shippingAddress = new Address();
        $shippingAddress->setStreet($this->getCard()->getShippingAddress1())
            ->setCity($this->getCard()->getShippingCity())
            ->setCountry($this->getCard()->getShippingCountry())
            ->setPostalCode($this->getCard()->getShippingPostcode());

        $paymentLinkRequest = new PaymentLinkRequest();
        $paymentLinkRequest->setMerchantAccount($this->getMerchantAccount())
            ->setReference($this->getTransactionReference())
            ->setAmount($amount)
            ->setCountryCode($this->getCountryCode())
            ->setShopperReference(\md5($this->getCard()->getEmail()))
            ->setShopperEmail($this->getCard()->getEmail())
            ->setShopperLocale($this->getLocale())
            ->setBillingAddress($billingAddress)
            ->setDeliveryAddress($shippingAddress)
            ->setReturnUrl($this->getReturnUrl());

        $result = $service->paymentLinks($paymentLinkRequest);

        return new PurchaseResponse($this, $result->toArray());
    }
}
