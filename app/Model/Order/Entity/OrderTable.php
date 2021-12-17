<?php

namespace App\Model\Order\Entity;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_table_id
 * @property int $order_id
 * @property int $user_id
 * @property int $table_id
 * @property bool $deleted
 * @property Carbon $created_at
 * @property Order $order
 * @property User $user
 */
class OrderTable extends Model
{
    protected $table = 'order_tables';

    protected $primaryKey = 'order_table_id';

    protected $fillable = [
        'order_id',
        'user_id',
        'table_id',
        'deleted',
        'created_at',
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
