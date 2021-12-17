<?php

namespace App\Model\Order\Service\CookComment\Factory;

class Data
{
    public int $orderId;
    public string $comment;

    public function __construct(int $orderId, string $comment)
    {
        $this->orderId = $orderId;
        $this->comment = $comment;
    }
}
