<?php

namespace App\Model\Unit\Entity;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $unit_class_id
 * @property int $main_class_id
 * @property bool $deleted
 * @property float $value
 * @property Collection<UnitClassDescription> $descriptions
 * @property Collection<UnitClass> $children
 * @property UnitClass $mainUnitClass
 */
class UnitClass extends Model
{
    protected $table = 'unit_classes';

    protected $primaryKey = 'unit_class_id';

    protected $fillable = ['main_class_id', 'deleted', 'value'];

    public $timestamps = false;

    public function descriptions()
    {
        return $this->hasMany(UnitClassDescription::class, 'unit_class_id', 'unit_class_id');
    }

    public function children()
    {
        return $this->hasMany(UnitClass::class, 'main_class_id', 'unit_class_id');
    }

    public function mainUnitClass()
    {
        return $this->belongsTo(UnitClass::class, 'main_class_id', 'unit_class_id');
    }

    public function getDescription(?int $languageId = null): ?UnitClassDescription
    {
        /** @var UnitClassDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->find(
                fn(UnitClassDescription $description) => $description->language_id === $languageId
            );
        }
        return $description;
    }

    public function getUnit(?int $languageId = null): ?string
    {
        $description = $this->getDescription($languageId);
        return $description ? $description->unit : null;
    }
}
