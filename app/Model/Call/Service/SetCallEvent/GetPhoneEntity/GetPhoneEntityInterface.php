<?php

namespace App\Model\Call\Service\SetCallEvent\GetPhoneEntity;

use App\Model\Call\Service\SetCallEvent\SetEvent\Data;

interface GetPhoneEntityInterface
{
    /**
     * @param string $phone
     * @return mixed
     */
    public function get(string $phone);
}
