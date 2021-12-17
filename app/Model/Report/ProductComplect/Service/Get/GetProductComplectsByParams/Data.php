<?php

namespace App\Model\Report\ProductComplect\Service\Get\GetProductComplectsByParams;

class Data
{
    public ?string $name;
    public ?bool $saleAble;

    public function __construct(?string $name,
                                ?bool $saleAble)
    {
        $this->name = $name;
        $this->saleAble = $saleAble ?? 1;
    }


}
