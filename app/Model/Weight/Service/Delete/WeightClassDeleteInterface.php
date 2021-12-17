<?php

namespace App\Model\Weight\Service\Delete;

use App\Model\Weight\Entity\WeightClass;

interface WeightClassDeleteInterface
{
    public function delete(WeightClass $weightClass);
}
