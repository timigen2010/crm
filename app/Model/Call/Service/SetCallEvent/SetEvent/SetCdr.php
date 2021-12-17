<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Repository\DialStatusRepository;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\Factory\Data as CallActivityFactoryData;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Company\Repository\CompanyRepository;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Customer\Repository\CustomerRepository;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Log;

class SetCdr implements SetEventInterface
{
    private CallActivityRepository $callActivityRepository;
    private CallActivityFactoryAbstract $callActivityFactory;
    private CleanPhoneInterface $cleanPhone;
    private GetPhoneEntityInterface $getPhoneEntity;
    private CustomerRepository $customerRepository;
    private CompanyRepository $companyRepository;

    public function __construct(GetPhoneEntityInterface $getPhoneEntity, CallActivityRepository $callActivityRepository, CleanPhoneInterface $cleanPhone, CallActivityFactoryAbstract $callActivityFactory, CustomerRepository $customerRepository, CompanyRepository $companyRepository)
    {
        $this->getPhoneEntity = $getPhoneEntity;
        $this->callActivityRepository = $callActivityRepository;
        $this->cleanPhone = $cleanPhone;
        $this->callActivityFactory = $callActivityFactory;
        $this->customerRepository = $customerRepository;
        $this->companyRepository = $companyRepository;
    }
    /**
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data)
    {
//        $this->load->model('marketing/call');
//        $this->load->model('setting/history');

        $explodedRecord = explode('-', $data->record);
        $record = explode('.', end($explodedRecord));

        $uniqueId = $record[0] . '.' . $record[1];

        $call = $this->callActivityRepository->findCallUnique($uniqueId);
        $newCall = false;

        if(!$call){
            $call = $this->callActivityFactory->create(new CallActivityFactoryData(
                0,
                0,
                '',
                0,
                0,
                '',
                0,
                null,
                null,
                '',
                '',
                null,
                null,
                null,
                null,
                null,
                null,
                5,
            ));
            $newCall = true;
        }

        if (empty($call->source)) {
            $phoneEntity = $this->getPhoneEntity->get($data->source);
            $call->source_type = $phoneEntity->type;
            $call->source = $phoneEntity->phone;
            $call->source_id = $phoneEntity->id;
        }

        if (empty($call->destination)) {
            $phoneEntity = $this->getPhoneEntity->get($data->destination);
            $call->destination_type = $phoneEntity->type;
            $call->destination = $phoneEntity->phone;
            $call->destination_id = $phoneEntity->id;
        }

        if ($newCall || ( !$newCall && $call->statusDial->code != 'complete')) {

            if ($newCall) {
                $call->unique_id =  $record[0] . '.' . $record[1];
                $call->company_id = '';
                $call->phoneline = '';
                $call->company_phoneline_id = '';
                $call->comment = '';
            }
            $call->disposition = $data->disposition;
            $call->date_start = $data->date_start;
            $call->date_end = $data->date_end;
            $call->duration = $data->duration;
            $call->duration_live = $data->duration_live;
            $call->record = $data->record;
            $call->status_dial = 5;

//            $call['status_dial'] = 'complete';
            Log::info('Begin editing company_id in CDR');
            if($call->source_type == 2){
                $telephone = $call->source;
            }
            else{
                $telephone = $call->destination;
            }
            $customer = $this->customerRepository->findBy(['telephone' => $telephone]);
            Log::info(json_encode($customer));
            if($customer){
                $customer = $customer[0];
                $company = $this->companyRepository->findCustomerMainCompany($customer->customer_id);
                Log::info(json_encode($company));
                if($company){
                    $call->company_id = $company->company_id;
                }
            }
            Log::info('END editing company_id in CDR');

            $call->save();

        } elseif (!$newCall && $call->statusDial->code == 'complete') {

            $call->disposition = $data->disposition;
            $call->date_start = $data->date_start;
            $call->date_end = $data->date_end;
            $call->duration = $data->duration;
            $call->duration_live = $data->duration_live;
            $call->record = $data->record;
            $call->status_dial = 5;

            if(!$call->company_id){
                Log::info('Begin editing company_id in CDR');
                if($call->source_type == 2){
                    $telephone = $call->source;
                }
                else{
                    $telephone = $call->destination;
                }
                $customer = $this->customerRepository->findBy(['telephone' => $telephone]);
                Log::info(json_encode($customer));
                if($customer){
                    $customer = $customer[0];
                    $company = $this->companyRepository->findCustomerMainCompany($customer->customer_id);
                    Log::info(json_encode($company));
                    if($company){
                        $call->company_id = $company->company_id;
                    }
                }
                Log::info('END editing company_id in CDR');
            }

            $call->save();

        }
        return ['return from SetCdr'];
    }
}
