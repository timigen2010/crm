<?php

namespace App\Model\User\Service\UserGroup\Factory;

class Data
{
    public string $name;

    public array $permissions;

    public function __construct(string $name, ?array $permissions)
    {
        $this->name = $name;
        $this->permissions = $permissions ?? [];
    }
}
