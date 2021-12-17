<?php

namespace App\Model\Order\Entity;

use App\Model\Customer\Entity\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_review_id
 * @property int $order_id
 * @property int $customer_id
 * @property string $author
 * @property string $text
 * @property int $rating
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Order $order
 * @property Customer $customer
 */
class OrderReview extends Model
{
    protected $table = 'order_reviews';

    protected $primaryKey = 'order_review_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'author',
        'text',
        'rating',
    ];

    public function order()
    {
        return $this->belongsTo(
            Order::class,
            'order_id',
            'order_id'
        );
    }

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'customer_id'
        );
    }
}
