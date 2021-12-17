<?php

namespace App\Model\User\Service\HistoryLogin\Factory;

use App\Model\User\Entity\UserHistoryLogin;

class HistoryLoginFactory implements HistoryLoginFactoryInterface
{

    /**
     * @param Data $data
     * @return UserHistoryLogin
     * @throws \Throwable
     */
    public function create(Data $data): UserHistoryLogin
    {
        $historyLogin = new UserHistoryLogin();
        $historyLogin->user_id = $data->userId;
        $historyLogin->ip = $data->ip;
        $historyLogin->saveOrFail();
        return $historyLogin;
    }
}
