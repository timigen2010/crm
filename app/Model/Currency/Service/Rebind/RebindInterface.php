<?php

namespace App\Model\Currency\Serivce\Rebind;

use App\Model\Currency\Entity\Currency;

interface RebindInterface
{
    public function rebind(Currency $currency);
}
