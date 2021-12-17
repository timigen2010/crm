<?php

namespace App\Model\User\Service\GetUsers\GetUsersByParams;

class Data
{
    public ?string $username;

    public ?int $userGroupId;

    public ?bool $status;

    public string $orderBy;

    public string $orderDirection;

    public function __construct(?string $orderBy = null,
                                ?string $orderDirection = null,
                                ?string $username = null,
                                ?int $userGroupId = null,
                                ?bool $status = null)
    {
        $this->username = $username;
        $this->userGroupId = $userGroupId;
        $this->status = $status;
        $this->orderBy = $orderBy ?? "username";
        $this->orderDirection = $orderDirection ?? "ASC";
    }


}
