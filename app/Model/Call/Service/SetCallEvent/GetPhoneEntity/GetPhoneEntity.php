<?php

namespace App\Model\Call\Service\SetCallEvent\GetPhoneEntity;

use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\Data as Data;
use App\Model\Customer\Service\Factory\Data as CustomerData;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBridge;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetCdr;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetDial;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetEvent;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetHangup;
use App\Model\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Model\Customer\Service\Telephone\Find\FindTelephoneInterface;
use App\Model\DB\Repository\ReceivingDBSyncRepository;
use App\Model\User\Service\SipPhone\Find\FindSipPhoneInterface;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Log;

class GetPhoneEntity implements GetPhoneEntityInterface
{
    private FindSipPhoneInterface $findSipPhone;
    private FindTelephoneInterface $findTelephone;
    private CleanPhoneInterface $cleanPhone;
    private CustomerFactoryAbstract $customerFactory;
    private ReceivingDBSyncRepository $dbSyncRepository;

    public function __construct(CleanPhoneInterface $cleanPhone, FindSipPhoneInterface $findSipPhone, FindTelephoneInterface $findTelephone, CustomerFactoryAbstract $customerFactory, ReceivingDBSyncRepository $dbSyncRepository)
    {
        $this->cleanPhone = $cleanPhone;
        $this->findSipPhone = $findSipPhone;
        $this->findTelephone = $findTelephone;
        $this->customerFactory = $customerFactory;
        $this->dbSyncRepository = $dbSyncRepository;
    }
    /**
     * @param string $phone
     * @return Data
     */
    public function get(string $phone)
    {
        $cleanPhone = $this->cleanPhone->clean($phone);

        if($result = $this->findSipPhone->find($cleanPhone)){

            $response = new Data(1, $result->user_id, $result->phone);

        } elseif ($result = $this->findTelephone->find($cleanPhone)){

            $response = new Data(2, $result->customer_telephone_id, $result->telephone);

        } else {

            $customer = $this->customerFactory->create(new CustomerData(
                5,
                '',
                '',
                '',
                '',
                true,
                [],
                [
                    [
                        'telephone' => $cleanPhone,
                        'isMain' => true
                    ]
                ],
                []
            ));

            $result = $this->findTelephone->find($cleanPhone);

            $response = new Data(2, $result->customer_telephone_id, $result->telephone);
        }

        return $response;
    }

}
