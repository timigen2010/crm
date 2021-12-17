<?php

namespace App\Model\Currency\Service\Get;

interface GetCurrencyInterface
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function getCurrencies($data);
}
