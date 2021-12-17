<?php

namespace App\Model\Discount\Service\Card\Release;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Repository\DiscountReleasedCardRepository;
use App\Model\Discount\Service\Card\Factory\CardFactoryInterface;
use App\Model\Discount\Service\Card\Factory\Data as CardFactoryData;
use App\Model\Discount\Service\Card\GenerateConfirmCode\GenerateConfirmCodeInterface;
use DomainException;

class ReleaseCard implements ReleaseInterface
{
    private DiscountReleasedCardRepository $discountReleasedCardRepository;

    private DiscountCardRepository $discountCardRepository;

    private GenerateConfirmCodeInterface $generateConfirmCode;

    private CardFactoryInterface $cardFactory;

    public function __construct(DiscountReleasedCardRepository $discountReleasedCardRepository,
                                DiscountCardRepository $discountCardRepository,
                                GenerateConfirmCodeInterface $generateConfirmCode,
                                CardFactoryInterface $cardFactory)
    {
        $this->discountReleasedCardRepository = $discountReleasedCardRepository;
        $this->discountCardRepository = $discountCardRepository;
        $this->generateConfirmCode = $generateConfirmCode;
        $this->cardFactory = $cardFactory;
    }

    /**
     * @param Data $data
     * @return DiscountCard
     * @TODO need added send confirm code
     */
    public function release($data)
    {
        if (!$this->isCardValidate($data->cardId)) {
            throw new DomainException('Card is not validate');
        }
        if ($this->checkActiveCardByPhone($data->customerTelephoneId)) {
            throw new DomainException('Card with this telephone already active');
        }
        $confirmCode = $this->generateConfirmCode->generate($data->cardId, $data->customerTelephoneId);
        return $this->cardFactory->create(new CardFactoryData(
            $data->cardId,
            $data->customerTelephoneId,
            $data->customerId,
            $confirmCode,
            $data->userId
        ));
    }

    private function isCardValidate(string $cardId)
    {
        return $this->discountReleasedCardRepository->freeCardExistsById($cardId);
    }

    private function checkActiveCardByPhone(int $customerTelephoneId)
    {
        return $this->discountCardRepository->findActiveCardByTelephoneId($customerTelephoneId);
    }
}
