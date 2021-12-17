<?php

namespace App\Model\Discount\Service\Card\Get\ByCustomer;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;
use DomainException;

class GetCardByCustomer implements GetCardByCustomerInterface
{
    private DiscountCardRepository $discountCardRepository;

    public function __construct(DiscountCardRepository $discountCardRepository)
    {
        $this->discountCardRepository = $discountCardRepository;
    }

    /**
     * @param int $customerId
     * @param string $telephone
     * @return DiscountCard
     */
    public function get(int $customerId, string $telephone)
    {
        if (!($card = $this->checkCard($customerId, $telephone))) {
            throw new DomainException('Card is not validate');
        }
        $card->balance /= 100;
        return $card;
    }

    private function checkCard(int $customerId, string $telephone): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCustomerIdAndTelephone($customerId, $telephone, true);
    }
}
