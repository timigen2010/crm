<?php

namespace App\Model\Discount\Service\Card\GenerateConfirmCode;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;

class GenerateConfirmCode implements GenerateConfirmCodeInterface
{
    private DiscountCardRepository $repository;

    public function __construct(DiscountCardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function generate(string $cardId, int $customerTelephoneId): string
    {
        /** @var DiscountCard $existCard */
        $existCard = $this->repository->findOneByIdAndTelephoneId($cardId, $customerTelephoneId);
        if ($existCard) {
            return $existCard->confirm_code;
        }
        $code = '';
        for($i = 0; $i < 4; $i ++) {
            $code .= mt_rand ( 0, 9 );
        }
        return $code;
    }
}
