<?php

namespace App\Model\Customer\Service\Group\Get\Groups;

use App\Model\Customer\Entity\Group\CustomerGroup;
use App\Model\Customer\Repository\CustomerGroupRepository;
use App\Model\Customer\Service\Group\Get\GetCustomerGroupsInterface;
use Illuminate\Database\Eloquent\Collection;

class GetCustomerGroups implements GetCustomerGroupsInterface
{
    private CustomerGroupRepository $customerGroupRepository;

    public function __construct(CustomerGroupRepository $customerGroupRepository)
    {
        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * @param mixed $data
     * @return Collection<CustomerGroup>
     */
    public function getGroups($data = [])
    {
        return $this->customerGroupRepository->findBy([])
            ->loadMissing('customerGroupDescriptions');
    }
}
