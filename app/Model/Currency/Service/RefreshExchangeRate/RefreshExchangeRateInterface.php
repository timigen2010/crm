<?php

namespace App\Model\Currency\Serivce\RefreshExchangeRate;

use App\Model\Currency\Entity\Currency;

interface RefreshExchangeRateInterface
{
    public function refresh();
}
