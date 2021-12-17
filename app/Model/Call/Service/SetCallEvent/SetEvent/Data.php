<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

class Data
{
    public ?string $source;

    public ?string $destination;

    public ?string $callerIdName;

    public ?string $callerIdNum;

    public ?string $connectedLineNum;

    public ?string $callerId1;

    public ?string $callerId2;

    public string $event;

    public ?string $subEvent;

    public string $uniqueId;

    public ?string $confirm;

    public ?string $record;

    public ?string $disposition;

    public ?string $date_start;

    public ?string $date_end;

    public ?string $duration;

    public ?string $duration_live;

    public function __construct(string $event,
                                string $uniqueId,
                                ?string $source,
                                ?string $destination,
                                ?string $callerIdName,
                                ?string $callerIdNum,
                                ?string $connectedLineNum,
                                ?string $callerId1,
                                ?string $callerId2,
                                ?string $subEvent,
                                ?string $confirm,
                                ?string $date_start = null,
                                ?string $date_end = null,
                                ?string $duration = null,
                                ?string $duration_live = null,
                                ?string $record = null,
                                ?string $disposition = null)
    {
        $this->event = $event;
        $this->uniqueId = $uniqueId;
        $this->source = $source;
        $this->destination = $destination;
        $this->callerIdName = $callerIdName;
        $this->callerIdNum = $callerIdNum;
        $this->connectedLineNum = $connectedLineNum;
        $this->callerId1 = $callerId1;
        $this->callerId2 = $callerId2;
        $this->subEvent = $subEvent;
        $this->confirm = $confirm;
        $this->record = $record;
        $this->disposition = $disposition;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->duration = $duration;
        $this->duration_live = $duration_live;
    }


}
