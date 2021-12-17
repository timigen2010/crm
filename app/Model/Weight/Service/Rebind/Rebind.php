<?php

namespace App\Model\Weight\Serivce\Rebind;

use App\Model\Weight\Entity\WeightClass;
use App\Model\Weight\Repository\WeightClassRepository;

class Rebind implements RebindInterface
{
    private WeightClassRepository $repository;

    public function __construct(WeightClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rebind(WeightClass $weight)
    {
        $this->repository->updateDefaultClasses($weight->weight_class_id, $weight->value);
        $weight->main_class_id = null;
        $weight->value = 1;
        $weight->save();
    }
}
