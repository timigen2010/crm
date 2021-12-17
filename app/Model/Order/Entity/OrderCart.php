<?php

namespace App\Model\Order\Entity;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_cart_id
 * @property int $order_id
 * @property int $table_id
 * @property array $cart
 * @property int $user_id
 * @property bool $deleted
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $date_closed
 * @property Order $order
 * @property User $user
 */
class OrderCart extends Model
{
    protected $table = 'order_carts';

    protected $primaryKey = 'order_cart_id';

    protected $fillable = [
        'order_id',
        'table_id',
        'cart',
        'date_closed',
        'deleted',
        'status',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'order_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }
}
