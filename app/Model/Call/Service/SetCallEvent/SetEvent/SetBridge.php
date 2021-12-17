<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Repository\DialStatusRepository;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Service\Phone\Clean\CleanPhoneInterface;
use App\Model\Call\Service\Factory\Data as CallActivityFactoryData;

class SetBridge implements SetEventInterface
{

    private CallActivityRepository $callActivityRepository;
    private GetPhoneEntityInterface $getPhoneEntity;
    private CallActivityFactoryAbstract $callActivityFactory;
    private DialStatusRepository $dialStatusRepository;
    private CleanPhoneInterface $cleanPhone;

    public function __construct(GetPhoneEntityInterface $getPhoneEntity, CallActivityRepository $callActivityRepository, CallActivityFactoryAbstract $callActivityFactory, DialStatusRepository $dialStatusRepository, CleanPhoneInterface $cleanPhone)
    {
        $this->getPhoneEntity = $getPhoneEntity;
        $this->callActivityRepository = $callActivityRepository;
        $this->callActivityFactory = $callActivityFactory;
        $this->dialStatusRepository = $dialStatusRepository;
        $this->cleanPhone = $cleanPhone;
    }
    /**
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data)
    {
        $call = $this->callActivityRepository->findCallUnique($data->uniqueId);

        if((!$call || ($call && $call->statusDial->code != 'Bridge')) && $data->callerId1 && $data->callerId2){

            $phoneEntity = $this->getPhoneEntity->get($this->cleanPhone->clean($data->callerId1));
            $sourceType = $phoneEntity->type;
            $source = $phoneEntity->phone;
            $sourceId = $phoneEntity->id;

            $phoneEntity = $this->getPhoneEntity->get($this->cleanPhone->clean($data->callerId2));
            $destinationType = $phoneEntity->type;
            $destination = $phoneEntity->phone;
            $destinationId = $phoneEntity->id;

            $dateStart = $data->date_start ? $data->date_start : '';
            $dateEnd = $data->date_end ? $data->date_end : null;

            $statusDial = $this->dialStatusRepository->findOneBy(['code' => $data->event]);

            $factoryData = new CallActivityFactoryData(
                $sourceType,
                $sourceId,
                $source,
                $destinationType,
                $destinationId,
                $destination,
                ($call && $call->company_id) ? $call->company_id : 0,
                ($call && $call->company_phoneline_id) ? $call->company_phoneline_id : 0,
                ($call && $call->phoneline) ? $call->phoneline : '',
                ($call && $call->comment) ? $call->comment : '',
                $dateStart,
                $dateEnd,
                $data->duration,
                $data->duration_live,
                $data->record,
                $data->uniqueId,
                null,
                $statusDial->dial_status_id
            );
            $this->callActivityFactory->create($factoryData);
        }

        return ['return from SetBridge'];
    }
}
