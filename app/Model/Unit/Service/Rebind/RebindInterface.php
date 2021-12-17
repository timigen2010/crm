<?php

namespace App\Model\Unit\Serivce\Rebind;

use App\Model\Unit\Entity\UnitClass;

interface RebindInterface
{
    public function rebind(UnitClass $unitClass);
}
