<?php

namespace App\Model\User\Service\UserGroup\Factory;

use App\Model\User\Entity\UserGroup;
use Illuminate\Support\Facades\DB;

abstract class UserGroupFactoryAbstract
{
    abstract protected function setData(Data $data, UserGroup $userGroup): UserGroup;

    public function create(Data $data, ?UserGroup $userGroup = null): UserGroup
    {
        return DB::transaction(function () use($data, $userGroup) {
            $userGroup = $userGroup ?? UserGroup::query()->make();
            return $this->setData($data, $userGroup);
        });
    }
}
