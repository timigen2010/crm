<?php

namespace App\Model\User\Service\EditUser;

use App\Model\User\Entity\User;
use Illuminate\Support\Facades\DB;

abstract class EditUserAbstract
{
    abstract protected function setData(Data $data, User $user): User;

    public function edit(Data $data, User $user): User
    {
        return DB::transaction(function () use($data, $user) {
            return $this->setData($data, $user);
        });
    }
}
