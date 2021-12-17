<?php

namespace App\Model\Order\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_cook_comment_id
 * @property int $order_id
 * @property string $comment
 */
class OrderCookComment extends Model
{
    protected $table = 'order_cook_comments';

    protected $primaryKey = 'order_cook_comment_id';

    protected $fillable = [
        'order_id',
        'comment',
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
