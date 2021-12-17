<?php

namespace App\Model\User\Service\SipPhone\Find;

use App\Model\User\Entity\UserSip;
use App\Model\User\Repository\User\UserSipRepository;
use DomainException;

class FindSipPhone implements FindSipPhoneInterface
{
    private UserSipRepository $repository;

    public function __construct(UserSipRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $phone
     * @return UserSip
     */
    public function find($phone): ?UserSip
    {
        $userSip = $this->repository->findOneByPhone($phone);
        return $userSip;
    }
}
