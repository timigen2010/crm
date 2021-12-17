<?php

namespace App\Model\User\Service\HistoryLogin\Factory;

class Data
{
    public int $userId;

    public string $ip;

    public function __construct(int $userId, string $ip)
    {
        $this->userId = $userId;
        $this->ip = $ip;
    }


}
