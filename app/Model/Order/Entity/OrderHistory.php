<?php

namespace App\Model\Order\Entity;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_history_id
 * @property int $order_id
 * @property int $user_id
 * @property int $order_status_id
 * @property string $comment
 * @property array $values
 * @property Carbon $created_at
 * @property Order $order
 * @property User $user
 * @property OrderStatus $orderStatus
 */
class OrderHistory extends Model
{
    protected $table = 'order_histories';

    protected $primaryKey = 'order_history_id';

    protected $fillable = [
        'order_id',
        'user_id',
        'order_status_id',
        'comment',
        'created_at',
        'values',
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

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'order_status_id');
    }
}
