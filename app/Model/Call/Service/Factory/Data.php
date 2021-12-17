<?php

namespace App\Model\Call\Service\Factory;

class Data
{
    public int $sourceType;

    public int $sourceId;

    public string $source;

    public int $destinationType;

    public int $destinationId;

    public string $destination;

    public int $companyId;

    public ?int $companyPhonelineId;

    public ?string $phoneline;

    public string $comment;

    public string $dateStart;

    public ?string $dateEnd;

    public ?int $duration;

    public ?int $durationLive;

    public ?string $record;

    public ?string $uniqueId;

    public ?int $disposition;

    public int $statusDial;

    public function __construct(int $sourceType,
                                int $sourceId,
                                string $source,
                                int $destinationType,
                                int $destinationId,
                                string $destination,
                                int $companyId,
                                ?int $companyPhonelineId,
                                ?string $phoneline,
                                string $comment,
                                string $dateStart,
                                ?string $dateEnd,
                                ?int $duration,
                                ?int $durationLive,
                                ?string $record,
                                ?string $uniqueId,
                                ?int $disposition,
                                int $statusDial)
    {
        $this->sourceType = $sourceType;
        $this->sourceId = $sourceId;
        $this->source = $source;
        $this->destinationType = $destinationType;
        $this->destinationId = $destinationId;
        $this->destination = $destination;
        $this->companyId = $companyId;
        $this->companyPhonelineId = $companyPhonelineId;
        $this->phoneline = $phoneline;
        $this->comment = $comment;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->duration = $duration;
        $this->durationLive = $durationLive;
        $this->record = $record;
        $this->uniqueId = $uniqueId;
        $this->disposition = $disposition;
        $this->statusDial = $statusDial;
    }


}
