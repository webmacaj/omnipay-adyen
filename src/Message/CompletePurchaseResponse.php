<?php

namespace Omnipay\Adyen\Message;

use Adyen\Model\Checkout\PaymentLinkResponse;

class CompletePurchaseResponse extends PurchaseResponse
{
    public function isSuccessful()
    {
        return $this->data['status'] == PaymentLinkResponse::STATUS_PAID;
    }
}
