<?php

namespace App\Model\Weight\Service\Factory;

use App\Model\Weight\Entity\WeightClass;
use App\Model\Weight\Serivce\Rebind\RebindInterface;

class WeightClassFactory implements WeightClassFactoryInterface
{
    private RebindInterface $rebind;

    public function __construct(RebindInterface $rebind)
    {
        $this->rebind = $rebind;
    }

    public function create(Data $data, ?WeightClass $weightClass = null): WeightClass
    {
        $weightClass = $weightClass ?? new WeightClass();
        $weightClass->deleted = false;
        $weightClass->value = $data->value;
        $weightClass->main_class_id = $data->mainClassId;
        $weightClass->descriptions()->delete();
        $weightClass->save();
        foreach ($data->descriptions as $description) {
            $weightClass->descriptions()->insert([
                'weight_class_id' => $weightClass->weight_class_id,
                'language_id' => $description['languageId'],
                'title' => $description['title'],
                'unit' => $description['unit']
            ]);
        }
        if (!$weightClass->main_class_id) {
            $this->rebind->rebind($weightClass);
        }
        return $weightClass;
    }
}
