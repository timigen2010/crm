<?php

namespace App\Model\Call\Service\Factory;

use App\Model\Call\Entity\CallActivity;

abstract class CallActivityFactoryAbstract
{
    abstract protected function setData(Data $data, CallActivity $callActivity): CallActivity;

    public function create(Data $data, ?CallActivity $callActivity = null): CallActivity
    {
        $callActivity = $callActivity ?? CallActivity::query()->make();
        return $this->setData($data, $callActivity);
    }
}
