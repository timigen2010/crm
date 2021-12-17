<?php

namespace App\Model\User\Service\HistoryLogin\Factory;

use App\Model\User\Entity\UserHistoryLogin;

interface HistoryLoginFactoryInterface
{
    public function create(Data $data): UserHistoryLogin;
}
