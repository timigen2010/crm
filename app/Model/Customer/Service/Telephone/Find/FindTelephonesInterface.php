<?php

namespace App\Model\Customer\Service\Telephone\Find;

use App\Model\Customer\Entity\CustomerTelephone;
use Illuminate\Support\Collection;

interface FindTelephonesInterface
{
    /**
     * @param mixed $data
     * @return Collection<CustomerTelephone>
     */
    public function find($data);
}
