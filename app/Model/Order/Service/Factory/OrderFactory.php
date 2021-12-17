<?php

namespace App\Model\Order\Service\Factory;

use App\Model\Order\Entity\Order;
use Carbon\Carbon;

class OrderFactory implements OrderFactoryInterface
{

    public function create(Data $data, Order $order = null): Order
    {
        $createdAt = $order ? $order->created_at : Carbon::now()->format('Y-m-d H:i:s');
        $order = $order ?? new Order();
        $order->company_id = $data->companyId;
        $order->menu_company_id = $data->menuCompanyId;
        $order->count_person = $data->countPerson;
        $order->count_oddmoney = $data->countOddmoney;
        $order->count_uncash = $data->countUncash;
        $order->discount_card_id = $data->discountCardId;
        $order->discount_card_transaction_id = $data->discountCardTransactionId;
        $order->count_bonus = $data->countBonus;
        $order->count_bonus_add = $data->countBonusAdd;
        $order->count_voucher = $data->countVoucher;
        $order->user_id = $data->userId;
        $order->last_editor_id = $data->lastEditorId;
        $order->deleted = false;
        $order->delivery_method = $data->deliveryMethod;
        $order->comment = $data->comment;
        $order->total = $data->total;
        $order->order_status_id = $data->orderStatusId;
        $order->language_id = $data->languageId;
        $order->currency_id = $data->currencyId;
        $order->currency_code = $data->currencyCode;
        $order->currency_value = $data->currencyValue;
        $order->created_at = $createdAt;
        $order->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->save();
        return $order;
    }
}
