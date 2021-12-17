<?php

namespace App\Model\Order\Service\CookComment\Factory;

use App\Model\Order\Entity\OrderCookComment;

class OrderCookCommentFactory implements OrderCookCommentFactoryInterface
{
    public function create(Data $data): OrderCookComment
    {
        $orderCookComment = new OrderCookComment();
        $orderCookComment->order_id = $data->orderId;
        $orderCookComment->comment = $data->comment;
        $orderCookComment->save();
        return $orderCookComment;
    }
}
