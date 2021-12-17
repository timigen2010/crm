<?php

namespace App\Model\Customer\Service\Get\GetCustomersByParams;

class Data
{
    public ?string $name;

    public ?int $groupId;

    public ?bool $status;

    public ?string $telephone;

    public ?string $orderBy;

    public ?string $orderDirection;

    public function __construct(?string $name,
                                ?int $groupId,
                                ?bool $status,
                                ?string $telephone,
                                ?string $orderBy,
                                ?string $orderDirection)
    {
        $this->name = $name;
        $this->groupId = $groupId;
        $this->status = $status;
        $this->telephone = $telephone;
        $this->orderBy = $orderBy ?? "customer_id";
        $this->orderDirection = $orderDirection ?? "DESC";
    }


}
