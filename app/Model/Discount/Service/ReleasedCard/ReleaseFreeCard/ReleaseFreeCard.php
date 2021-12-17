<?php

namespace App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard;

use App\Model\Discount\Entity\DiscountReleasedCard;
use App\Model\Discount\Repository\DiscountReleasedCardRepository;
use DomainException;

class ReleaseFreeCard implements ReleaseFreeCardInterface
{
    private DiscountReleasedCardRepository $discountReleasedCardRepository;

    public function __construct(DiscountReleasedCardRepository $discountReleasedCardRepository)
    {
        $this->discountReleasedCardRepository = $discountReleasedCardRepository;
    }

    /**
     * @param string $card
     * @return bool
     */
    public function release($card)
    {
        if (!$this->checkCard($card)) {
            throw new DomainException("Card already exists!");
        }
        $freeCard = new DiscountReleasedCard();
        $freeCard->discount_released_card_id = $card;
        $freeCard->save();
        return true;
    }

    private function checkCard(string $card)
    {
        return empty($this->discountReleasedCardRepository->findByCardId($card));
    }
}
