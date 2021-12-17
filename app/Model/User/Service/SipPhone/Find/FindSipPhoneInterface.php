<?php

namespace App\Model\User\Service\SipPhone\Find;

use App\Model\User\Entity\UserSip;

interface FindSipPhoneInterface
{
    public function find($phone): ?UserSip;
}
