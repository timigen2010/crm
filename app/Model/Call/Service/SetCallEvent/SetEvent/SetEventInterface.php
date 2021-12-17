<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

interface SetEventInterface
{
    /**
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data);
}
