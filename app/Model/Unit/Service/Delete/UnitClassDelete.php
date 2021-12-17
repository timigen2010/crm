<?php

namespace App\Model\Unit\Service\Delete;

use App\Model\Unit\Entity\UnitClass;
use Illuminate\Support\Facades\DB;

class UnitClassDelete implements UnitClassDeleteInterface
{

    public function delete(UnitClass $unitClass)
    {
        DB::transaction(function () use ($unitClass) {
            $unitClass->deleted = true;
            if ($this->isRebindDefault($unitClass)) {
                $this->rebindAndRefreshValueDefault($unitClass);
            }
            if ($this->isRebind($unitClass)) {
                $this->rebindAndRefreshValue($unitClass);
            }
            $unitClass->save();
        });
    }

    private function isRebindDefault(UnitClass $unitClass)
    {
        return !$unitClass->main_class_id && $unitClass->children->count();
    }

    private function rebindAndRefreshValueDefault(UnitClass $unitClass)
    {
        /** @var UnitClass $firstChild */
        $firstChild = $unitClass->children->first();
        $firstChild->main_class_id = null;
        $unitClass->children
            ->filter(fn(UnitClass $unitClass) => $unitClass !== $firstChild)
            ->map(function (UnitClass $childUnitClass) use ($firstChild) {
                $childUnitClass->main_class_id = $firstChild->unit_class_id;
                $childUnitClass->value = $childUnitClass->value / $firstChild->value;
                $childUnitClass->save();
            });
        $firstChild->value = 1;
        $firstChild->save();
    }

    private function isRebind(UnitClass $unitClass)
    {
        return $unitClass->main_class_id && $unitClass->children->count();
    }

    private function rebindAndRefreshValue(UnitClass $unitClass)
    {
        $unitClass->children->map(function (UnitClass $childUnitClass) use ($unitClass) {
            $childUnitClass->main_class_id = $unitClass->main_class_id;
            $childUnitClass->value = $unitClass->value * $childUnitClass->value;
            $childUnitClass->save();
        });
    }
}
