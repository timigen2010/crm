<?php

namespace App\Model\User\Service\Permission\Factory;

use App\Model\User\Entity\Permission\UserPermission;
use Illuminate\Support\Facades\DB;

abstract class PermissionFactoryAbstract
{
    abstract protected function setData(Data $data, UserPermission $permission): UserPermission;

    public function create(Data $data, ?UserPermission $permission = null): UserPermission
    {
        return DB::transaction(function () use($data, $permission) {
            $permission = $permission ?? UserPermission::query()->make();
            return $this->setData($data, $permission);
        });
    }
}
