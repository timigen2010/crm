<?php

namespace App\Model\Unit\Service\Factory;

class Data
{
    public ?int $mainClassId;

    public float $value;

    public array $descriptions;

    public function __construct(?int $mainClassId, float $value, array $descriptions)
    {
        $this->mainClassId = $mainClassId;
        $this->value = $value;
        $this->descriptions = $descriptions;
    }
}
