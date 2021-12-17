<?php

namespace App\Model\Order\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address_1
 * @property string $address_2
 * @property string $coords
 * @property string $city
 * @property string $method
 * @property string $code
 * @property Order $order
 */
class OrderPayment extends Model
{
    protected $table = 'order_payments';

    protected $primaryKey = 'order_id';

    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'coords',
        'city',
        'method',
        'code',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(
            Order::class,
            'order_id',
            'order_id'
        );
    }
}
