<?php

namespace App\Model\Discount\Entity;

use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $discount_card_id
 * @property int $customer_id
 * @property int $customer_telephone_id
 * @property int $user_id
 * @property int $confirm_code
 * @property bool $active
 * @property bool $blocked
 * @property float $balance
 * @property Carbon $date_released
 * @property Carbon $date_request
 * @property Carbon $date_activated
 * @property Carbon $date_blocked
 * @property Customer $customer
 * @property CustomerTelephone $customerTelephone
 * @property User $user
 */
class DiscountCard extends Model
{
    protected $table = 'discount_cards';

    protected $primaryKey = 'discount_card_id';

    public $incrementing = false;

    protected $fillable = [
        'discount_card_id',
        'customer_id',
        'customer_telephone_id',
        'user_id',
        'confirm_code',
        'active',
        'blocked',
        'balance',
        'date_released',
        'date_request',
        'date_activated',
        'date_blocked',
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'customer_id'
        );
    }

    public function customerTelephone()
    {
        return $this->belongsTo(
            CustomerTelephone::class,
            'customer_telephone_id',
            'customer_telephone_id'
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
