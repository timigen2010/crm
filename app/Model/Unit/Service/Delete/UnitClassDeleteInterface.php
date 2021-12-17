<?php

namespace App\Model\Unit\Service\Delete;

use App\Model\Unit\Entity\UnitClass;

interface UnitClassDeleteInterface
{
    public function delete(UnitClass $unitClass);
}
