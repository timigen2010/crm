<?php

namespace App\Model\Unit\Serivce\Rebind;

use App\Model\Unit\Entity\UnitClass;
use App\Model\Unit\Repository\UnitClassRepository;

class Rebind implements RebindInterface
{
    private UnitClassRepository $repository;

    public function __construct(UnitClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rebind(UnitClass $unitClass)
    {
        $this->repository->updateDefaultClasses($unitClass->unit_class_id, $unitClass->value);
        $unitClass->main_class_id = null;
        $unitClass->value = 1;
        $unitClass->save();
    }
}
