<?php

namespace App\Model\Call\Service\Factory;

use App\Model\Call\Entity\CallActivity;

class CallActivityFactory extends CallActivityFactoryAbstract
{

    protected function setData(Data $data, CallActivity $callActivity): CallActivity
    {
        $callActivity->source_type = $data->sourceType;
        $callActivity->source_id = $data->sourceId;
        $callActivity->source = $data->source;
        $callActivity->destination_type = $data->destinationType;
        $callActivity->destination_id = $data->destinationId;
        $callActivity->destination = $data->destination;
        $callActivity->company_id = $data->companyId;
        $callActivity->company_phoneline_id = $data->companyPhonelineId;
        $callActivity->phoneLine = $data->phoneline;
        $callActivity->comment = $data->comment;
        $callActivity->date_start = $data->dateStart;
        $callActivity->date_end = $data->dateEnd;
        $callActivity->duration = $data->duration;
        $callActivity->duration_live = $data->durationLive;
        $callActivity->record = $data->record;
        $callActivity->unique_id = $data->uniqueId;
        $callActivity->disposition = $data->disposition;
        $callActivity->status_dial = $data->statusDial;
        $callActivity->save();
        return $callActivity;
    }
}
