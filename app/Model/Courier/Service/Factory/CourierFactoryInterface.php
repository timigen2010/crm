<?php

namespace App\Model\Courier\Service\Factory;

use App\Model\Courier\Entity\Courier;

interface CourierFactoryInterface
{
    public function create(Data $data, ?Courier $courier = null): Courier;
}
