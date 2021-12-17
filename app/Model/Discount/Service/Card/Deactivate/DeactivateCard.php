<?php

namespace App\Model\Discount\Service\Card\Deactivate;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Entity\DiscountCardOperation;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardOperation\Factory\Data as CardOperationFactoryData;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeactivateCard implements DeactivateInterface
{
    private DiscountCardRepository $discountCardRepository;
    private CardOperationFactoryInterface $cardOperationFactory;

    public function __construct(DiscountCardRepository $discountCardRepository,
                                CardOperationFactoryInterface $cardOperationFactory)
    {
        $this->discountCardRepository = $discountCardRepository;
        $this->cardOperationFactory = $cardOperationFactory;
    }

    /**
     * @param Data $data
     * @return bool
     * @TODO need add send sms
     * @throws Throwable
     */
    public function deactivate($data)
    {
        if (!($customerTelephone = $this->checkCustomerTelephone($data->cardId, $data->telephone))) {
            throw new DomainException("Telephone not found");
        }
        if (!($card = $this->checkValidateCard($data->cardId, $data->code))) {
            throw new DomainException('Card is not validate');
        }
        DB::connection()->transaction(function () use ($card, $data) {
            $card->update([
                'active' => false,
                'blocked' => true,
                'date_activate' => null,
                'date_blocked' => Carbon::now()->format('Y-m-d H:i:s'),
                'balance' => 0
            ]);
            $this->cardOperationFactory->create(new CardOperationFactoryData(
                $card->discount_card_id,
                $data->userId,
                0,
                DiscountCardOperation::DEACTIVATE_TYPE
            ));
        });
        return true;
    }

    private function checkValidateCard(string $cardId, string $code): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndCode($cardId, $code, true);
    }

    private function checkCustomerTelephone(string $cardId, string $telephone): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndTelephone($cardId, $telephone);
    }
}
