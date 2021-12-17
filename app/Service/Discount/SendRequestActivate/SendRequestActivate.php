<?php

namespace App\Service\Discount\SendRequestActivate;

use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\Customer\Repository\CustomerTelephoneRepository;
use App\Model\Discount\Service\Card\Release\ReleaseInterface;
use App\Model\Discount\Service\Card\Release\Data as ReleaseData;
use DomainException;

class SendRequestActivate implements SendRequestActivateInterface
{
    private CustomerTelephoneRepository $customerTelephoneRepository;

    private ReleaseInterface $releaseCard;

    public function __construct(CustomerTelephoneRepository $customerTelephoneRepository,
                                ReleaseInterface $releaseCard)
    {
        $this->customerTelephoneRepository = $customerTelephoneRepository;
        $this->releaseCard = $releaseCard;
    }

    /**
     * @param Data $data
     * @return int
     */
    public function sendRequest($data)
    {
        if (!($customerTelephone = $this->checkCustomerTelephone($data->telephone))) {
            throw new DomainException("Telephone not found");
        }
        $this->releaseCard->release(new ReleaseData(
            $data->cardId,
            $customerTelephone->customer_telephone_id,
            $customerTelephone->customer_id,
            $data->userId,
            $data->isSendCode
        ));
        return $customerTelephone->customer_telephone_id;
    }

    private function checkCustomerTelephone(string $telephone): ?CustomerTelephone
    {
        return $this->customerTelephoneRepository->findOneByTelephone($telephone);
    }
}
