<?php

namespace Omnipay\Adyen;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Adyen';
    }
}
