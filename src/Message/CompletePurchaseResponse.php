<?php

namespace Omnipay\Adyen\Message;


class CompletePurchaseResponse extends PurchaseResponse
{
    public function isSuccessful()
    {
        return $this->data['status'] == 'completed';
    }
}
