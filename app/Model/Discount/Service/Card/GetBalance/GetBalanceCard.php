<?php

namespace App\Model\Discount\Service\Card\GetBalance;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;
use DomainException;

class GetBalanceCard implements GetBalanceInterface
{
    private DiscountCardRepository $discountCardRepository;

    public function __construct(DiscountCardRepository $discountCardRepository)
    {
        $this->discountCardRepository = $discountCardRepository;
    }

    /**
     * @param Data $data
     * @return float
     */
    public function balance($data)
    {
        if (!($card = $this->checkCard($data->cardId, $data->telephone))) {
            throw new DomainException('Card is not validate');
        }
        return $card->balance / 100;
    }

    private function checkCard(string $cardId, string $telephone): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndTelephone($cardId, $telephone, true);
    }
}
