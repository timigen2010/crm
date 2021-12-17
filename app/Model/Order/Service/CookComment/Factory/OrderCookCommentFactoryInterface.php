<?php

namespace App\Model\Order\Service\CookComment\Factory;

use App\Model\Order\Entity\OrderCookComment;

interface OrderCookCommentFactoryInterface
{
    public function create(Data $data): OrderCookComment;
}
