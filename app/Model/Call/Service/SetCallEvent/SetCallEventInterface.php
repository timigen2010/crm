<?php

namespace App\Model\Call\Service\SetCallEvent;

use App\Model\Call\Service\SetCallEvent\SetEvent\Data;

interface SetCallEventInterface
{
    /**
     * @param Data $data
     * @return mixed
     */
    public function setCallEvent(Data $data);
}
