<?php

namespace App\Model\Product\Service\Get\GetProductsByParams;

class Data
{
    public ?string $name;
    public ?float $price;
    public ?bool $status;
    public ?bool $saleAble;
    public ?int $productTypeId;
    public string $orderBy;
    public string $orderDirection;

    public function __construct(?string $name,
                                ?float $price,
                                ?bool $status,
                                ?bool $saleAble,
                                ?int $productTypeId,
                                ?string $orderBy,
                                ?string $orderDirection)
    {
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->saleAble = $saleAble;
        $this->productTypeId = $productTypeId;
        $this->orderBy = $orderBy ?? "name";
        $this->orderDirection = $orderDirection ?? "asc";
    }


}
