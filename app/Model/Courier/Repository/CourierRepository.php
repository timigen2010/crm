<?php

namespace App\Model\Courier\Repository;

use App\Model\Courier\Entity\Courier;

class CourierRepository
{
    private Courier $model;

    public function __construct(Courier $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where = [], ?array $orderBy = [])
    {
        return $this->model->query()->orderBy('name', 'asc')->get();
    }

    public function getCouriersByCompanyId(int $companyId){
        return $this->model->query()
            ->join('couriers_to_companies','couriers.courier_id','=','couriers_to_companies.courier_id','inner')
            ->where('couriers_to_companies.company_id', '=', $companyId)
            ->get();
    }
}
