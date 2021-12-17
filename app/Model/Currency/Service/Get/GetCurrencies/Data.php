<?php

namespace App\Model\Currency\Service\Get\GetCurrencies;

class Data
{
    public ?int $languageId;

    public string $orderBy;

    public string $orderDirection;

    public function __construct(?int $languageId,
                                ?string $orderBy,
                                ?string $orderDirection)
    {
        $this->languageId = $languageId;
        $this->orderBy = $orderBy ?? "code";
        $this->orderDirection = $orderDirection ?? "asc";
    }
}
