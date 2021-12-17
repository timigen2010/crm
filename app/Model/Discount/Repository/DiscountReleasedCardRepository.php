<?php

namespace App\Model\Discount\Repository;

use App\Model\Discount\Entity\DiscountReleasedCard;
use Illuminate\Database\Eloquent\Builder;

class DiscountReleasedCardRepository
{
    private DiscountReleasedCard $model;

    public function __construct(DiscountReleasedCard $model)
    {
        $this->model = $model;
    }

    public function freeCardExistsById(string $cardId)
    {
        return $this->model->query()
            ->leftJoin(
                'discount_cards',
                'discount_cards.discount_card_id',
                '=',
                'discount_released_cards.discount_released_card_id'
            )
            ->where(function(Builder $query) {
                $query->whereNull('discount_cards.active')
                    ->orWhere('discount_cards.active', '<>', true);
            })
            ->where('discount_released_cards.discount_released_card_id', $cardId)
            ->first();
    }

    public function findByCardId(string $cardId)
    {
        return $this->model->query()
            ->leftJoin(
                'discount_cards',
                'discount_cards.discount_card_id',
                '=',
                'discount_released_cards.discount_released_card_id'
            )
            ->where('discount_released_cards.discount_released_card_id', $cardId)
            ->first();
    }
}
