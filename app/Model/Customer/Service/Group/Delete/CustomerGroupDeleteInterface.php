<?php

namespace App\Model\Customer\Service\Group\Delete;

use App\Model\Customer\Entity\Group\CustomerGroup;

interface CustomerGroupDeleteInterface
{
    public function delete(CustomerGroup $group);
}
