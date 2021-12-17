<?php

namespace App\Model\Customer\Repository;

use App\Model\Customer\Entity\CustomerTelephone;
use Illuminate\Support\Facades\Log;

class CustomerTelephoneRepository
{
    private CustomerTelephone $model;

    public function __construct(CustomerTelephone $model)
    {
        $this->model = $model;
    }

    public function findById(int $telephoneId)
    {
        return $this->model->query()
            ->where('customer_telephone_id', '=', $telephoneId)
            ->first();
    }

    public function findOneByTelephone(string $telephone)
    {
        /** @var CustomerTelephone $customerTelephone */
        $customerTelephone = $this->model->query()
            ->where('telephone', '=', $telephone)
            ->first();
        return $customerTelephone;
    }

    public function findByTelephone(string $telephone)
    {
        return $this->model->query()
            ->where('telephone', 'like', "%{$telephone}%")
            ->get();
    }
}
