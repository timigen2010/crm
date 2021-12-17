<?php

namespace App\Model\Customer\Service\Telephone\Find;

use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\Customer\Repository\CustomerTelephoneRepository;

class FindTelephone implements FindTelephoneInterface
{
    private CustomerTelephoneRepository $repository;

    public function __construct(CustomerTelephoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $telephone
     * @return CustomerTelephone
     */
    public function find($telephone): ?CustomerTelephone
    {
        return $this->repository->findOneByTelephone($telephone);
    }
}
