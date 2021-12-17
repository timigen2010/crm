<?php

namespace App\Model\User\Service\Permission\Factory;

class Data
{
    public string $name;

    public array $descriptions;

    public function __construct(string $name, ?array $descriptions)
    {
        $this->name = $name;
        $this->descriptions = $descriptions ?? [];
    }
}
