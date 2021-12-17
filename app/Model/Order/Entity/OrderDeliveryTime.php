<?php

namespace App\Model\Order\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_delivery_time_id
 * @property int $order_id
 * @property string $type
 * @property string $day
 * @property string $time
 * @property Order $order
 */
class OrderDeliveryTime extends Model
{
    protected $table = 'order_delivery_times';

    protected $primaryKey = 'order_delivery_time_id';

    protected $fillable = [
        'order_id',
        'type',
        'day',
        'time',
    ];

    public $timestamps = false;
}
