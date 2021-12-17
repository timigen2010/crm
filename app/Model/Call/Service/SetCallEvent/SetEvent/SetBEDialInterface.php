<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Entity\DialStatus;
use App\Model\Company\Entity\Phoneline\CompanyPhoneline;

interface SetBEDialInterface
{
    /**
     * @param Data $data
     * @param DialStatus $status_dial
     * @param array $phonelines
     * @return mixed
     */
    public function set(Data $data, DialStatus $status_dial, $phonelines);
}
