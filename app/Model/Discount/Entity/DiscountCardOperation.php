<?php

namespace App\Model\Discount\Entity;

use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $discount_card_operation_id
 * @property string $discount_card_id
 * @property string $type
 * @property int $order_id
 * @property float $order_cost
 * @property float $discount
 * @property float $order_cost_discount
 * @property float $bonus_use
 * @property float $bonus_add
 * @property Carbon $created_at
 * @property int $user_id
 * @property string $comment
 * @property string $telephone_old
 * @property string $telephone_new
 * @property DiscountCard $discountCard
 * @property User $user
 */
class DiscountCardOperation extends Model
{
    public const ACTIVATE_TYPE = 'activate';
    public const BUY_TYPE = 'buy';
    public const ADD_TYPE = 'add';
    public const REBIND_TYPE = 'rebind';
    public const DEACTIVATE_TYPE = 'deactivate';

    protected $table = 'discount_card_operations';

    protected $primaryKey = 'discount_card_operation_id';

    protected $fillable = [
        'discount_card_id',
        'type',
        'order_id',
        'order_cost',
        'discount',
        'order_cost_discount',
        'bonus_use',
        'bonus_add',
        'created_at',
        'user_id',
        'comment',
        'telephone_old',
        'telephone_new',
    ];

    public $timestamps = false;

    public function discountCard()
    {
        return $this->belongsTo(
            DiscountCard::class,
            'discount_card_id',
            'discount_card_id'
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
