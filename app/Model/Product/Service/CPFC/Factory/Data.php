<?php

namespace App\Model\Product\Service\CPFC\Factory;

class Data
{
    public int $productId;
    public float $calories;
    public float $protein;
    public float $fat;
    public float $carbs;

    public function __construct(int $productId, float $calories, float $protein, float $fat, float $carbs)
    {
        $this->productId = $productId;
        $this->calories = $calories;
        $this->protein = $protein;
        $this->fat = $fat;
        $this->carbs = $carbs;
    }
}
