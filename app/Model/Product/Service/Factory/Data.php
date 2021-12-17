<?php

namespace App\Model\Product\Service\Factory;

class Data
{
    public int $productTypeId;
    public int $currencyId;
    public int $unitClassId;
    public int $weightClassId;
    public int $mainCategoryId;
    public string $name;
    public float $costPrice;
    public float $price;
    public float $weight;
    public float $minimum;
    public bool $status;
    public bool $saleAble;
    public int $cookingTime;
    public string $dateAvailable;
    public array $descriptions;
    public array $menus;
    public array $categories;

    public function __construct(int $productTypeId,
                                int $currencyId,
                                int $unitClassId,
                                int $weightClassId,
                                int $mainCategoryId,
                                string $name,
                                float $costPrice,
                                float $price,
                                float $weight,
                                float $minimum,
                                bool $status,
                                bool $saleAble,
                                int $cookingTime,
                                string $dateAvailable,
                                ?array $descriptions,
                                ?array $menus,
                                ?array $categories)
    {
        $this->productTypeId = $productTypeId;
        $this->currencyId = $currencyId;
        $this->unitClassId = $unitClassId;
        $this->weightClassId = $weightClassId;
        $this->mainCategoryId = $mainCategoryId;
        $this->name = $name;
        $this->costPrice = $costPrice;
        $this->price = $price;
        $this->weight = $weight;
        $this->minimum = $minimum;
        $this->status = $status;
        $this->saleAble = $saleAble;
        $this->cookingTime = $cookingTime;
        $this->dateAvailable = $dateAvailable;
        $this->descriptions = $descriptions ?? [];
        $this->menus = $menus ?? [];
        $this->categories = $categories ?? [];
    }
}
