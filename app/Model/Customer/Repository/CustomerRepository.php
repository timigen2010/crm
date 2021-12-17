<?php

namespace App\Model\Customer\Repository;

use App\Model\Customer\Entity\Customer;

class CustomerRepository
{
    private Customer $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        return $this->model->query()->find($id);
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if (!empty($where['name'])) {
            $query
                ->where('firstName', 'like', "%{$where['name']}%")
                ->where('lastName', 'like', "%{$where['name']}%");
        }
        if (!empty($where['groupId'])) {
            $query->where('customer_group_id', '=', $where['groupId']);
        }
        if (!empty($where['status'])) {
            $query->where('status', '=', $where['status']);
        }
        if (!empty($where['telephone'])) {
            $query
                ->join('customer_telephones', 'customer_telephones.customer_id',
                    '=', 'customers.customer_id')
                ->where('customer_telephones.telephone', 'like', "{$where['telephone']}%");
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get();
    }

    public function findOneByTelephoneId(int $telephoneId)
    {
        /** @var Customer $customer */
        $customer = $this->model->query()
            ->join('customer_telephones', 'customer_telephones.customer_id', '=', 'customers.customer_id')
            ->where('customer_telephones.customer_telephone_id', '=', $telephoneId)
            ->first();
        return $customer;
    }
}
