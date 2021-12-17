<?php

namespace App\Model\Discount\Service\Card\Rebind;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Entity\DiscountCardOperation;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardOperation\Factory\Data as CardOperationFactoryData;
use DomainException;

class RebindCard implements RebindInterface
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
     */
    public function rebind($data)
    {
        if ($this->checkCustomerTelephone($data->customerTelephoneId)) {
            throw new DomainException("Telephone is not valid");
        }
        if (!($card = $this->checkValidateCard($data->cardId, $data->code))) {
            throw new DomainException('Card is not validate');
        }
        $telephoneOld = $card->customerTelephone->telephone;
        $card->update([
            'customer_telephone_id' => $data->customerTelephoneId,
            'customer_id' => $data->customerId,
            'user_id' => $data->userId
        ]);
        $this->cardOperationFactory->create(new CardOperationFactoryData(
            $card->discount_card_id,
            $data->userId,
            0,
            DiscountCardOperation::REBIND_TYPE,
            '',
            $telephoneOld,
            $card->customerTelephone->telephone

        ));
        return true;
    }

    private function checkValidateCard(string $cardId, string $code): ?DiscountCard
    {
        return $this->discountCardRepository->findOneByCardIdAndCode($cardId, $code);
    }

    private function checkCustomerTelephone(int $customerTelephoneId): ?DiscountCard
    {
        return $this->discountCardRepository->findActiveCardByTelephoneId($customerTelephoneId);
    }

}
