<?php

namespace App\Model\Discount\Service\Card\Activate;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Entity\DiscountCardOperation;
use App\Model\Discount\Entity\DiscountCardTransaction;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardOperation\Factory\Data as CardOperationFactoryData;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactoryInterface;
use App\Model\Discount\Service\CardTransaction\Factory\Data as CardTransactionFactoryData;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ActivateCard implements ActivateInterface
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
    public function activate($data)
    {
        if (!($card = $this->checkValidateCard($data->cardId, $data->code))) {
            throw new DomainException('Card is not validate');
        }
        DB::connection()->transaction(function () use ($card, $data) {
            $card->update([
                'active' => true,
                'blocked' => false,
                'date_activate' => Carbon::now()->timestamp,
                'balance' => $card->balance + $data->bonusAdd
            ]);
            $operation = $this->cardOperationFactory->create(new CardOperationFactoryData(
                $card->discount_card_id,
                $data->userId,
                $data->bonusAdd,
                DiscountCardOperation::ACTIVATE_TYPE
            ));
            $this->cardTransactionFactory->create(new CardTransactionFactoryData(
                $data->cardId,
                $data->userId,
                $operation->discount_card_operation_id,
                $data->bonusAdd,
                $card->balance,
                DiscountCardTransaction::FINISHED_STATUS
            ));
        });
        return true;
    }

    private function checkValidateCard(string $cardId, string $code): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndCode($cardId, $code, false);
    }
}
