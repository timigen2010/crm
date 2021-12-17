<?php

namespace App\Model\Customer\Service\Get\GetCustomersByParams;

use App\Model\Customer\Repository\CustomerRepository;
use App\Model\Customer\Service\Get\GetCustomersInterface;

class GetCustomersByParams implements GetCustomersInterface
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getCustomers($data)
    {
        return $this->customerRepository->findBy(
            [
                'name' => $data->name,
                'groupId' => $data->groupId,
                'status' => $data->status,
                'telephone' => $data->telephone
            ],
            [ $data->orderBy => $data->orderDirection ]
        )->loadMissing('customerTelephones');
    }
}
