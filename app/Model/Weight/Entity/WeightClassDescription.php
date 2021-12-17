<?php

namespace App\Model\Weight\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $weight_class_description_id
 * @property int $weight_class_id
 * @property int $language_id
 * @property string $title
 * @property string $unit
 */
class WeightClassDescription extends Model
{
    protected $table = 'weight_class_descriptions';

    protected $primaryKey = 'weight_class_description_id';

    protected $fillable = ['weight_class_id', 'language_id', 'title', 'unit'];

    public $timestamps = false;
}
