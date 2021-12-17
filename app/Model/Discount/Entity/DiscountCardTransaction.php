<?php

namespace App\Model\Discount\Entity;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $discount_card_transaction_id
 * @property int $discount_card_operation_id
 * @property int $discount_card_id
 * @property float $amount
 * @property string $status
 * @property int $user_id
 * @property Carbon $created_at
 * @property DiscountCard $discountCard
 * @property User $user
 */
class DiscountCardTransaction extends Model
{
    public const WAIT_STATUS = 'wait';
    public const FINISHED_STATUS = 'finished';
    public const CANCELED_STATUS = 'canceled';

    protected $table = 'discount_card_transactions';

    protected $primaryKey = 'discount_card_transaction_id';

    protected $fillable = [
        'discount_card_id',
        'discount_card_operation_id',
        'amount',
        'created_at',
        'status',
        'user_id',
    ];

    public $timestamps = false;

    public function discountCardOperation()
    {
        return $this->belongsTo(
            DiscountCardOperation::class,
            'discount_card_id',
            'discount_card_id'
        );
    }

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
