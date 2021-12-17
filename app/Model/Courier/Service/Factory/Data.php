<?php

namespace App\Model\Courier\Service\Factory;

class Data
{
    public string $name;
    public string $telephone;
    public float $percent;
    public bool $deleted;

    public array $companies;

    public function __construct(string $name, string $telephone, float $percent, bool $deleted, array $companies)
    {
        $this->name = $name;
        $this->telephone = $telephone;
        $this->percent = $percent;
        $this->deleted = $deleted;
        $this->companies = $companies;
    }
}
