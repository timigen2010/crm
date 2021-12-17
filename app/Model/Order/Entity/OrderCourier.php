<?php

namespace App\Model\Order\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_courier_id
 * @property int $order_id
 * @property int $courier_id
 * @property Carbon $created_at
 * @property boolean $deleted
 * @property Order $order
 */
class OrderCourier extends Model
{
    protected $table = 'order_couriers';

    protected $primaryKey = 'order_courier_id';

    protected $fillable = [
        'order_id',
        'courier_id',
        'created_at',
        'deleted',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'order_id'
        );
    }
}
