<?php

namespace App\Model\Company\Service\Phoneline\Factory;

class Data
{
    public int $companyId;
    public string $keyword;

    public array $descriptions;

    public function __construct(int $companyId, string $keyword, ?array $descriptions)
    {
        $this->companyId = $companyId;
        $this->keyword = $keyword;
        $this->descriptions = $descriptions ?? [];
    }
}
