<?php

namespace App\Model\Call\Service\CheckCall;

class Data
{
    public ?int $customerId;
    public ?int $companyId;
    public ?string $telephone;
    public ?int $callId;
    public ?bool $isIn;

    public function __construct(?int $customerId = null,
                                ?int $companyId = null,
                                ?string $telephone = null,
                                ?int $callId = null,
                                ?bool $isIn = null)
    {
        $this->customerId = $customerId;
        $this->companyId = $companyId;
        $this->telephone = $telephone;
        $this->callId = $callId;
        $this->isIn = $isIn;
    }


}
