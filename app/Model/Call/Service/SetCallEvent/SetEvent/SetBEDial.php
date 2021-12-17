<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Entity\CallActivity;
use App\Model\Call\Entity\DialStatus;
use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Call\Service\Factory\Data as CallActivityData;
use App\Model\Customer\Service\Telephone\Find\FindTelephoneInterface;
use App\Model\User\Service\SipPhone\Find\FindSipPhone;
use App\Model\User\Service\SipPhone\Find\FindSipPhoneInterface;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Log;

class SetBEDial implements SetBEDialInterface
{
    private GetPhoneEntityInterface $getPhoneEntity;
    private CallActivityFactoryAbstract $callActivityFactory;
    private CallActivityRepository $callActivityRepository;
    private CleanPhoneInterface $cleanPhone;

    public function __construct(GetPhoneEntityInterface $getPhoneEntity, CallActivityFactoryAbstract $callActivityFactory, CallActivityRepository $callActivityRepository, CleanPhoneInterface $cleanPhone)
    {
        $this->getPhoneEntity = $getPhoneEntity;
        $this->callActivityFactory = $callActivityFactory;
        $this->callActivityRepository = $callActivityRepository;
        $this->cleanPhone = $cleanPhone;
    }
    /**
     * @param Data $data
     * @param DialStatus $dialStatus
     * @param array $phonelines
     * @return CallActivity
     */
    public function set(Data $data, DialStatus $dialStatus, $phonelines)
    {
        $call = [];
        foreach ($data as $key => $value) {
            $call[$key] = $value;
        }

        $new_call = false;
        Log::info('Where phoneline needs to be');
        Log::info(json_encode($data));
        if (isset($data->connectedLineNum)
            && isset($data->callerIdNum)
            && $data->connectedLineNum != $data->callerIdNum
            && $data->connectedLineNum != '<unknown>'
            && $data->callerIdNum != '<unknown>') {

            $call['date_added'] = date('Y-m-d H:i:s');
            $call['date_end'] = null;

            $call['source'] = $this->getPhoneEntity->get($this->cleanPhone->clean($data->callerIdNum));
            $call['destination'] = $this->getPhoneEntity->get($this->cleanPhone->clean($data->connectedLineNum));
            $call['company_id'] = 0;
            $call['phoneline'] = '';
            $call['company_phoneline_id'] = 0;

            if ($data->callerIdName) {
                foreach ($phonelines as $line) {

                    $pattern = '/^' . strtolower($line->keyword) . '/';

                    if (preg_match($pattern, strtolower($data->callerIdName))) {

                        $call['company_id'] = $line->company_id;
                        $call['phoneline'] = $line->getName();
                        $call['company_phoneline_id'] = $line->company_phoneline_id;
                    }
                }
            }

            $call['comment'] = '';
            $call['duration'] = null;
            $call['duration_live'] = null;
            $call['record'] = null;
            $call['disposition'] = null;
            $call['uniqueid'] = $data->uniqueId;
            $call['status_dial'] = $dialStatus->dial_status_id;
            $call_new = $this->callActivityRepository->findCallNew($data->source, $data->destination);

            if ($call_new) {
                $call['source']->id = $call_new->source_id;
                $call['source']->phone = $call_new->source;
                $call['source']->type = $call_new->source_type;
                $call['destination']->id = $call_new->destination_id;
                $call['destination']->phone = $call_new->destination;
                $call['destination']->type = $call_new->destination_type;
                $call['company_id'] = $call_new->company_id;
            }

            $last_call = $this->callActivityRepository->findCallUnique($data->uniqueId);

            if (!$last_call || ( $last_call && $last_call->statusDial->code != 'DialBegin')) {
                $new_call = $this->callActivityFactory->create(new CallActivityData(
                    $call['source']->type,
                    $call['source']->id,
                    $call['source']->phone,
                    $call['destination']->type,
                    $call['destination']->id,
                    $call['destination']->phone,
                    $call['company_id'],
                    $call['company_phoneline_id'] ?? null,
                    $call['phoneline'] ?? null,
                    $call['comment'],
                    $call['date_added'],
                    $call['date_end'] ?? null,
                    $call['duration'] ?? null,
                    $call['duration_live'] ?? null,
                    $call['record'] ?? null,
                    $call['uniqueid'] ?? null,
                    $call['disposition'] ?? null,
                    $call['status_dial']
                ));
            }
        }
        return $new_call;
    }
}
