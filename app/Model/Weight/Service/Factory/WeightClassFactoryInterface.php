<?php

namespace App\Model\Weight\Service\Factory;

use App\Model\Weight\Entity\WeightClass;

interface WeightClassFactoryInterface
{
    public function create(Data $data, ?WeightClass $unitClass = null): WeightClass;
}
