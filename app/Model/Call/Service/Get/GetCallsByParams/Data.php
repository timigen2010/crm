<?php

namespace App\Model\Call\Service\Get\GetCallsByParams;

class Data
{
    public ?string $source;

    public ?string $destination;

    public ?int $companyId;

    public ?int $statusDisposition;

    public ?string $dateStart;

    public ?string $dateEnd;

    public string $orderBy;

    public string $orderDirection;

    public function __construct(?int $source,
                                ?string $destination,
                                ?int $companyId,
                                ?int $statusDisposition,
                                ?string $dateStart,
                                ?string $dateEnd,
                                ?string $orderBy,
                                ?string $orderDirection)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->companyId = $companyId;
        $this->statusDisposition = $statusDisposition;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->orderBy = $orderBy ?? "call_activity_id";
        $this->orderDirection = $orderDirection ?? "desc";
    }


}
