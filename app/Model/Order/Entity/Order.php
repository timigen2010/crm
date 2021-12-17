<?php

namespace App\Model\Order\Entity;

use App\Model\Company\Entity\Company;
use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Entity\DiscountCardTransaction;
use App\Model\Language\Entity\Language;
use App\Model\Menu\Entity\Menu;
use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_id
 * @property int $company_id
 * @property int $menu_company_id
 * @property int $count_person
 * @property float $count_oddmoney
 * @property float $count_uncash
 * @property int $discount_card_id
 * @property int $discount_card_transaction_id
 * @property float $count_bonus
 * @property float $count_bonus_add
 * @property float $count_voucher
 * @property int $user_id
 * @property int $last_editor_id
 * @property boolean $deleted
 * @property string $delivery_method
 * @property string $comment
 * @property float $total
 * @property int $order_status_id
 * @property int $language_id
 * @property int $currency_id
 * @property string $currency_code
 * @property float $currency_value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property Menu $menu
 * @property DiscountCard $discountCard
 * @property DiscountCardTransaction $discountTransaction
 * @property User $user
 * @property User $lastEditor
 * @property OrderStatus $orderStatus
 * @property Language $language
 * @property OrderCustomer $orderCustomer
 * @property Collection<OrderDeliveryTime> $orderDeliveryTimes
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'company_id',
        'menu_company_id',
        'count_person',
        'count_oddmoney',
        'count_uncash',
        'discount_card_id',
        'discount_card_transaction_id',
        'count_bonus',
        'count_bonus_add',
        'count_voucher',
        'user_id',
        'last_editor_id',
        'deleted',
        'delivery_method',
        'comment',
        'total',
        'order_status_id',
        'language_id',
        'currency_id',
        'currency_code',
        'currency_value',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_company_id', 'menu_id');
    }

    public function discountCard()
    {
        return $this->belongsTo(DiscountCard::class, 'discount_card_id', 'discount_card_id');
    }

    public function discountTransaction()
    {
        return $this->belongsTo(
            DiscountCardTransaction::class,
            'discount_card_transaction_id',
            'discount_card_transaction_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function lastEditor()
    {
        return $this->belongsTo(User::class, 'last_editor_id', 'user_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'order_status_id');
    }

    public function language()
    {
        return $this->belongsTo(
            Language::class,
            'language_id',
            'language_id'
        );
    }

    public function orderCustomer()
    {
        return $this->hasOne(
            OrderCustomer::class,
            'order_id',
            'order_id'
        );
    }

    public function orderDeliveryTimes()
    {
        return $this->hasMany(
            OrderDeliveryTime::class,
            'order_id',
            'order_id'
        );
    }

    public function orderProducts(){
        return $this->hasMany(
            OrderProduct::class,
            'order_id',
            'order_id'
        );
    }

    public function orderHistories(){
        return $this->hasMany(
            OrderHistory::class,
            'order_id',
            'order_id'
        );
    }

    public function orderPayment()
    {
        return $this->hasOne(
            OrderPayment::class,
            'order_id',
            'order_id'
        );
    }

    public function orderCourier()
    {
        return $this->belongsTo(OrderCourier::class, 'order_id', 'order_id');
    }
}
