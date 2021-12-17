<?php

namespace App\Model\Customer\Service\Group\Delete;

use App\Model\Customer\Entity\Group\CustomerGroup;

class CustomerGroupDelete implements CustomerGroupDeleteInterface
{

    /**
     * @param CustomerGroup $group
     * @throws \Exception
     */
    public function delete(CustomerGroup $group)
    {
        $group->customerGroupDescriptions()->delete();
        $group->delete();
    }
}
