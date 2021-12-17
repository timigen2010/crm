<?php

namespace App\Http\Resources\Discount;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

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
 * @property User $user
 */
class OperationResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="OperationResource",
     *     type="object",
     *     @SWG\Property(property="discountCardOperationId", type="integer"),
     *     @SWG\Property(property="discountCardId", type="string"),
     *     @SWG\Property(property="type", type="string"),
     *     @SWG\Property(property="orderId", type="integer"),
     *     @SWG\Property(property="orderCost", type="number"),
     *     @SWG\Property(property="discount", type="number"),
     *     @SWG\Property(property="orderCostDiscount", type="number"),
     *     @SWG\Property(property="bonusUse", type="number"),
     *     @SWG\Property(property="bonusAdd", type="number"),
     *     @SWG\Property(property="createdAt", type="string"),
     *     @SWG\Property(property="userId", type="integer"),
     *     @SWG\Property(property="username", type="string"),
     *     @SWG\Property(property="comment", type="string"),
     *     @SWG\Property(property="telephoneOld", type="string"),
     *     @SWG\Property(property="telephoneNew", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'discountCardOperationId' => $this->discount_card_operation_id,
            'discountCardId' => $this->discount_card_id,
            'type' => $this->type,
            'orderId' => $this->order_id,
            'orderCost' => $this->order_cost,
            'discount' => $this->discount,
            'orderCostDiscount' => $this->order_cost_discount,
            'bonusUse' => $this->bonus_use,
            'bonusAdd' => $this->bonus_add,
            'createdAt' => $this->created_at,
            'userId' => $this->user_id,
            'username' => $this->user->username,
            'comment' => $this->comment,
            'telephoneOld' => $this->telephone_old,
            'telephoneNew' => $this->telephone_new,
        ];
    }
}
