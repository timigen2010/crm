<?php

namespace App\Model\Customer\Service\Group\Factory;

class Data
{
    public int $companyId;

    public array $descriptions;

    public function __construct(int $companyId, ?array $descriptions)
    {
        $this->companyId = $companyId;
        $this->descriptions = $descriptions ?? [];
    }
}
