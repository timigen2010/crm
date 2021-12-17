<?php

namespace App\Model\Language\Service\Get\GetLanguages;

class Data
{
    public string $orderBy;

    public string $orderDirection;

    public function __construct(?string $orderBy,
                                ?string $orderDirection)
    {
        $this->orderBy = $orderBy ?? "name";
        $this->orderDirection = $orderDirection ?? "asc";
    }
}
