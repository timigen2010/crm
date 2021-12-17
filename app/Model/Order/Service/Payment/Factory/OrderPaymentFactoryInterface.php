<?php

namespace App\Model\Order\Service\Payment\Factory;

use App\Model\Order\Entity\OrderPayment;

interface OrderPaymentFactoryInterface
{
    public function create(Data $data): OrderPayment;
}
