<?php

namespace App\Model\Call\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $dial_status_description_id
 * @property int $dial_status_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 */
class DialStatusDescription extends Model
{
    protected $table = 'dial_status_descriptions';

    protected $primaryKey = 'dial_status_description_id';

    protected $fillable = ['dial_status_id', 'language_id', 'name', 'description'];

    public $timestamps = false;
}
