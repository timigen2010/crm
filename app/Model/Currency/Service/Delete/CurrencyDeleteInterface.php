<?php

namespace App\Model\Currency\Serivce\Delete;

use App\Model\Currency\Entity\Currency;

interface CurrencyDeleteInterface
{
    public function delete(Currency $currency);
}
