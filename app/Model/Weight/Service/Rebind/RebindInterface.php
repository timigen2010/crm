<?php

namespace App\Model\Weight\Serivce\Rebind;

use App\Model\Weight\Entity\WeightClass;

interface RebindInterface
{
    public function rebind(WeightClass $weight);
}
