<?php

namespace App\Model\User\Repository\User;

use App\Model\User\Entity\UserSip;

class UserSipRepository
{
    private UserSip $model;

    public function __construct(UserSip $model)
    {
        $this->model = $model;
    }

    public function findOneByPhone(string $phone)
    {
        return $this->model->query()
            ->where('phone', '=', $phone)
            ->first();
    }
}
