<?php

namespace App\Model\Customer\Service\Telephone\Find;

use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\Customer\Repository\CustomerTelephoneRepository;
use Illuminate\Database\Eloquent\Collection;

class FindTelephones implements FindTelephonesInterface
{
    private CustomerTelephoneRepository $repository;

    public function __construct(CustomerTelephoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $telephone
     * @return Collection<CustomerTelephone>
     */
    public function find($telephone)
    {
        return $this->repository->findByTelephone($telephone);
    }
}
