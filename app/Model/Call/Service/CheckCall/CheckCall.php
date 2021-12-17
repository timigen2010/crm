<?php

namespace App\Model\Call\Service\CheckCall;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Repository\DialStatusRepository;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Call\Service\CheckCall\Data;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBEDialInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBridge;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetCdr;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetDial;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetEvent;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetHangup;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Customer\Repository\CustomerRepository;
use App\Model\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Model\DB\Repository\ReceivingDBSyncRepository;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Auth;
use App\Model\Customer\Service\Factory\Data as CustomerFactoryData;
use Illuminate\Support\Facades\Log;

class CheckCall implements CheckCallInterface
{
    private CallActivityRepository $callActivityRepository;
    private CustomerFactoryAbstract $customerFactory;
    private CustomerRepository $customerRepository;
    private ReceivingDBSyncRepository $dbSyncRepository;

    public function __construct(CallActivityRepository $callActivityRepository, CustomerRepository $customerRepository, CustomerFactoryAbstract $customerFactory, ReceivingDBSyncRepository $dbSyncRepository)
    {
        $this->callActivityRepository = $callActivityRepository;
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
        $this->dbSyncRepository = $dbSyncRepository;
    }

    /**
     * @return array
     */
    public function checkCall(){

        $result = new Data();

        $callActivity = $this->callActivityRepository->findCheckCall(Auth::id());

        if($callActivity && $callActivity->statusDial->code == 'Bridge'){
            $result->companyId = $callActivity->company_id;
            $result->callId = $callActivity->call_activity_id;
            $result->isIn = $callActivity->source_type == 1;
            $result->telephone = ($result->isIn) ? $callActivity->destination : $callActivity->source;
            $customer = $this->customerRepository->findOneByTelephoneId(
                ($result->isIn) ? $callActivity->destination_id : $callActivity->source_id
            );

            if($customer){
                $result->customerId = $customer->customer_id;

                if($callActivity->company){
                    $customer->companies()->detach($callActivity->company->company_id);
                    $customer->companies()->attach($callActivity->company->company_id);
                }
            }
        }

        return [$result];
    }

}
