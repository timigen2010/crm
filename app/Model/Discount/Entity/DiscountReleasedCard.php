<?php

namespace App\Model\Discount\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $discount_released_card_id
 */
class DiscountReleasedCard extends Model
{
    protected $table = 'discount_released_cards';

    protected $primaryKey = 'discount_released_card_id';

    protected $fillable = [
        'discount_released_card_id',
    ];

    public $timestamps = false;
}
