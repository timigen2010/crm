<?php

namespace App\Model\Order\Service\Get\GetByParams;

class Data
{
    public ?int $orderId;
    public ?int $orderStatusId;
    public ?int $userGroupId;
    public ?string $updatedAt;
    public ?string $createdAt;
    public ?int $customerId;
    public ?float $total;
    public ?int $companyId;
    public string $orderBy;
    public string $orderDirection;
    public int $page;
    public int $limit;

    public function __construct(?int $orderId,
                                ?int $orderStatusId,
                                ?int $userGroupId,
                                ?string $updatedAt,
                                ?string $createdAt,
                                ?int $customerId,
                                ?float $total,
                                ?int $companyId,
                                ?string $orderBy,
                                ?string $orderDirection,
                                ?int $page,
                                ?int $limit)
    {
        $this->orderId = $orderId;
        $this->orderStatusId = $orderStatusId;
        $this->userGroupId = $userGroupId;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
        $this->customerId = $customerId;
        $this->total = $total;
        $this->companyId = $companyId;
        $this->orderBy = $orderBy ?? "order_id";
        $this->orderDirection = $orderDirection ?? "desc";
        $this->page = $page ?? 1;
        $this->limit = $limit ?? 10;
    }
}
