<?php

namespace App\Model\Order\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_option_id
 * @property int $order_id
 * @property int $product_main_id
 * @property int $product_id
 * @property string $product_main_key
 * @property float $amount
 */
class OrderOption extends Model
{
    protected $table = 'order_options';

    protected $primaryKey = 'order_option_id';

    protected $fillable = [
        'order_id',
        'product_main_id',
        'product_main_key',
        'product_id',
        'amount',
    ];

    public $timestamps = false;
}
