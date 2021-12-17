<?php

namespace App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\Mass;

use App\Model\Discount\Entity\DiscountReleasedCard;
use App\Model\Discount\Repository\DiscountReleasedCardRepository;
use App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\ReleaseFreeCardInterface;

class ReleaseMassFreeCards implements ReleaseFreeCardInterface
{
    private DiscountReleasedCardRepository $discountReleasedCardRepository;

    public function __construct(DiscountReleasedCardRepository $discountReleasedCardRepository)
    {
        $this->discountReleasedCardRepository = $discountReleasedCardRepository;
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function release($data)
    {
        for ($current = $data->start; $current <= $data->end; $current++) {
            $card = str_pad($current, 6, "0", STR_PAD_LEFT);
            if ($this->checkCard($card)) {
                $freeCard = new DiscountReleasedCard();
                $freeCard->discount_released_card_id = $card;
                $freeCard->save();
            }
        }
        return true;
    }

    private function checkCard(string $card)
    {
        return empty($this->discountReleasedCardRepository->findByCardId($card));
    }
}

