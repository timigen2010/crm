<?php

namespace App\Model\Discount\Service\CardTransaction\Factory;

use App\Model\Discount\Entity\DiscountCardTransaction;

interface CardTransactionFactoryInterface
{
    public function create(Data $data): DiscountCardTransaction;
}
