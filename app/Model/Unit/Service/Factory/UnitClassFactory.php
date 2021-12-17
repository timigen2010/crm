<?php

namespace App\Model\Unit\Service\Factory;

use App\Model\Unit\Entity\UnitClass;
use App\Model\Unit\Serivce\Rebind\RebindInterface;

class UnitClassFactory implements UnitClassFactoryInterface
{
    private RebindInterface $rebind;

    public function __construct(RebindInterface $rebind)
    {
        $this->rebind = $rebind;
    }

    public function create(Data $data, ?UnitClass $unitClass = null): UnitClass
    {
        $unitClass = $unitClass ?? new UnitClass();
        $unitClass->deleted = false;
        $unitClass->value = $data->value;
        $unitClass->main_class_id = $data->mainClassId;
        $unitClass->descriptions()->delete();
        $unitClass->save();
        foreach ($data->descriptions as $description) {
            $unitClass->descriptions()->insert([
                'unit_class_id' => $unitClass->unit_class_id,
                'language_id' => $description['languageId'],
                'title' => $description['title'],
                'unit' => $description['unit']
            ]);
        }
        if (!$unitClass->main_class_id) {
            $this->rebind->rebind($unitClass);
        }
        return $unitClass;
    }
}
