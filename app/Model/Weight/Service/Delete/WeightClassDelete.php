<?php

namespace App\Model\Weight\Service\Delete;

use App\Model\Weight\Entity\WeightClass;
use Illuminate\Support\Facades\DB;

class WeightClassDelete implements WeightClassDeleteInterface
{

    public function delete(WeightClass $weightClass)
    {
        DB::transaction(function () use ($weightClass) {
            $weightClass->deleted = true;
            if ($this->isRebindDefault($weightClass)) {
                $this->rebindAndRefreshValueDefault($weightClass);
            }
            if ($this->isRebind($weightClass)) {
                $this->rebindAndRefreshValue($weightClass);
            }
            $weightClass->save();
        });
    }

    private function isRebindDefault(WeightClass $weightClass)
    {
        return !$weightClass->main_class_id && $weightClass->children->count();
    }

    private function rebindAndRefreshValueDefault(WeightClass $weightClass)
    {
        /** @var WeightClass $firstChild */
        $firstChild = $weightClass->children->first();
        $firstChild->main_class_id = null;
        $weightClass->children
            ->filter(fn(WeightClass $weightClass) => $weightClass !== $firstChild)
            ->map(function (WeightClass $childWeightClass) use ($firstChild) {
                $childWeightClass->main_class_id = $firstChild->weight_class_id;
                $childWeightClass->value = $childWeightClass->value / $firstChild->value;
                $childWeightClass->save();
            });
        $firstChild->value = 1;
        $firstChild->save();
    }

    private function isRebind(WeightClass $weightClass)
    {
        return $weightClass->main_class_id && $weightClass->children->count();
    }

    private function rebindAndRefreshValue(WeightClass $weightClass)
    {
        $weightClass->children->map(function (WeightClass $childWeightClass) use ($weightClass) {
            $childWeightClass->main_class_id = $weightClass->main_class_id;
            $childWeightClass->value = $weightClass->value * $childWeightClass->value;
            $childWeightClass->save();
        });
    }
}
