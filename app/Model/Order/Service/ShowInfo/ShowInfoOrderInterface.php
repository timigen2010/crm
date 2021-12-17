<?php

namespace App\Model\Order\Service\ShowInfo;

interface ShowInfoOrderInterface
{
    /**
     * @param int $orderId
     * @return mixed
     */
    public function show(int $orderId);
}
