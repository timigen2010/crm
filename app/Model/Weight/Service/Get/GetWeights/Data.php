<?php

namespace App\Model\Weight\Service\Get\GetWeights;

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
        $this->orderBy = $orderBy ?? "value";
        $this->orderDirection = $orderDirection ?? "asc";
    }
}
