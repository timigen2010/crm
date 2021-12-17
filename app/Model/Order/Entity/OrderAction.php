<?php

namespace App\Model\Order\Entity;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_action_id
 * @property int $order_id
 * @property int $user_id
 * @property string $info
 * @property Carbon $created_at
 * @property Order $order
 * @property User $user
 */
class OrderAction extends Model
{
    protected $table = 'order_actions';

    protected $primaryKey = 'order_action_id';

    protected $fillable = [
        'order_id',
        'user_id',
        'info',
        'created_at',
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
}
