<?php

namespace App\Model\Discount\Service\Card\BalanceReplenishment;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Entity\DiscountCardOperation;
use App\Model\Discount\Entity\DiscountCardTransaction;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardOperation\Factory\Data as CardOperationFactoryData;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactoryInterface;
use App\Model\Discount\Service\CardTransaction\Factory\Data as CardTransactionFactoryData;
use DomainException;
use Illuminate\Support\Facades\DB;
use Throwable;

class BalanceReplenishment implements BalanceReplenishmentInterface
{
    private DiscountCardRepository $discountCardRepository;
    private CardOperationFactoryInterface $cardOperationFactory;
    private CardTransactionFactoryInterface $cardTransactionFactory;

    public function __construct(DiscountCardRepository $discountCardRepository,
                                CardOperationFactoryInterface $cardOperationFactory,
                                CardTransactionFactoryInterface $cardTransactionFactory)
    {
        $this->discountCardRepository = $discountCardRepository;
        $this->cardOperationFactory = $cardOperationFactory;
        $this->cardTransactionFactory = $cardTransactionFactory;
    }

    /**
     * @param Data $data
     * @return bool
     * @TODO need add send sms
     * @throws Throwable
     */
    public function replenishment($data)
    {
        if (!($card = $this->checkCard($data->cardId, $data->telephone))) {
            throw new DomainException('Card is not validate');
        }
        DB::connection()->transaction(function () use ($card, $data) {
            $bonuses = $data->bonuses * 100;
            $operation = $this->cardOperationFactory->create(new CardOperationFactoryData(
                $card->discount_card_id,
                $data->userId,
                $bonuses,
                DiscountCardOperation::ADD_TYPE
            ));
            $this->cardTransactionFactory->create(new CardTransactionFactoryData(
                $data->cardId,
                $data->userId,
                $operation->discount_card_operation_id,
                $bonuses,
                $card->balance,
                DiscountCardTransaction::FINISHED_STATUS
            ));
            $card->update([
                'balance' => $card->balance + $bonuses
            ]);
        });
        return true;
    }

    private function checkCard(string $cardId, $telephone): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndTelephone($cardId, $telephone, true);
    }
}
