<?php

namespace App\Model\Customer\Service\Telephone\Find;

use App\Model\Customer\Entity\CustomerTelephone;

interface FindTelephoneInterface
{
    public function find($data): ?CustomerTelephone;
}
