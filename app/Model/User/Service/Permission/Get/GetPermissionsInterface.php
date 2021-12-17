<?php

namespace App\Model\User\Service\Permission\Get;

interface GetPermissionsInterface
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function getPermissions($data);
}
