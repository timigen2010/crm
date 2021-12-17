<?php

namespace App\Model\Unit\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $unit_class_description_id
 * @property int $unit_class_id
 * @property int $language_id
 * @property string $title
 * @property string $unit
 */
class UnitClassDescription extends Model
{
    protected $table = 'unit_class_descriptions';

    protected $primaryKey = 'unit_class_description_id';

    protected $fillable = ['unit_class_id', 'language_id', 'title', 'unit'];

    public $timestamps = false;
}
