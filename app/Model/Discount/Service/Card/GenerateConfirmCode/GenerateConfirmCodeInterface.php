<?php

namespace App\Model\Discount\Service\Card\GenerateConfirmCode;

interface GenerateConfirmCodeInterface
{
    public function generate(string $cardId, int $customerTelephoneId): string;
}
