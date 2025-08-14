<?php

namespace Omnipay\Adyen\Message;

use Adyen\Client;
use Adyen\Environment;
use Adyen\Service\Checkout\PaymentLinksApi;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function sendData($data)
    {
        $client = new Client();
        $client->setXApiKey($this->getApiKey());
        $client->setEnvironment($this->getTestMode() ? Environment::TEST : Environment::LIVE);
        $client->setTimeout(10);

        $service = new PaymentLinksApi($client);
        $paymentDetails = $service->getPaymentLink($this->getTransactionId());

        return new CompletePurchaseResponse($this, $paymentDetails->toArray());
    }
}
