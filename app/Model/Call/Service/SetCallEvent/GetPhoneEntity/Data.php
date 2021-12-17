<?php

namespace App\Model\Call\Service\SetCallEvent\GetPhoneEntity;

class Data
{
    public int $type;

    public int $id;

    public string $phone;

    public function __construct(int $type,
                                int $id,
                                string $phone)
    {
        $this->type = $type;
        $this->id = $id;
        $this->phone = $phone;
    }

}
