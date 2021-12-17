<?php

namespace App\Http\Resources\Discount;

use App\Model\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property string $discount_card_id
 * @property float $balance
 */
class GetCardByCustomerResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="GetDiscountByCustomerResource",
     *     type="object",
     *     @SWG\Property(property="discountCardId", type="string"),
     *     @SWG\Property(property="balance", type="float"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'discountCardId' => $this->discount_card_id,
            'balance' => $this->balance
        ];
    }
}
