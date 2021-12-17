<?php

namespace App\Model\Product\Service\Constructor\Factory;

class Data
{
    public int $mainProductId;
    public int $basisCategoryId;
    public int $sauceCategoryId;
    public array $toppingsIds;
    public array $companies;
    public bool $status;
    public bool $deleted;

    public function __construct(int $mainProductId,
                                int $basisCategoryId,
                                int $sauceCategoryId,
                                bool $status,
                                bool $deleted,
                                array $toppingsIds,
                                array $companies)
    {
        $this->mainProductId = $mainProductId;
        $this->basisCategoryId = $basisCategoryId;
        $this->sauceCategoryId = $sauceCategoryId;
        $this->status = $status;
        $this->deleted = $deleted;
        $this->toppingsIds = $toppingsIds;
        $this->companies = $companies;
    }
}
