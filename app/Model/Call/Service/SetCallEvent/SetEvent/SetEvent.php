<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

class SetEvent
{
    private SetEventInterface $event;

    function __construct(SetEventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @param SetEventInterface $event
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data)
    {
        return $this->event->set($data);
    }
}
