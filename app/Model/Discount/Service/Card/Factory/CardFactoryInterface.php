<?php

namespace App\Model\Discount\Service\Card\Factory;

use App\Model\Discount\Entity\DiscountCard;

interface CardFactoryInterface
{
    public function create(Data $data): DiscountCard;
}
