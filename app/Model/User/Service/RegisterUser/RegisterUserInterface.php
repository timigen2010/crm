<?php

namespace App\Model\User\Service\RegisterUser;

interface RegisterUserInterface
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function register($data);
}
