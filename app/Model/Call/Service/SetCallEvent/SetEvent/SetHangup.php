<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Company\Repository\CompanyRepository;
use App\Model\Customer\Repository\CustomerRepository;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Log;

class SetHangup implements SetEventInterface
{

    private CallActivityRepository $callActivityRepository;
    private GetPhoneEntityInterface $getPhoneEntity;
    private CleanPhoneInterface $cleanPhone;
    private CustomerRepository $customerRepository;
    private CompanyRepository $companyRepository;

    public function __construct(GetPhoneEntityInterface $getPhoneEntity, CallActivityRepository $callActivityRepository, CleanPhoneInterface $cleanPhone, CustomerRepository $customerRepository, CompanyRepository $companyRepository)
    {
        $this->getPhoneEntity = $getPhoneEntity;
        $this->callActivityRepository = $callActivityRepository;
        $this->cleanPhone = $cleanPhone;
        $this->customerRepository = $customerRepository;
        $this->companyRepository = $companyRepository;
    }
    /**
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data)
    {
        $source = $this->cleanPhone->clean($data->connectedLineNum);
        $destination = $this->cleanPhone->clean($data->callerIdNum);
        $call = $this->callActivityRepository->findCallBridgeORDialBegin($data->uniqueId, $source, $destination);

        if($call){
            $call->date_start = $data->date_start ? $data->date_start : '';
            $call->date_end = $data->date_end ? $data->date_end : null;

            $phoneEntity = $this->getPhoneEntity->get($source);
            $call->source_type = $phoneEntity->type;
            $call->source = $phoneEntity->phone;
            $call->source_id = $phoneEntity->id;

            $phoneEntity = $this->getPhoneEntity->get($destination);
            $call->destination_type = $phoneEntity->type;
            $call->destination = $phoneEntity->phone;
            $call->destination_id = $phoneEntity->id;

            if($call->source_type == 2){
                $telephone = $call->source;
            }
            else{
                $telephone = $call->destination;
            }
            $customer = $this->customerRepository->findBy(['telephone' => $telephone]);
            if($customer){
                $customer = $customer[0];
                $company = $this->companyRepository->findCustomerMainCompany($customer->customer_id);
                if($company){
                    $call->company_id = $company->company_id;
                }
            }

            $call->disposition = 'BUSY';
            $call->status_dial = 5;

            $call->uniqueId = $data->uniqueId;

            $call->save();
        }


        return ['return from SetHangup'];
    }
}
