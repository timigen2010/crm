<?php

namespace App\Model\Order\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_total_id
 * @property int $order_id
 * @property string $code
 * @property string $title
 * @property float $value
 * @property Order $order
 */
class OrderTotal extends Model
{
    protected $table = 'order_totals';

    protected $primaryKey = 'order_total_id';

    protected $fillable = [
        'order_id',
        'code',
        'title',
        'value',
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
