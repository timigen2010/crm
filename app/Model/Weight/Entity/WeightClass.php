<?php

namespace App\Model\Weight\Entity;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $weight_class_id
 * @property int $main_class_id
 * @property bool $deleted
 * @property float $value
 * @property Collection<WeightClassDescription> $descriptions
 * @property Collection<WeightClass> $children
 * @property WeightClass $mainWeightClass
 */
class WeightClass extends Model
{
    protected $table = 'weight_classes';

    protected $primaryKey = 'weight_class_id';

    protected $fillable = ['main_class_id', 'deleted', 'value'];

    public $timestamps = false;

    public function descriptions()
    {
        return $this->hasMany(WeightClassDescription::class, 'weight_class_id', 'weight_class_id');
    }

    public function children()
    {
        return $this->hasMany(WeightClass::class, 'main_class_id', 'weight_class_id');
    }

    public function mainWeightClass()
    {
        return $this->belongsTo(WeightClass::class, 'main_class_id', 'weight_class_id');
    }

    public function getDescription(?int $languageId = null): ?WeightClassDescription
    {
        /** @var WeightClassDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->find(
                fn(WeightClassDescription $description) => $description->language_id === $languageId
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
