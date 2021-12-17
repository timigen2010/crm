<?php

namespace App\Model\Order\Service\OrderOption\Factory;

use App\Model\Order\Entity\OrderOption;

interface OrderOptionFactoryInterface
{
    public function create(Data $data): OrderOption;
}
