<?php

namespace App\Model\Order\Entity;

use App\Model\Discount\Entity\DiscountCard;
use App\Model\Product\Entity\Product;
use App\Model\Unit\Entity\UnitClass;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_product_id
 * @property int $order_id
 * @property int $product_id
 * @property int $unit_class_id
 * @property int $discount_card_id
 * @property int $currency_id
 * @property string $name
 * @property float $amount
 * @property float $discount
 * @property float $price
 * @property float $total
 * @property boolean $deleted
 * @property Order $order
 * @property Product $product
 * @property UnitClass $unitClass
 * @property DiscountCard $discountCard
 */
class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $primaryKey = 'order_product_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'unit_class_id',
        'discount_card_id',
        'currency_id',
        'name',
        'amount',
        'discount',
        'price',
        'total',
        'deleted',
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

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'product_id'
        );
    }

    public function unitClass()
    {
        return $this->belongsTo(
            UnitClass::class,
            'unit_class_id',
            'unit_class_id'
        );
    }

    public function discountCard()
    {
        return $this->belongsTo(DiscountCard::class, 'discount_card_id', 'discount_card_id');
    }
}
