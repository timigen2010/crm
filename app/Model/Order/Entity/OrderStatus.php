<?php

namespace App\Model\Order\Entity;

use App\Model\Language\Entity\Language;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_status_id
 * @property int $language_id
 * @property string $name
 * @property Language $language
 */
class OrderStatus extends Model
{
    public const STATUS_CREATED_UPDATED = 1;

    protected $table = 'order_statuses';

    protected $primaryKey = 'order_status_id';

    protected $fillable = [
        'language_id',
        'name',
    ];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(
            Language::class,
            'language_id',
            'language_id'
        );
    }
}
