<?php

namespace App\EventListeners\User\AccessToken;

use App\Model\User\Service\HistoryLogin\Factory\HistoryLoginFactoryInterface;
use App\Model\User\Service\HistoryLogin\Factory\Data;
use Laravel\Passport\Events\AccessTokenCreated;

class AccessTokenCreateListener
{
    private HistoryLoginFactoryInterface $historyLoginFactory;

    public function __construct(HistoryLoginFactoryInterface $historyLoginFactory)
    {
        $this->historyLoginFactory = $historyLoginFactory;
    }

    public function handle(AccessTokenCreated $event)
    {
        $this->historyLoginFactory->create(new Data(
            $event->userId,
            request()->getClientIp()
        ));
    }
}
