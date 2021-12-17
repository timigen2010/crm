<?php

namespace App\Model\User\Service\Permission\Get\GetPermission;

class Data
{
    public string $name;

    public int $userGroupId;


    public function __construct(string $name, int $userGroupId)
    {
        $this->name = $name;
        $this->userGroupId = $userGroupId;
    }


}
