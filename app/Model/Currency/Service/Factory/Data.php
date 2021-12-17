<?php

namespace App\Model\Currency\Service\Factory;

class Data
{
    public ?int $mainCurrencyId;

    public string $code;

    public int $decimalPlace;

    public float $value;

    public bool $status;

    public array $descriptions;

    public function __construct(?int $mainCurrencyId,
                                string $code,
                                int $decimalPlace,
                                float $value,
                                bool $status,
                                array $descriptions)
    {
        $this->mainCurrencyId = $mainCurrencyId;
        $this->code = $code;
        $this->decimalPlace = $decimalPlace;
        $this->value = $value;
        $this->status = $status;
        $this->descriptions = $descriptions;
    }


}
