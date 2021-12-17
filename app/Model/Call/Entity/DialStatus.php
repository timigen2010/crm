<?php

namespace App\Model\Call\Entity;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $dial_status_id
 * @property string $code
 * @property Collection<DialStatusDescription> $descriptions
 */
class DialStatus extends Model
{
    protected $table = 'dial_statuses';

    protected $primaryKey = 'dial_status_id';

    protected $fillable = ['code'];

    public $timestamps = false;

    public function descriptions()
    {
        return $this->hasMany(DialStatusDescription::class, 'dial_status_id', 'dial_status_id');
    }
}
