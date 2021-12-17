<?php

namespace App\Model\Currency\Service\Factory;

use App\Model\Currency\Entity\Currency;

interface CurrencyFactoryInterface
{
    public function create(Data $data, ?Currency $currency = null): Currency;
}
