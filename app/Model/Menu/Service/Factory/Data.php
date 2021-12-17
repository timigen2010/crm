<?php

namespace App\Model\Menu\Service\Factory;

class Data
{
    public string $name;

    public array $companies;

    public function __construct(string $name, array $companies)
    {
        $this->name = $name;
        $this->companies = $companies;
    }
}
