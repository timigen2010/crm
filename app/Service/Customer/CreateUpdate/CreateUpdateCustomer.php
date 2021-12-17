<?php

namespace App\Service\Customer\CreateUpdate;

use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Model\Customer\Service\Factory\Data;
use App\Model\Discount\Repository\DiscountCardRepository;
use DomainException;

class CreateUpdateCustomer implements CreateUpdateCustomerInterface
{
    private CustomerFactoryAbstract $customerFactory;
    private DiscountCardRepository $discountCardRepository;

    public function __construct(CustomerFactoryAbstract $customerFactory,
                                DiscountCardRepository $discountCardRepository)
    {
        $this->customerFactory = $customerFactory;
        $this->discountCardRepository = $discountCardRepository;
    }

    public function handle(Data $data, Customer $customer = null): Customer
    {
        if ($this->discountCardRepository->checkExistsByCustomerTelephoneIds($data->removeTelephoneIds)) {
            throw new DomainException("Removed telephone has relation with discount card");
        }
        return $this->customerFactory->create($data, $customer);
    }
}
