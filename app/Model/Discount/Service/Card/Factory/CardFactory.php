<?php

namespace App\Model\Discount\Service\Card\Factory;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class CardFactory implements CardFactoryInterface
{
    private DiscountCardRepository $repository;

    private DiscountCard $model;

    public function __construct(DiscountCardRepository $repository, DiscountCard $model)
    {
        $this->repository = $repository;
        $this->model = $model;
    }

    /**
     * @param Data $data
     * @return DiscountCard
     * @throws Throwable
     */
    public function create(Data $data): DiscountCard
    {
        $discountCard = null;
        DB::connection()->transaction(function () use ($data, &$discountCard) {
            $this->repository->clearCardsByTelephoneId($data->cardId, $data->customerTelephoneId);
            $discountCard = $this->model->query()->updateOrCreate([
                'discount_card_id' => $data->cardId,
            ], [
                'customer_telephone_id' => $data->customerTelephoneId,
                'customer_id' => $data->customerId,
                'user_id' => $data->userId,
                'confirm_code' => $data->code,
                'date_released' => Carbon::now()->format('Y-m-d H:i:s'),
                'active' => false,
                'blocked' => false,
                'balance' => 0,
            ]);
            $discountCard->save();
        });
        return $discountCard;
    }
}
