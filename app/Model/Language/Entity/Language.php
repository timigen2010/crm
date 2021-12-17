<?php

namespace App\Model\Language\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $language_id
 * @property string $name
 * @property string $code
 * @property string $locale
 * @property string $image
 * @property boolean $status
 * @property boolean $deleted
 */
class Language extends Model
{
    const RU_ID = 1;

    protected $table = 'languages';

    protected $primaryKey = 'language_id';

    protected $fillable = ['name', 'code', 'locale', 'image', 'status', 'deleted'];

    public $timestamps = false;
}
