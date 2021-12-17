<?php

namespace App\Model\Category\Service\Get\GetCategoriesByParams;

class Data
{
    public ?bool $status;

    public ?string $name;

    public ?int $languageId;

    public string $orderBy;

    public string $orderDirection;

    public function __construct(?bool $status,
                                ?string $name,
                                ?int $languageId,
                                ?string $orderBy,
                                ?string $orderDirection)
    {
        $this->status = $status;
        $this->name = $name;
        $this->languageId = $languageId;
        $this->orderBy = $orderBy ?? "category_id";
        $this->orderDirection = $orderDirection ?? "desc";
    }


}
