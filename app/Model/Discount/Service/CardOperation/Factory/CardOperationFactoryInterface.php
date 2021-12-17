<?php

namespace App\Model\Discount\Service\CardOperation\Factory;

use App\Model\Discount\Entity\DiscountCardOperation;

interface CardOperationFactoryInterface
{
    public function create(Data $data): DiscountCardOperation;
}
