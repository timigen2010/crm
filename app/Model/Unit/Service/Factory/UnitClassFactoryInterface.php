<?php

namespace App\Model\Unit\Service\Factory;

use App\Model\Unit\Entity\UnitClass;

interface UnitClassFactoryInterface
{
    public function create(Data $data, ?UnitClass $unitClass = null): UnitClass;
}
