<?php

namespace App\Model\Order\Entity;

use App\Model\Customer\Entity\Customer;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_id
 * @property int $customer_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $telephone
 * @property Order $order
 * @property Customer $customer
 */
class OrderCustomer extends Model
{
    protected $table = 'order_customers';

    protected $primaryKey = 'order_id';

    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'telephone',
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

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'customer_id'
        );
    }

    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
